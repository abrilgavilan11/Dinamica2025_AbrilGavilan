<?php

namespace App\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Utils\Auth;
use App\Utils\Session;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

class PaymentController extends BaseController
{
    private $mpConfig;

    public function __construct()
    {
        $this->mpConfig = require CONFIG_PATH . '/mercadopago.php';
        MercadoPagoConfig::setAccessToken($this->mpConfig['access_token']);
    }

    /**
     * Inicia el proceso de pago con Mercado Pago
     */
    public function initiate()
    {
        Auth::requireLogin();

        try {
            $userId = Auth::getUserId();
            $cartModel = new Cart();
            $cartContents = $cartModel->getCartContents();

            if (empty($cartContents['items'])) {
                $this->json(['success' => false, 'message' => 'El carrito está vacío.'], 400);
                return;
            }

            // Preparar items para Mercado Pago
            $items = [];
            foreach ($cartContents['items'] as $item) {
                $items[] = [
                    'id' => $item['product_id'],
                    'title' => $item['name'],
                    'description' => 'Talle: ' . $item['size'] . ' | Color: ' . $item['color'],
                    'quantity' => $item['quantity'],
                    'unit_price' => (float)$item['price']
                ];
            }

            // Crear preferencia de pago en Mercado Pago
            $client = new PreferenceClient();
            $preference = $client->create([
                'items' => $items,
                'external_reference' => 'user_' . $userId . '_' . time(),
                'notification_url' => BASE_URL . '/pago/webhook',
                'back_urls' => [
                    'success' => BASE_URL . '/pago/exitoso',
                    'failure' => BASE_URL . '/pago/fallido',
                    'pending' => BASE_URL . '/pago/pendiente'
                ],
                'auto_return' => 'approved'
            ]);

            $this->json([
                'success' => true,
                'preference_id' => $preference->id,
                'init_point' => $preference->init_point
            ]);
        } catch (MPApiException $e) {
            error_log("Error Mercado Pago: " . $e->getMessage());
            $this->json(['success' => false, 'message' => 'Error al procesar el pago.'], 500);
        } catch (\Exception $e) {
            error_log("Error al iniciar pago: " . $e->getMessage());
            $this->json(['success' => false, 'message' => 'Error interno.'], 500);
        }
    }

