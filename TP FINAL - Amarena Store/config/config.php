<?php
/**
 * Configuración general de la aplicación
 */

// Configuración de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Zona horaria
date_default_timezone_set('America/Argentina/Buenos_Aires');

// Rutas base
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');
define('PUBLIC_PATH', BASE_PATH . '/public');
define('VIEWS_PATH', APP_PATH . '/Views');
define('CONFIG_PATH', BASE_PATH . '/config'); // Agregar ruta CONFIG_PATH

// URL base dinámica
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$scriptName = $_SERVER['SCRIPT_NAME'];
$basePath = dirname($scriptName);
$basePath = str_replace('\\', '/', $basePath); // Normalizar para Windows
$baseUrl = rtrim($protocol . $host . $basePath, '/');
define('BASE_URL', $baseUrl);

// Cargar autoloader de Composer primero
if (file_exists(BASE_PATH . '/vendor/autoload.php')) {
    require_once BASE_PATH . '/vendor/autoload.php';
}

use App\Utils\Session;
// Configuración de sesión
Session::init();
