<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 5</title>
    <link rel="stylesheet" href="ej5_style.css">
</head>
<body>
    <h1>Formulario - Ejercicio 5</h1>
    <form action="ver_datos.php" method="post">
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

        <fieldset>
            <legend>Nivel de estudios</legend>
            <label>
                <input type="radio" name="estudios" value="1" required>
                1 - No tiene estudios
            </label>
            <label>
                <input type="radio" name="estudios" value="2">
                2 - Estudios primarios
            </label>
            <label>
                <input type="radio" name="estudios" value="3">
                3 - Estudios secundarios
            </label>
        </fieldset>

        <label for="sexo">Sexo:</label>
        <select id="sexo" name="sexo" required>
            <option value="" disabled selected>Seleccione...</option>
            <option value="F">Femenino</option>
            <option value="M">Masculino</option>
            <option value="X">Otro / Prefiero no decir</option>
        </select>
        <br>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>

