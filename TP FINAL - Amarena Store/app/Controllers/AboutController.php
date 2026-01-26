<?php

namespace App\Controllers;

class AboutController extends BaseController
{
    public function index()
    {
        $this->view('public.about', [
            'title' => 'Sobre Nosotros - Amarena Store',
            'pageCss' => 'about'
        ]);
    }
}
