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
include_once($ROOT . 'Util/funciones.php');

// Página de autenticación
$INICIO = "Location:http://" . $_SERVER['HTTP_HOST'] . "/TP4/vista/login/login.php";

// Página principal
$PRINCIPAL = "Location:http://" . $_SERVER['HTTP_HOST'] . "/TP4/principal.php";
?>
