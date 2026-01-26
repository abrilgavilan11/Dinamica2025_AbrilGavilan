<?php

namespace App\Controllers;

use App\Models\Order;
use App\Utils\Auth;
use Mpdf\Mpdf;

class PdfController extends BaseController
{
    /**
     * Genera y descarga el comprobante PDF de una orden
     */
    public function downloadReceipt($orderId)
    {
        Auth::requireLogin();

        try {
            $orderId = intval($orderId);
            $orderModel = new Order();
            $order = $orderModel->findById($orderId);

            // Verificar que la orden existe y pertenece al usuario o es admin
            if (!$order || ($order['idusuario'] != Auth::getUserId() && !Auth::isAdmin())) {
                $this->redirect('/');
                return;
            }

            $items = $orderModel->getItems($orderId);
            $statusHistory = $orderModel->getStatusHistory($orderId);
            $currentStatus = $orderModel->getCurrentStatus($orderId);

            // Generar HTML del PDF
            $html = $this->generateReceiptHTML($order, $items, $currentStatus);

            // Crear PDF con mPDF
            $mpdf = new Mpdf([
                'mode' => 'utf-8',
                'format' => 'A4',
                'margin_left' => 15,
                'margin_right' => 15,
                'margin_top' => 15,
                'margin_bottom' => 15,
            ]);

            $mpdf->WriteHTML($html);

            // Descargar el PDF
            $filename = 'comprobante_orden_' . $orderId . '.pdf';
            $mpdf->Output($filename, 'D');
        } catch (\Exception $e) {
            error_log("Error al generar PDF: " . $e->getMessage());
            $this->redirect('/');
        }
    }

