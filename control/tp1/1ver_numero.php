<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number = $_POST['number'];

    if (is_numeric($number)) {
        if ($number > 0) {
            $message = "El número $number es positivo.";
        } elseif ($number < 0) {
            $message = "El número $number es negativo.";
        } else {
            $message = "El número es cero.";
        }
    } else {
        $message = "Por favor, ingrese un número válido.";
    }
} else {
    header("Location: ../view/tp1/ej1Vista.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>
    <h1>Resultado</h1>
    <p><?php echo $message; ?></p>
    <a href="../view/tp1/ej1Vista.php">Volver al formulario</a>
</body>
</html>