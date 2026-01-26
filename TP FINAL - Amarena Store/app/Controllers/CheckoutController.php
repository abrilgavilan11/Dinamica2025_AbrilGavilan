<?php

namespace App\Controllers;

use App\Models\Cart;
use App\Utils\Auth;
use App\Utils\Session;

class CheckoutController extends BaseController
{
    /**
     * Muestra la página de checkout
     */
    public function index()
    {
        // Auth::requireLogin() ya verifica si el usuario está logueado
        // y lo redirige si no lo está. Esto simplifica el código.
        Auth::requireLogin();

        // Obtener el carrito
        $cartModel = new Cart();
        $cartContents = $cartModel->getCartContents();

        // Verificar que el carrito no esté vacío
        if (empty($cartContents['items'])) {
            Session::flash('error', 'Tu carrito está vacío');
            $this->redirect('/cart');
            return;
        }

        // Mostrar la vista de checkout
        $this->view('checkout.index', [
            'data' => [
                'title' => 'Checkout - Amarena Store',
                'pageCss' => 'checkout',
                'cartItems' => $cartContents['items'],
                'total' => $cartContents['total']
            ]
        ]);
    }
}
