<!-- filepath: c:\php\pwd\tp1\verhoras.php -->
<?php
$dias = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
$horas = isset($_POST['horas']) ? $_POST['horas'] : [];
$total = 0;

if (count($horas) == 7) {
    foreach ($horas as $h) {
        $total += is_numeric($h) ? (int)$h : 0;
    }
} else {
    $total = "Error: Debe ingresar las horas para cada día.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Total de horas semanales</title>
</head>
<body>
    <h1>Total de horas semanales</h1>
    <?php if (is_numeric($total)): ?>
        <p>La cantidad total de horas cursadas en la semana es: <strong><?php echo $total; ?></strong></p>
    <?php else: ?>
        <p><?php echo $total; ?></p>
    <?php endif; ?>
    <a href="../view/tp1/ej2Vista.php">Volver al formulario</a>
</body>
</html>