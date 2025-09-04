<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 6</title>
    <link rel="stylesheet" href="ej6_style.css">
</head>
<body>
    <h1>Formulario - Ejercicio 6</h1>
    <form action="ver_deportes.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>
        <br>

        <fieldset>
            <legend>Deportes que practica</legend>
            <label>
                <input type="checkbox" name="deportes[]" value="natacion"> Natación
            </label>
            <label>
                <input type="checkbox" name="deportes[]" value="futbol"> Fútbol
            </label>
            <label>
                <input type="checkbox" name="deportes[]" value="basket"> Basket
            </label>
            <label>
                <input type="checkbox" name="deportes[]" value="tennis"> Tennis
            </label>
            <label>
                <input type="checkbox" name="deportes[]" value="voley"> Vóley
            </label>
            <label>
                <input type="checkbox" name="deportes[]" value="atletismo"> Atletismo
            </label>
        </fieldset>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>

