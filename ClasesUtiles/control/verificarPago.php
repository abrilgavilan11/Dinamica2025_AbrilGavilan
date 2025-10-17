<?php
include_once('../configuracion.php');
header('Content-Type: application/json');

// Obtener referencia del pago
$referencia = $_GET['ref'] ?? '';

$respuesta = [];

if (empty($referencia)) {
    $respuesta = [
        'success' => false,
        'message' => 'Referencia de pago no proporcionada'
    ];
} else {
    $pagoCompletado = (rand(0, 1) === 1);
    
    if ($pagoCompletado) {
        $respuesta = [
            'success' => true,
            'estado' => 'completado',
            'message' => 'Pago verificado exitosamente',
            'referencia' => $referencia,
            'fecha' => date('Y-m-d H:i:s')
        ];
    } else {
        $respuesta = [
            'success' => true,
            'estado' => 'pendiente',
            'message' => 'Pago aún no procesado',
            'referencia' => $referencia
        ];
    }
}

echo json_encode($respuesta);
exit;
?>
