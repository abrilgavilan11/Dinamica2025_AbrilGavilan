<?php
    include_once __DIR__ . '/../../../../controller/tp1/1var_numero.php';

    $objNum = new varNumero();
    $message = $objNum->ejercicio1();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
    <link rel="stylesheet" href="/DinamicaTp1_2_3/view/css/ej1.css">

</head>
<body>
    <h1>Resultado</h1>
    <p><?php echo $message; ?></p>
    <div class="links">
        <a href="/DinamicaTp1_2_3/view/tps/tp1/ej1/vista.php">Volver al formulario</a>
        <a href="http://localhost/DinamicaTp1_2_3/view/tps/tp1/">Inicio</a>
    </div>
</body>
</html>
