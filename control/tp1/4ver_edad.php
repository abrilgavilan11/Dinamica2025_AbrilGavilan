<?php
$nombre = isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '';
$apellido = isset($_POST['apellido']) ? htmlspecialchars($_POST['apellido']) : '';
$edad = isset($_POST['edad']) ? (int)$_POST['edad'] : null;
$direccion = isset($_POST['direccion']) ? htmlspecialchars($_POST['direccion']) : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado - Ejercicio 4</title>
    <link rel="stylesheet" href="../view/tp1/ej4_style.css">
</head>
<body>
    <h1>Resultado</h1>
    <?php if ($edad !== null) : ?>
        <p>
            Hola, yo soy <?php echo $nombre; ?> <?php echo $apellido; ?>, tengo <?php echo $edad; ?> años y vivo en <?php echo $direccion; ?>.
        </p>
        <?php if ($edad >= 18) : ?>
            <p><strong>Eres mayor de edad.</strong></p>
        <?php else : ?>
            <p><strong>No eres mayor de edad.</strong></p>
        <?php endif; ?>
    <?php else : ?>
        <p>Falta el parámetro <code>edad</code> en la URL.</p>
    <?php endif; ?>
    <button><a href="../view/tp1/ej4Vista.php">Volver al formulario</a></button>
</body>
</html>

