<?php

namespace App\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Utils\Session;

class CartController extends BaseController
{
    public function index()
    {
        $currentCart = Session::get('cart', []);
        error_log("[v0] Cart index - Session cart: " . json_encode($currentCart));
        
        // 1. Preparamos el modelo del carrito.
        $cartModel = new Cart();
        
        // 2. El modelo se encarga de toda la lógica de obtener los items y calcular el total,
        // ya sea desde la sesión o la base de datos.
        $cartContents = $cartModel->getCartContents();
        
        error_log("[v0] Cart index - Cart contents: " . json_encode($cartContents));
        
        // 3. Mostramos la vista del carrito, pasándole los datos ya procesados.
        // CORRECCIÓN: Pasamos todo dentro de un array $data para que la vista lo reciba correctamente.
        $this->view('cart.index', [
            'data' => [
                'title' => 'Tu Carrito - Amarena Store',
                'pageCss' => 'cart',
                'cartItems' => $cartContents['items'],
                'total' => $cartContents['total']
            ]
        ]);
    }

    public function add()
    {
        $productId = trim($_POST['product_id'] ?? '');
        $quantity = intval($_POST['quantity'] ?? 1);
        $size = trim($_POST['size'] ?? '');
        $color = trim($_POST['color'] ?? '');
        
        error_log("[v0] Adding to cart - Product: $productId, Size: $size, Color: $color, Qty: $quantity");
        
        if (empty($productId) || empty($size) || empty($color)) {
            error_log("[v0] Cart add failed - Missing required fields");
            $this->json(['success' => false, 'message' => 'Por favor, selecciona talle y color.'], 400);
        } else {
            // Obtenemos el carrito actual de la sesión ANTES de hacer cambios.
            $currentCart = Session::get('cart', []);
            error_log("[v0] Current cart before add: " . json_encode($currentCart));

            // Pasamos el carrito actual al modelo para que trabaje sobre él.
            // El modelo se encargará de añadir o actualizar el producto.
            $cartModel = new Cart();
            $updatedCart = $cartModel->addItem($currentCart, $productId, $quantity, $size, $color);

            // ¡ESTA ES LA CORRECCIÓN CLAVE!
            // Guardamos el carrito actualizado que nos devolvió el modelo de vuelta en la sesión.
            // Sin esta línea, los cambios se pierden.
            Session::set('cart', $updatedCart);
            
            error_log("[v0] Cart after add: " . json_encode($updatedCart));
            error_log("[v0] Cart count: " . count($updatedCart));

            $this->json([
                'success' => true, 
                'message' => 'Producto agregado al carrito',
                'cartCount' => count($updatedCart) // Ahora $updatedCart es un array válido y count() funcionará.
            ]);
        }
    }

    public function update()
    {
        // 1. Recolectamos y validamos los datos.
        $itemId = trim($_POST['item_id'] ?? '');
        $quantity = intval($_POST['quantity'] ?? 1);
        
        // 2. Verificamos que los datos sean válidos.
        if (empty($itemId) || $quantity < 1) {
            error_log("[v0] Cart update failed - Invalid data");
            $this->json(['success' => false, 'message' => 'Datos inválidos para actualizar.'], 400);
        } else {
            // 3. Le pedimos al modelo que actualice la cantidad.
            // El controlador ya no necesita saber si es una sesión o una BD.
            $cartModel = new Cart();
            $cartModel->updateItemQuantity($itemId, $quantity);
            
            error_log("[v0] Cart updated - Item: $itemId, Qty: $quantity");
            $this->json(['success' => true, 'message' => 'Cantidad actualizada']);
        }
    }

    public function remove()
    {
        // 1. Recolectamos y validamos el ID del item.
        $itemId = trim($_POST['item_id'] ?? '');
        
        if (empty($itemId)) {
            error_log("[v0] Cart remove failed - Missing item ID");
            $this->json(['success' => false, 'message' => 'ID de item requerido.'], 400);
        } else {
            // 2. Le pedimos al modelo que elimine el item.
            $cartModel = new Cart();
            $cartModel->removeItem($itemId);
            
            error_log("[v0] Cart item removed - Item: $itemId");
            $this->json(['success' => true, 'message' => 'Producto eliminado del carrito']);
        }
    }

    public function clear()
    {
        $cartModel = new Cart();
        $cartModel->clear();
        
        error_log("[v1] Cart cleared");
        $this->redirect('/carrito');
    }
}
