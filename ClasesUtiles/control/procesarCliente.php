<?php
include_once('../configuracion.php');
include_once('../util/funciones.php');

// Verificar que sea una petición POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Obtener y sanitizar datos
    $nombre = sanitizar($_POST['nombre'] ?? '');
    $apellido = sanitizar($_POST['apellido'] ?? '');
    $dni = sanitizar($_POST['dni'] ?? '');
    
    // Validar campos
    $errores = [];
    
    if (!validarCampoVacio($nombre)) {
        $errores[] = "El nombre es obligatorio";
    }
    
    if (!validarCampoVacio($apellido)) {
        $errores[] = "El apellido es obligatorio";
    }
    
    if (!validarDNI($dni)) {
        $errores[] = "El DNI debe contener 7 u 8 dígitos";
    }
    
    // Si hay errores, redirigir con mensaje
    if (!empty($errores)) {
        $_SESSION['errores'] = $errores;
        header('Location: ../vista/inicio/index.php');
        exit;
    }
    
    // Redirigir a la página de monto
    header('Location: ../vista/monto.php');
    exit;
    
} else {
    // Si no es POST, redirigir al inicio
    header('Location: ../vista/index.php');
    exit;
}
?>
