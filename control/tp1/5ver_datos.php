<?php
$nombre = isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '';
$apellido = isset($_POST['apellido']) ? htmlspecialchars($_POST['apellido']) : '';
$edad = isset($_POST['edad']) ? (int)$_POST['edad'] : null;
$direccion = isset($_POST['direccion']) ? htmlspecialchars($_POST['direccion']) : '';
$estudios = isset($_POST['estudios']) ? $_POST['estudios'] : '';
$sexo = isset($_POST['sexo']) ? $_POST['sexo'] : '';

function mapearEstudios($valor) {
    switch ($valor) {
        case '1': return 'No tiene estudios';
        case '2': return 'Estudios primarios';
        case '3': return 'Estudios secundarios';
        default: return 'No especificado';
    }
}

function mapearSexo($valor) {
    switch ($valor) {
        case 'F': return 'Femenino';
        case 'M': return 'Masculino';
        case 'X': return 'Otro / Prefiere no decir';
        default: return 'No especificado';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos - Ejercicio 5</title>
    <link rel="stylesheet" href="../view/tp1/ej5_style.css">
</head>
<body>
    <h1>Datos recibidos</h1>
    <?php if ($edad !== null) : ?>
        <p>
            Hola, yo soy <?php echo $nombre; ?> <?php echo $apellido; ?>, tengo <?php echo $edad; ?> años y vivo en <?php echo $direccion; ?>.
        </p>
        <p>
            Nivel de estudios: <strong><?php echo htmlspecialchars(mapearEstudios($estudios)); ?></strong>
        </p>
        <p>
            Sexo: <strong><?php echo htmlspecialchars(mapearSexo($sexo)); ?></strong>
        </p>
    <?php else : ?>
        <p>Faltan parámetros requeridos en la URL.</p>
    <?php endif; ?>

    <button><a href="../view/tp1/ej5Vista.php">Volver al formulario</a></button>
</body>
</html>

