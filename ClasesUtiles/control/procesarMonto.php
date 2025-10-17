<?php
include_once('../configuracion.php');
include_once('../util/funciones.php');

// Verificar que sea una petición POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Obtener y sanitizar datos
    $monto = sanitizar($_POST['monto'] ?? '');
    
    // Validar monto
    if (!validarMonto($monto)) {
        $_SESSION['error'] = "El monto debe ser un número válido mayor a 0";
        header('Location: ../vista/monto.php');
        exit;
    }
    
    // Guardar en sesión
    $_SESSION['monto'] = floatval($monto);
    
    // Redirigir al resumen
    header('Location: ../vista/resumen.php');
    exit;
    
} else {
    header('Location: ../vista/monto.php');
    exit;
}
?>
