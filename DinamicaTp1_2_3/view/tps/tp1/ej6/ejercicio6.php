<?php
    include_once __DIR__ . '/../../../../controller/encapsulamiento/encapsulado.php';
    include_once __DIR__ . '/../../../../controller/tp1/6cant_deportes.php';

    $obj = new usuarioDeportes();
    $resultado = $obj->ejercicio6();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
    <link rel="stylesheet" href="/DinamicaTp1_2_3/view/css/styles.css">
</head>
<body>
    <?php include_once __DIR__ . '/../../../estructura/header.php'; ?>

    <h1>Resultado</h1>
    <p><?php echo $resultado; ?></p>

    <div class="links">
        <a href="/DinamicaTp1_2_3/view/tps/tp1/ej6/vista.php">Volver al formulario</a>
        <a href="/DinamicaTp1_2_3/view/index.php">Inicio</a>
    </div>

    <?php include_once __DIR__ . '/../../../estructura/footer.php'; ?>
</body>
</html>
