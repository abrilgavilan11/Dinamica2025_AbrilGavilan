<?php

namespace App\Controllers;

use App\Models\Product;

class HomeController extends BaseController
{
    public function index()
    {
        // 1. Obtenemos los productos destacados del modelo.
        $productModel = new Product();
        $featuredProducts = $productModel->getFeatured(4);
        
        // 2. Mostramos la vista 'public.home' y le pasamos los datos necesarios.
        $this->view('public.home', [
            'title' => 'Amarena Store - Moda para todas',
            'pageCss' => 'home',
            'featuredProducts' => $featuredProducts
        ]);
    }
}
