<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 8 - Cinem@s</title>
    <link rel="stylesheet" href="ej8_style.css">
</head>
<body>
    <h1>Cálculo de entrada - Cinem@s</h1>
    <form action="precio.php" method="post">
        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" min="0" required>
        <br>
        <label>
            <input type="checkbox" name="estudiante" value="1"> Soy estudiante
        </label>
        <br>
        <button type="submit">Calcular</button>
        <button type="reset">Limpiar</button>
    </form>
</body>
</html>

