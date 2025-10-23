<?php
include_once('../configuracion.php');
include_once('../util/funciones.php');

// Verificar que la petición sea POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../vista/monto.php');
    exit;
}

// Obtener y limpiar el monto enviado
$monto = sanitizar($_POST['monto'] ?? '');

// Validar que el monto sea un número válido y mayor a cero
if (!validarMonto($monto)) {
    $_SESSION['error'] = "El monto debe ser un número válido mayor a 0";
    header('Location: ../vista/monto.php');
    exit;
}

// Guardar el monto en sesión como número decimal
$_SESSION['monto'] = floatval($monto);

// Redirigir a la página de resumen
header('Location: ../vista/resumen.php');
exit;
?>
