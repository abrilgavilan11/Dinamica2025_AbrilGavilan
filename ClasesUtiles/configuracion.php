<?php
header('Content-Type: text/html; charset=utf-8');
header("Cache-Control: no-cache, must-revalidate");

// Iniciar sesión
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Definir ruta raíz del proyecto
$ROOT = __DIR__ . '/';
$_SESSION['ROOT'] = $ROOT;

// Incluir funciones
include_once($ROOT . 'util/funciones.php');

// Configuración de base de datos (si la necesitan más adelante)
$DB_HOST = 'localhost';
$DB_NAME = 'qr_payment';
$DB_USER = 'root';
$DB_PASS = '';

// URLs del proyecto
$BASE_URL = "http://" . $_SERVER['HTTP_HOST'] . "/qr-payment-system";
$INICIO = "Location:" . $BASE_URL . "/vista/index.php";
$RESUMEN = "Location:" . $BASE_URL . "/vista/resumen.php";
$PAGO = "Location:" . $BASE_URL . "/vista/pago.php";
?>
