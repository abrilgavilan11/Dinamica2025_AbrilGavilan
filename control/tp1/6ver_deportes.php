<?php
$nombre = isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '';
$apellido = isset($_POST['apellido']) ? htmlspecialchars($_POST['apellido']) : '';
$deportes = isset($_POST['deportes']) && is_array($_POST['deportes']) ? $_POST['deportes'] : [];
$cantidad = count($deportes);

function formatearDeporte($valor) {
    switch ($valor) {
        case 'futbol': return 'Fútbol';
        case 'basket': return 'Basket';
        case 'tennis': return 'Tennis';
        case 'voley': return 'Vóley';
        default: return $valor;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Deportes - Ejercicio 6</title>
    <link rel="stylesheet" href="../view/tp1/ej6_style.css">
</head>
<body>
    <h1>Resultados</h1>
    <p>
        Alumno: <?php echo $nombre; ?> <?php echo $apellido; ?>
    </p>
    <p>
        Cantidad de deportes que practica: <strong><?php echo $cantidad; ?></strong>
    </p>
    <?php if ($cantidad > 0): ?>
        <div class="card">
            <p>Detalle:</p>
            <ul>
                <?php foreach ($deportes as $dep): ?>
                    <li><?php echo htmlspecialchars(formatearDeporte($dep)); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <button><a href="../view/tp1/ej6Vista.php">Volver al formulario</a></button>
</body>
</html>

