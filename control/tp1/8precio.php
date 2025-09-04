<?php
$edad = isset($_POST['edad']) ? (int)$_POST['edad'] : null;
$esEstudiante = isset($_POST['estudiante']);

function calcularPrecio($edad, $esEstudiante) {
	$precio = 300;
	if ($esEstudiante && $edad >= 12) {
		$precio = 180;
	} elseif ($esEstudiante || $edad < 12) {
		$precio = 160;
	}
	return $precio;
}

$precio = null;
if ($edad !== null) {
    $precio = calcularPrecio($edad, $esEstudiante);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Precio - Cinem@s</title>
    <link rel="stylesheet" href="../view/tp1/ej8_style.css">
</head>
<body>
    <h1>Resultado</h1>
    <?php if ($edad === null): ?>
        <p>Faltan datos para calcular.</p>
    <?php else: ?>
        <p>Edad: <strong><?php echo $edad; ?></strong></p>
        <p>Condición de estudiante: <strong><?php echo $esEstudiante ? 'Sí' : 'No'; ?></strong></p>
        <p>Precio de la entrada: <strong>$<?php echo $precio; ?></strong></p>
    <?php endif; ?>

    <button><a href="../view/tp1/ej8Vista.php">Volver a consultar</a></button>
</body>
</html>

