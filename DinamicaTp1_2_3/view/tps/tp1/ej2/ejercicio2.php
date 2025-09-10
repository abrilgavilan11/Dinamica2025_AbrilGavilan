<?php
    include_once __DIR__ . '/../../../../controller/tp1/2cant_horas_semana.php';

    $obj = new CantidadHorasSemana();
    $horasTotales = $obj->horas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
    <link rel="stylesheet" href="/DinamicaTp1_2_3/view/css/ej2.css">
</head>
<body>
    <h1>Resultado</h1>
    <p><?php echo $horasTotales; ?> horas totales registradas</p>

    <div class="links">
        <a href="/DinamicaTp1_2_3/view/tps/tp1/ej2/vista.php">Volver al formulario</a>
        <a href="http://localhost/DinamicaTp1_2_3/view/tps/tp1/">Inicio</a>
    </div>
</body>
</html>
