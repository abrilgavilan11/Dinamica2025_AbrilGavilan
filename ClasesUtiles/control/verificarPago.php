<?php
include_once('../configuracion.php');

// Indicar que la respuesta será en formato JSON
header('Content-Type: application/json');

// Obtener la referencia del pago desde la URL
$referencia = $_GET['ref'] ?? '';

// Preparar la respuesta
$respuesta = [];

// Verificar que se haya proporcionado una referencia
if (empty($referencia)) {
    $respuesta = [
        'success' => false,
        'message' => 'Referencia de pago no proporcionada'
    ];
} else {
    $pagoCompletado = (rand(0, 1) === 1);
    
    if ($pagoCompletado) {
        // El pago fue procesado exitosamente
        $respuesta = [
            'success' => true,
            'estado' => 'completado',
            'message' => 'Pago verificado exitosamente',
            'referencia' => $referencia,
            'fecha' => date('Y-m-d H:i:s')
        ];
    } else {
        // El pago aún está pendiente
        $respuesta = [
            'success' => true,
            'estado' => 'pendiente',
            'message' => 'Pago aún no procesado',
            'referencia' => $referencia
        ];
    }
}

// Enviar la respuesta en formato JSON
echo json_encode($respuesta);
exit;
?>
