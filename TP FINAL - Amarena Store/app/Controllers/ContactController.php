<?php

namespace App\Controllers;

use App\Utils\Session;

class ContactController extends BaseController
{
    public function index()
    {
        // Muestra la vista del formulario de contacto y le pasa los datos de configuración.
        $this->view('public.contact', [
            'title' => 'Contacto - Amarena Store',
            'pageCss' => 'contact'
        ]);
    }

    public function send()
    {
        // 1. Recolectamos y limpiamos los datos del formulario.
        $name = trim($_POST['nombre'] ?? '');
        $lastname = trim($_POST['apellido'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['telefono'] ?? '');
        $message = $_POST['comentarios'] ?? '';
        
        // 2. Realizamos las validaciones de forma secuencial.
        $error = null; // Variable para guardar el primer error que encontremos.
        
        if (empty($name) || empty($lastname) || empty($email) || empty($phone)) {
            $error = 'Por favor completa todos los campos obligatorios.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'El formato del email no es válido.';
        }
        
        // 3. Decidimos qué hacer basándonos en si hubo un error o no.
        if ($error) {
            // Si hubo un error, lo mostramos y redirigimos.
            Session::flash('error', $error);
            $this->redirect('/contacto');
        } else {
            // Si todo está bien, procesamos el envío y mostramos un mensaje de éxito.
            Session::flash('success', '¡Mensaje enviado correctamente! Te contactaremos pronto.');
            $this->redirect('/contacto?success=1');
        }
    }
}
