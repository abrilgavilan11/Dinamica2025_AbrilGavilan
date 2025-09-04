<?php
$op1 = isset($_POST['op1']) ? $_POST['op1'] : '';
$op2 = isset($_POST['op2']) ? $_POST['op2'] : '';
$operacion = isset($_POST['operacion']) ? $_POST['operacion'] : '';

function esNumero($valor) {
    return is_numeric($valor);
}

$error = '';
if (!esNumero($op1) || !esNumero($op2)) {
    $error = 'Ambos operandos deben ser numéricos.';
}

$resultado = null;
if ($error === '') {
    $a = (float)$op1;
    $b = (float)$op2;
    switch ($operacion) {
        case 'suma':
            $resultado = $a + $b;
            break;
        case 'resta':
            $resultado = $a - $b;
            break;
        case 'multiplicacion':
            $resultado = $a * $b;
            break;
        case 'division':
            if ($b == 0.0) {
                $error = 'No se puede dividir por cero.';
            } else {
                $resultado = $a / $b;
            }
            break;
        default:
            $error = 'Operación no válida.';
    }
}

function etiquetaOperacion($op) {
    switch ($op) {
        case 'suma': return 'SUMA';
        case 'resta': return 'RESTA';
        case 'multiplicacion': return 'MULTIPLICACION';
        case 'division': return 'DIVISION';
        default: return 'DESCONOCIDA';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado - Ejercicio 7</title>
    <link rel="stylesheet" href="../view/tp1/ej7_style.css">
</head>
<body>
    <h1>Resultado</h1>
    <?php if ($error !== ''): ?>
        <p><?php echo htmlspecialchars($error); ?></p>
    <?php else: ?>
        <p>Operación: <strong><?php echo htmlspecialchars(etiquetaOperacion($operacion)); ?></strong></p>
        <p>Operando 1: <strong><?php echo htmlspecialchars((string)$op1); ?></strong></p>
        <p>Operando 2: <strong><?php echo htmlspecialchars((string)$op2); ?></strong></p>
        <p>Resultado: <strong><?php echo $resultado; ?></strong></p>
    <?php endif; ?>

    <button><a href="../view/tp1/ej7Vista.php">Volver al formulario</a></button>
</body>
</html>