    /**
     * Genera el HTML para el comprobante PDF
     */
    private function generateReceiptHTML($order, $items, $currentStatus)
    {
        $total = 0;
        $itemsHTML = '';

        foreach ($items as $item) {
            $subtotal = $item['ciprecio'] * $item['cicantidad'];
            $total += $subtotal;
            $itemsHTML .= "
                <tr>
                    <td style='padding: 12px 8px; border-bottom: 1px solid #f0f0f0;'>{$item['pronombre']}</td>
                    <td style='padding: 12px 8px; border-bottom: 1px solid #f0f0f0; text-align: center;'>{$item['cicantidad']}</td>
                    <td style='padding: 12px 8px; border-bottom: 1px solid #f0f0f0; text-align: right;'>\$" . number_format($item['ciprecio'], 0, ',', '.') . "</td>
                    <td style='padding: 12px 8px; border-bottom: 1px solid #f0f0f0; text-align: right; font-weight: bold;'>\$" . number_format($subtotal, 0, ',', '.') . "</td>
                </tr>
            ";
        }

        $html = "
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset='UTF-8'>
                <style>
                    body {
                        font-family: 'Helvetica', 'Arial', sans-serif;
                        color: #2c3e50;
                        line-height: 1.6;
                        margin: 0;
                        padding: 20px;
                    }
                    .header {
                        text-align: center;
                        background: linear-gradient(135deg, #d96a7e, #f26389);
                        color: white;
                        padding: 30px 20px;
                        border-radius: 10px 10px 0 0;
                        margin-bottom: 30px;
                    }
                    .store-name {
                        font-size: 32px;
                        font-weight: bold;
                        letter-spacing: 2px;
                        margin-bottom: 5px;
                    }
                    .store-tagline {
                        font-size: 14px;
                        opacity: 0.9;
                        letter-spacing: 1px;
                    }
                    .receipt-badge {
                        background: white;
                        color: #d96a7e;
                        padding: 8px 20px;
                        border-radius: 20px;
                        display: inline-block;
                        margin-top: 15px;
                        font-weight: bold;
                        font-size: 12px;
                    }
                    .section {
                        margin-bottom: 30px;
                        background: #f8f9fa;
                        padding: 20px;
                        border-radius: 10px;
                        border-left: 4px solid #d96a7e;
                    }
                    .section-title {
                        font-size: 16px;
                        font-weight: bold;
                        color: #d96a7e;
                        margin-bottom: 15px;
                        text-transform: uppercase;
                        letter-spacing: 1px;
                    }
                    .info-grid {
                        display: table;
                        width: 100%;
                    }
                    .info-row {
                        display: table-row;
                    }
                    .info-label {
                        display: table-cell;
                        font-weight: 600;
                        padding: 8px 0;
                        color: #666;
                        width: 35%;
                    }
                    .info-value {
                        display: table-cell;
                        padding: 8px 0;
                        color: #2c3e50;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin: 20px 0;
                        background: white;
                        border-radius: 10px;
                        overflow: hidden;
                    }
                    th {
                        background: #d96a7e;
                        color: white;
                        padding: 15px 10px;
                        text-align: left;
                        font-weight: bold;
                        font-size: 13px;
                        text-transform: uppercase;
                        letter-spacing: 0.5px;
                    }
                    tbody tr:last-child td {
                        border-bottom: none;
                    }
                    .total-section {
                        background: linear-gradient(135deg, #f2e0d0, #f2b6b6);
                        padding: 25px;
                        border-radius: 10px;
                        margin-top: 30px;
                    }
                    .total-row {
                        text-align: right;
                        font-size: 24px;
                        font-weight: bold;
                        color: #d96a7e;
                        margin-bottom: 10px;
                    }
                    .payment-info {
                        text-align: right;
                        font-size: 12px;
                        color: #666;
                        margin-top: 10px;
                    }
                    .status-badge {
                        display: inline-block;
                        padding: 8px 20px;
                        background: #27ae60;
                        color: white;
                        border-radius: 20px;
                        font-size: 12px;
                        font-weight: bold;
                        text-transform: uppercase;
                        letter-spacing: 1px;
                    }
                    .footer {
                        text-align: center;
                        margin-top: 50px;
                        padding-top: 20px;
                        border-top: 2px solid #e0e0e0;
                        color: #999;
                        font-size: 11px;
                    }
                    .footer-logo {
                        font-size: 18px;
                        font-weight: bold;
                        color: #d96a7e;
                        margin-bottom: 10px;
                    }
                    .contact-info {
                        margin-top: 15px;
                        font-size: 10px;
                        color: #666;
                    }
                    .thank-you {
                        background: #fff9e6;
                        border: 2px dashed #f39c12;
                        padding: 15px;
                        border-radius: 10px;
                        text-align: center;
                        margin: 30px 0;
                        color: #856404;
                        font-weight: 600;
                    }
                </style>
            </head>
            <body>
                <div class='header'>
                    <div class='store-name'>AMARENA STORE</div>
                    <div class='store-tagline'>Moda Inclusiva Para Todos</div>
                    <div class='receipt-badge'>COMPROBANTE DE COMPRA</div>
                </div>

                <div class='section'>
                    <div class='section-title'>📋 Información de la Orden</div>
                    <div class='info-grid'>
                        <div class='info-row'>
                            <div class='info-label'>Número de Orden:</div>
                            <div class='info-value'><strong>#" . str_pad($order['idcompra'], 6, '0', STR_PAD_LEFT) . "</strong></div>
                        </div>
                        <div class='info-row'>
                            <div class='info-label'>Fecha de Compra:</div>
                            <div class='info-value'>" . date('d/m/Y H:i', strtotime($order['cofecha'])) . " hs</div>
                        </div>
                        <div class='info-row'>
                            <div class='info-label'>Estado Actual:</div>
                            <div class='info-value'><span class='status-badge'>" . strtoupper($currentStatus['cetdescripcion'] ?? 'Procesando') . "</span></div>
                        </div>
                    </div>
                </div>

                <div class='section'>
                    <div class='section-title'>👤 Datos del Cliente</div>
                    <div class='info-grid'>
                        <div class='info-row'>
                            <div class='info-label'>Nombre Completo:</div>
                            <div class='info-value'>" . htmlspecialchars($order['usnombre']) . "</div>
                        </div>
                        <div class='info-row'>
                            <div class='info-label'>Email:</div>
                            <div class='info-value'>" . htmlspecialchars($order['usmail']) . "</div>
                        </div>
                    </div>
                </div>

                <div class='section'>
                    <div class='section-title'>🛍️ Detalle de Productos</div>
                    <table>
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th style='text-align: center; width: 15%;'>Cantidad</th>
                                <th style='text-align: right; width: 20%;'>Precio Unit.</th>
                                <th style='text-align: right; width: 20%;'>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            $itemsHTML
                        </tbody>
                    </table>
                </div>

                <div class='total-section'>
                    <div class='total-row'>TOTAL: \$" . number_format($total, 0, ',', '.') . "</div>
                    <div class='payment-info'>
                        💳 Método de Pago: Mercado Pago<br>
                        ✅ Pago procesado exitosamente
                    </div>
                </div>

                <div class='thank-you'>
                    ✨ ¡Gracias por tu compra! Esperamos que disfrutes tus productos ✨
                </div>

                <div class='footer'>
                    <div class='footer-logo'>AMARENA STORE</div>
                    <p>Este comprobante es válido como prueba de compra</p>
                    <p>Generado el " . date('d/m/Y') . " a las " . date('H:i') . " hs</p>
                    <div class='contact-info'>
                        📧 info@amarenastore.com | 📱 +54 299 123-4567 | 📍 Plottier, Neuquén
                    </div>
                </div>
            </body>
            </html>
        ";

        return $html;
    }
}
