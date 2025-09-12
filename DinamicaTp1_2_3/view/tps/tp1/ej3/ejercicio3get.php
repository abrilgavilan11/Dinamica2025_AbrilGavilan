<?php
    include_once __DIR__ . '/../../../../controller/tp1/3hola_soy.php';

    $obj = new hola_soy();
    $mensaje = $obj->ejercicio3();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado GET</title>
    <link rel="stylesheet" href="/DinamicaTp1_2_3/view/css/styles.css">
</head>
<body>
    <?php include_once __DIR__ . '/../../../estructura/header.php'; ?>

    <h1>Resultado</h1>
    <p><?php echo $mensaje; ?></p>

    <div class="links">
        <a href="/DinamicaTp1_2_3/view/tps/tp1/ej3/vista.php">Volver al formulario</a>
        <a href="/DinamicaTp1_2_3/view/index.php">Inicio</a>
    </div>

    <?php include_once __DIR__ . '/../../../estructura/footer.php'; ?>
</body>
</html>
