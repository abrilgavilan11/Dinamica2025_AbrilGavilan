<?php
    include_once __DIR__ . '/../../../../controller/encapsulamiento/encapsulado.php';
    include_once __DIR__ . '/../../../../controller/tp1/7calculadora.php';

    // Procesamiento del formulario
    $resultado = "";
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $obj = new calculadora();
        $resultado = $obj->ejercicio7();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 7</title>
    <link rel="stylesheet" href="/DinamicaTp1_2_3/view/css/styles.css">
    <script>
        function validarFormulario() {
            const num1 = document.getElementsByName("number1")[0].value;
            const num2 = document.getElementsByName("number2")[0].value;
            const operacion = document.getElementsByName("operacion")[0].value;
            let esValido = true;

            if (num1 === "" || isNaN(num1)) {
                alert("Ingrese un número válido en el primer campo.");
                esValido = false;
            }

            if (num2 === "" || isNaN(num2)) {
                alert("Ingrese un número válido en el segundo campo.");
                esValido = false;
            }

            if (operacion === "") {
                alert("Seleccione una operación.");
                esValido = false;
            }

            return esValido;
        }
    </script>
</head>
<body>
    <?php include_once __DIR__ . '/../../../estructura/header.php'; ?>

    <h2>Ejercicio 7 - Calculadora simple</h2>

    <div class="container">
        <div class="card">
            <form action="ejercicio7.php" method="post" onsubmit="return validarFormulario();">
                <label for="number1">Primer número:</label>
                <input type="text" name="number1" required>

                <label for="number2">Segundo número:</label>
                <input type="text" name="number2" required>

                <label for="operacion">Operación:</label>
                <select name="operacion" required>
                    <option value="">Seleccione...</option>
                    <option value="suma">SUMA</option>
                    <option value="resta">RESTA</option>
                    <option value="multiplicacion">MULTIPLICACIÓN</option>
                </select>

                <input type="submit" value="Calcular">
            </form>
        </div>
    </div>

    <?php include_once __DIR__ . '/../../../estructura/footer.php'; ?>

    <?php if ($resultado !== ""): ?>
        <div class="resultado">
            <p><?php echo $resultado; ?></p>
        </div>
    <?php endif; ?>
</body>
</html>
