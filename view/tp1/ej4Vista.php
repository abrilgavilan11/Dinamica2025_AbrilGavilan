<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 4</title>
    <link rel="stylesheet" href="ej4_style.css">
</head>
<body>
    <h1>Formulario - Ejercicio 4</h1>
    <form action="ver_edad.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>
        <br>
        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" min="0" required>
        <br>
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" required>
        <br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>

