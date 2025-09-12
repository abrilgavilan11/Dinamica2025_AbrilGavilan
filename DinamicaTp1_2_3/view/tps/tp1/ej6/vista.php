<?php
    include_once __DIR__ . '/../../../../controller/encapsulamiento/encapsulado.php';
    include_once __DIR__ . '/../../../../controller/tp1/6cant_deportes.php';

    // Procesamiento del formulario
    $resultado = "";
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $obj = new usuarioDeportes();
        $resultado = $obj->ejercicio6();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 6</title>
    <link rel="stylesheet" href="/DinamicaTp1_2_3/view/css/styles.css">
    <script>
        function validarFormulario() {
            const edad = document.getElementsByName("edad")[0].value;
            const sexo = document.getElementsByName("sexo")[0].value;
            let esValido = true;

            if (edad === "" || isNaN(edad) || edad < 0 || edad > 120) {
                alert("Ingrese una edad válida entre 0 y 120.");
                esValido = false;
            }

            if (sexo === "") {
                alert("Seleccione un sexo.");
                esValido = false;
            }

            return esValido;
        }
    </script>
</head>
<body>
    <?php include_once __DIR__ . '/../../../estructura/header.php'; ?>

    <h1>Ejercicio 6 - Deportes que practica</h1>

    <div class="container">
        <div class="card">
            <h2>Formulario con POST</h2>
            <form action="ejercicio6.php" method="post" onsubmit="return validarFormulario();">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" required>

                <label for="apellido">Apellido:</label>
                <input type="text" name="apellido" required>

                <label for="edad">Edad:</label>
                <input type="number" name="edad" required>

                <label for="direccion">Dirección:</label>
                <input type="text" name="direccion" required>

                <label>Nivel de estudios:</label>
                <div class="radio-group">
                    <label><input type="radio" name="estudios" value="1" required> Sin estudios</label>
                    <label><input type="radio" name="estudios" value="2"> Primarios</label>
                    <label><input type="radio" name="estudios" value="3"> Secundarios</label>
                </div>

                <label for="sexo">Sexo:</label>
                <select name="sexo" required>
                    <option value="">Seleccione...</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Otro">Otro</option>
                </select>

                <label>Deportes que practica:</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="deportes[]" value="Natacion"> Natacion</label>
                    <label><input type="checkbox" name="deportes[]" value="Fútbol"> Fútbol</label>
                    <label><input type="checkbox" name="deportes[]" value="Básquet"> Básquet</label>
                    <label><input type="checkbox" name="deportes[]" value="Tenis"> Tenis</label>
                    <label><input type="checkbox" name="deportes[]" value="Vóley"> Vóley</label>
                </div>

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
