<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 3</title>
    <link rel="stylesheet" href="/DinamicaTp1_2_3/view/css/styles.css">
    <script>
        function validarFormulario(tipo) {
            const campos = ["nombre", "apellido", "edad", "direccion"];
            let esValido = true;

            campos.forEach(campo => {
                const id = campo + "_" + tipo;
                const valor = document.getElementById(id).value.trim();

                if (valor === "") {
                    alert("Por favor, complete el campo: " + campo);
                    esValido = false;
                } else if (campo === "edad" && (isNaN(valor) || valor < 0 || valor > 120)) {
                    alert("Ingrese una edad válida entre 0 y 120.");
                    esValido = false;
                }
            });

            return esValido;
        }
    </script>
</head>
<body>
    <?php include_once __DIR__ . '/../../../estructura/header.php'; ?>
    
    <h2>Ejercicio 3 - Datos personales</h2>

    <div class="container">
        <!-- Formulario POST -->
        <div class="card">
            <form action="/DinamicaTp1_2_3/view/tps/tp1/ej3/ejercicio3post.php" method="post" onsubmit="return validarFormulario('post');">
                <label for="nombre_post">Nombre:</label>
                <input type="text" id="nombre_post" name="nombre" required maxlength="50">

                <label for="apellido_post">Apellido:</label>
                <input type="text" id="apellido_post" name="apellido" required maxlength="50">

                <label for="edad_post">Edad:</label>
                <input type="number" id="edad_post" name="edad" required min="0" max="120">

                <label for="direccion_post">Dirección:</label>
                <input type="text" id="direccion_post" name="direccion" required maxlength="100">

                <input type="submit" value="Enviar">
            </form>
        </div>

        <!-- Formulario GET -->
        <div class="card">
            <h2>Formulario con GET</h2>
            <form action="/DinamicaTp1_2_3/view/tps/tp1/ej3/ejercicio3get.php" method="get" onsubmit="return validarFormulario('get');">
                <label for="nombre_get">Nombre:</label>
                <input type="text" id="nombre_get" name="nombre" required maxlength="50">

                <label for="apellido_get">Apellido:</label>
                <input type="text" id="apellido_get" name="apellido" required maxlength="50">

                <label for="edad_get">Edad:</label>
                <input type="number" id="edad_get" name="edad" required min="0" max="120">

                <label for="direccion_get">Dirección:</label>
                <input type="text" id="direccion_get" name="direccion" required maxlength="100">

                <input type="submit" value="Enviar">
            </form>
        </div>
    </div>

    <?php include_once __DIR__ . '/../../../estructura/footer.php'; ?>
</body>
</html>
