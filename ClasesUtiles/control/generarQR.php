<?php
include_once('../configuracion.php');
require_once('qr/generadorQR.php');

if (!isset($_GET['monto'])) {
    http_response_code(400);
    echo 'Falta el parámetro monto';
    exit;
}

$monto = floatval($_GET['monto']);

try {
    $qr = new GeneradorQR();
    $qr->generarQR($monto);

    header('Content-Type: image/png');
    readfile(__DIR__ . '/../Vista/img/qr_generado.png');
} catch (Exception $e) {
    http_response_code(500);
    echo 'Error al generar QR: ' . $e->getMessage();
}
