<?php

namespace App\Controllers;

class BaseController
{
    /**
     * Carga una vista y le pasa datos.
     *
     * @param string $view El nombre de la vista (ej. 'public.home').
     * @param array $data Los datos que estarán disponibles en la vista.
     */
    protected function view($view, $data = [])
    {
        // 1. Convierte la notación de puntos (ej. 'public.home') en una ruta de archivo real.
        //    (ej. 'C:\php\...\app/Views/public/home.php')
        $viewFile = VIEWS_PATH . '/' . str_replace('.', '/', $view) . '.php';
        
        // 2. Verifica si el archivo de la vista realmente existe.
        if (file_exists($viewFile)) {
            // Si existe, lo incluye. El array $data estará disponible dentro de la vista.
            require $viewFile;
        } else {
            // Si no existe, detiene la aplicación y muestra un error claro.
            // Esto es un error de desarrollo, por lo que es bueno que sea visible.
            die("Error: La vista '{$view}' no fue encontrada en la ruta: {$viewFile}");
        }
    }

    /**
     * Redirige al usuario a una nueva URL.
     *
     * @param string $url La URL a la que se va a redirigir.
     */
    protected function redirect($url)
    {
        // Envía el encabezado HTTP para la redirección.
        header("Location: {$url}");
        // Detiene la ejecución del script para asegurar que la redirección ocurra inmediatamente.
        exit;
    }

    /**
     * Envía una respuesta en formato JSON. Útil para APIs o peticiones AJAX.
     *
     * @param mixed $data Los datos a convertir en JSON.
     * @param int $statusCode El código de estado HTTP (ej. 200 para éxito, 400 para error).
     */
    protected function json($data, $statusCode = 200)
    {
        // Establece el código de estado HTTP (ej. 200 OK, 404 Not Found, etc.).
        http_response_code($statusCode);
        // Indica al navegador que la respuesta es de tipo JSON.
        header('Content-Type: application/json');
        // Convierte el array de PHP a una cadena de texto JSON y lo imprime.
        echo json_encode($data);
        // Detiene la ejecución del script.
        exit;
    }
}
