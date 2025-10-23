<?php
include_once('../configuracion.php');
include_once('../util/funciones.php');

// Verificar que la petición sea POST (no GET ni otros métodos)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../vista/index.php');
    exit;
}

// Obtener y limpiar los datos enviados desde el formulario
$nombre = sanitizar($_POST['nombre'] ?? '');
$apellido = sanitizar($_POST['apellido'] ?? '');
$dni = sanitizar($_POST['dni'] ?? '');

// Array para almacenar los errores de validación
$errores = [];

// Validar que el nombre no esté vacío
if (!validarCampoVacio($nombre)) {
    $errores[] = "El nombre es obligatorio";
}

// Validar que el apellido no esté vacío
if (!validarCampoVacio($apellido)) {
    $errores[] = "El apellido es obligatorio";
}

// Validar que el DNI tenga el formato correcto (7 u 8 dígitos)
if (!validarDNI($dni)) {
    $errores[] = "El DNI debe contener 7 u 8 dígitos";
}

// Si hay errores, guardarlos en sesión y volver al formulario
if (!empty($errores)) {
    $_SESSION['errores'] = $errores;
    header('Location: ../vista/index.php');
    exit;
}

// Si todo está bien, guardar los datos en sesión y continuar
$_SESSION['cliente'] = [
    'nombre' => $nombre,
    'apellido' => $apellido,
    'dni' => $dni
];

header('Location: ../vista/monto.php');
exit;
?>
