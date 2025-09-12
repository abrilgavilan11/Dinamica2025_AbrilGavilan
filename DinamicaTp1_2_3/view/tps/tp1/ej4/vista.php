<?php
    include_once __DIR__ . '/../../../../controller/encapsulamiento/encapsulado.php';
    include_once __DIR__ . '/../../../../controller/tp1/4ver_edad.php';

    // Procesamiento del formulario
    $resultado = "";
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $objEdad = new ver_edad();
        $resultado = $objEdad->ejercicio4();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 4</title>
    <link rel="stylesheet" href="/DinamicaTp1_2_3/view/css/styles.css">
    <script>
        function validarFormulario() {
            const edad = document.getElementsByName("edad")[0].value;
            let esValido = true;

            if (edad === "" || isNaN(edad) || edad < 0 || edad > 120) {
                alert("Por favor, ingrese una edad válida entre 0 y 120.");
                esValido = false;
            }

            return esValido;
        }
    </script>
</head>
<body>
    <?php include_once __DIR__ . '/../../../estructura/header.php'; ?>

    <h2>Ejercicio 4 - Mayor o menor de edad</h2>

    <div class="container">
        <div class="card">
            <form action="ejercicio4.php" method="post" onsubmit="return validarFormulario();">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" required>

                <label for="apellido">Apellido:</label>
                <input type="text" name="apellido" required>

                <label for="edad">Edad:</label>
                <input type="number" name="edad" required>

                <label for="direccion">Dirección:</label>
                <input type="text" name="direccion" required>

                <input type="submit" value="Enviar">
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
