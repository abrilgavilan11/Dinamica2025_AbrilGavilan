<?php
/**
 * Funciones auxiliares del proyecto
 */

/**
 * Sanitiza datos de entrada
 */
function sanitizar($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Valida que un campo no esté vacío
 */
function validarCampoVacio($campo) {
    $resultado = !empty($campo);
    return $resultado;
}

/**
 * Valida formato de DNI (solo números)
 */
function validarDNI($dni) {
    $resultado = preg_match('/^[0-9]{7,8}$/', $dni);
    return $resultado;
}

/**
 * Valida que el monto sea un número válido
 */
function validarMonto($monto) {
    $resultado = is_numeric($monto) && $monto > 0;
    return $resultado;
}

/**
 * Calcula el descuento aplicado
 */
function calcularDescuento($monto, $porcentaje) {
    return $monto - ($monto * ($porcentaje / 100));
}

/**
 * Formatea un monto a moneda
 */
function formatearMoneda($monto) {
    return '$' . number_format($monto, 2, ',', '.');
}
?>
