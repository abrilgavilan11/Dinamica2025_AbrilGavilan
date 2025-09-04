<!-- filepath: c:\php\pwd\tp2\mostrar_datos.php -->
<?php
$nombre = isset($post['nombre']) ? htmlspecialchars($_POST['nombre']) : '';
$apellido = isset($post['apellido']) ? htmlspecialchars($_POST['apellido']) : '';
$edad = isset($_POST['edad']) ? (int)$_POST['edad'] : '';
$direccion = isset($_POST['direccion']) ? htmlspecialchars($_POST['direccion']) : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos recibidos</title>
</head>
<body>
    <p>
        Hola, yo soy <?php echo $nombre; ?> <?php echo $apellido; ?>, tengo <?php echo $edad; ?> años y vivo en <?php echo $direccion; ?>.
    </p>
    <a href="../view/tp1/ej3Vista.php">Volver al formulario</a>
</body>
</html>