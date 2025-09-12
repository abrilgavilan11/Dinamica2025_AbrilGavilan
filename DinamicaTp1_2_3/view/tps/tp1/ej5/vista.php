<?php
    include_once __DIR__ . '/../../../../controller/encapsulamiento/encapsulado.php';
    include_once __DIR__ . '/../../../../controller/tp1/5usuario_estudios.php';

    // Procesamiento del formulario
    $resultado = "";
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $obj = new usuarioEstudios();
        $resultado = $obj->ejercicio5();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 5</title>
    <link rel="stylesheet" href="/DinamicaTp1_2_3/view/css/styles.css">
    <script>
        function validarFormulario() {
            const estudios = document.getElementsByName("estudios")[0].value;
            const sexo = document.getElementsByName("sexo")[0].value;
            let esValido = true;

            if (estudios === "" || sexo === "") {
                alert("Por favor, complete todos los campos.");
                esValido = false;
            }

            return esValido;
        }
    </script>
</head>
<body>
    <?php include_once __DIR__ . '/../../../estructura/header.php'; ?>

    <h1>Ejercicio 5 - Estudios y sexo</h1>

    <div class="container">
        <div class="card">
            <h2>Formulario con POST</h2>
            <form action="ejercicio6.php" method="post" onsubmit="return validarFormulario();">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" required>

                <label for="apellido">Apellido:</label>
                <input type="text" name="apellido" required>

                <label for="estudios">Tipo de estudios:</label>
                <input type="text" name="estudios" required>

                <label for="sexo">Sexo:</label>
                <select name="sexo" required>
                    <option value="">Seleccione</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Otro">Otro</option>
                </select>

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