    /**
     * Webhook para notificaciones de Mercado Pago
     */
    public function webhook()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);

            // Validar token del webhook
            $authHeader = $_SERVER['HTTP_X_SIGNATURE'] ?? '';
            if (!$this->validateWebhookSignature($authHeader, $data)) {
                http_response_code(401);
                exit;
            }

            if ($data['type'] === 'payment') {
                $paymentId = $data['data']['id'];
                $this->handlePaymentNotification($paymentId);
            }

            http_response_code(200);
        } catch (\Exception $e) {
            error_log("Error en webhook: " . $e->getMessage());
            http_response_code(500);
        }
    }

    /**
     * Procesa la notificación de pago de Mercado Pago
     */
    private function handlePaymentNotification($paymentId)
    {
        try {
            $client = new \MercadoPago\Client\Payment\PaymentClient();
            $payment = $client->get($paymentId);

            if ($payment->status === 'approved') {
                // Pago aprobado
                $externalRef = $payment->external_reference;
                $this->completeOrder($externalRef);
            } elseif ($payment->status === 'rejected') {
                // Pago rechazado
                error_log("Pago rechazado: $paymentId");
            } elseif ($payment->status === 'pending') {
                // Pago pendiente
                error_log("Pago pendiente: $paymentId");
            }
        } catch (\Exception $e) {
            error_log("Error al procesar notificación: " . $e->getMessage());
        }
    }

    /**
     * Completa la orden después del pago aprobado
     */
    private function completeOrder($externalRef)
    {
        try {
            // Extraer userId de external_reference (formato: user_ID_timestamp)
            preg_match('/user_(\d+)_/', $externalRef, $matches);
            $userId = $matches[1] ?? null;

            if (!$userId) {
                error_log("No se pudo extraer userId de: $externalRef");
                return;
            }

            $cartModel = new Cart();
            $cartContents = $cartModel->getCartContents();

            if (empty($cartContents['items'])) {
                error_log("Carrito vacío para userId: $userId");
                return;
            }

            // Preparar items para la orden
            $items = [];
            $productModel = new \App\Models\Product();

            foreach ($cartContents['items'] as $item) {
                $items[] = [
                    'idproducto' => $item['product_id'],
                    'cantidad' => $item['quantity'],
                    'precio' => $item['price']
                ];
            }

            // Crear la orden
            $orderModel = new Order();
            $orderId = $orderModel->create($userId, $items);

            if ($orderId) {
                // Disminuir stock
                foreach ($items as $item) {
                    $productModel->decreaseStock($item['idproducto'], $item['cantidad']);
                }

                // Vaciar carrito
                $cartModel->clear();

                // Guardar información del pago
                $this->savepaymentInfo($orderId, $externalRef);

                // Enviar email de confirmación
                $userModel = new \App\Models\User();
                $user = $userModel->findById($userId);
                $email = new \App\Utils\Email();
                $email->sendOrderConfirmation(
                    $user['usmail'],
                    $user['usnombre'],
                    $orderId,
                    $cartContents['total']
                );

                error_log("Orden creada exitosamente: $orderId");
            }
        } catch (\Exception $e) {
            error_log("Error al completar orden: " . $e->getMessage());
        }
    }

    /**
     * Guarda información del pago en una tabla auxiliar
     */
    private function savePaymentInfo($orderId, $externalRef)
    {
        try {
            $db = \App\Utils\Database::getInstance();
            $sql = "INSERT INTO order_payments (order_id, external_reference, payment_status, paid_at) 
                    VALUES (?, ?, 'approved', NOW())";
            $db->query($sql, [$orderId, $externalRef]);
        } catch (\Exception $e) {
            error_log("Error al guardar info de pago: " . $e->getMessage());
        }
    }

    /**
     * Valida la firma del webhook
     */
    private function validateWebhookSignature($signature, $data)
    {
        // ¡IMPORTANTE! Reemplazar con tu clave secreta del webhook de Mercado Pago.
        $secretKey = $this->mpConfig['webhook_secret'] ?? null;

        if (!$secretKey) {
            error_log("Clave secreta del webhook no configurada.");
            return false; // No procesar si no hay clave.
        }

        // Extraer ts y hash de la cabecera X-Signature
        // Formato: ts=123456789,v1=HASH_GENERADO
        $ts = '';
        $hash = '';
        if (preg_match('/ts=(\d+)/', $signature, $tsMatch)) {
            $ts = $tsMatch[1];
        }
        if (preg_match('/v1=([a-f0-9]+)/', $signature, $hashMatch)) {
            $hash = $hashMatch[1];
        }

        $signedTemplate = "id:{$data['data']['id']};request-id:{$_SERVER['HTTP_X_REQUEST_ID']};ts:{$ts};";
        $expectedHash = hash_hmac('sha256', $signedTemplate, $secretKey);

        return hash_equals($expectedHash, $hash);
    }

    /**
     * Página de pago exitoso
     */
    public function success()
    {
        Auth::requireLogin();
        $this->view('public.payment_success', [
            'title' => 'Pago Exitoso - Amarena Store',
            'pageCss' => 'payment'
        ]);
    }

    /**
     * Página de pago fallido
     */
    public function failure()
    {
        Auth::requireLogin();
        $this->view('public.payment_failure', [
            'title' => 'Pago Fallido - Amarena Store',
            'pageCss' => 'payment'
        ]);
    }

    /**
     * Página de pago pendiente
     */
    public function pending()
    {
        Auth::requireLogin();
        $this->view('public.payment_pending', [
            'title' => 'Pago Pendiente - Amarena Store',
            'pageCss' => 'payment'
        ]);
    }
}
