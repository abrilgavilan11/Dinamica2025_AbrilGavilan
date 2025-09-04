<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 7</title>
    <link rel="stylesheet" href="ej7_style.css">
</head>
<body>
    <h1>Calculadora - Ejercicio 7</h1>
    <form action="resultado.php" method="post">
        <label for="op1">Operando 1:</label>
        <input type="text" id="op1" name="op1" required>
        <br>
        <label for="op2">Operando 2:</label>
        <input type="text" id="op2" name="op2" required>
        <br>
        <label for="operacion">Operación:</label>
        <select id="operacion" name="operacion" required>
            <option value="suma">SUMA</option>
            <option value="resta">RESTA</option>
            <option value="multiplicacion">MULTIPLICACION</option>
            <option value="division">DIVISION</option>
        </select>
        <br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>

