<?php
    include_once __DIR__ . '/../../../../controller/encapsulamiento/encapsulado.php';
    include_once __DIR__ . '/../../../../controller/tp1/1var_numero.php';

    // Procesamiento del formulario
    $resultado = "";
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $objNum = new varNumero();
        $resultado = $objNum->ejercicio1();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Ejercicio 1</title>
    <link rel="stylesheet" href="/DinamicaTp1_2_3/view/css/ej1.css">
    <script>
        function validarFormulario() {
            const numero = document.getElementById("num").value;
            let esValido = true;

            if (numero === "" || isNaN(numero)) {
                alert("Por favor, ingrese un número válido.");
                esValido = false;
            }

            return esValido;
        }
    </script>
</head>
<body>
    <h1>Ejercicio 1 - Ingresar un número</h1>
    <form action="ejercicio1.php" method="post" onsubmit="return validarFormulario();">
        <label for="num">Ingrese un número:</label>
        <input type="number" id="num" name="num" required step="any" />
        <input type="submit" value="Enviar" />
    </form>

    <?php if ($resultado !== ""): ?>
        <div class="resultado">
            <p>Resultado: <?php echo $resultado; ?></p>
        </div>
    <?php endif; ?>
</body>
</html>

