<?php

// Iniciar sesión
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Definir ruta raíz del proyecto
$ROOT = __DIR__ . '/';
$_SESSION['ROOT'] = $ROOT;

// Incluir funciones
include_once($ROOT . 'util/funciones.php');

