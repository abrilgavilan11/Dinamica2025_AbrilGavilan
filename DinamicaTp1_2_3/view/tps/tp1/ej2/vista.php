<?php
    include_once __DIR__ . '/../../../../controller/encapsulamiento/encapsulado.php';
    include_once __DIR__ . '/../../../../controller/tp1/2cant_horas_semana.php';

    // Procesamiento del formulario
    $resultado = "";
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $objHoras = new CantidadHorasSemana();
        $resultado = $objHoras->horas();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Horas de cursada</title>
    <link rel="stylesheet" href="/DinamicaTp1_2_3/view/css/ej2.css">
    <script>
        function validarFormulario() {
            const dias = ["lunes", "martes", "miercoles", "jueves", "viernes"];
            let esValido = true;

            for (let i = 0; i < dias.length; i++) {
                const valor = document.getElementById(dias[i]).value;
                if (valor === "" || isNaN(valor) || valor < 0) {
                    alert("Por favor, ingrese horas válidas para " + dias[i]);
                    esValido = false;
                }
            }

            return esValido;
        }
    </script>
</head>
<body>
    <h1>Horas de cursada de Programación Web Dinámica</h1>
    <form action="ejercicio2.php" method="post" onsubmit="return validarFormulario();">
        <label for="lunes">Lunes:</label>
        <input type="number" id="lunes" name="lunes" min="0" required><br><br>

        <label for="martes">Martes:</label>
        <input type="number" id="martes" name="martes" min="0" required><br><br>

        <label for="miercoles">Miércoles:</label>
        <input type="number" id="miercoles" name="miercoles" min="0" required><br><br>

        <label for="jueves">Jueves:</label>
        <input type="number" id="jueves" name="jueves" min="0" required><br><br>

        <label for="viernes">Viernes:</label>
        <input type="number" id="viernes" name="viernes" min="0" required><br><br>

        <input type="submit" value="Calcular total de horas">
    </form>

    <?php if ($resultado !== ""): ?>
        <div class="resultado">
            <p>Total de horas cursadas: <?php echo $resultado; ?></p>
        </div>
    <?php endif; ?>
</body>
</html>


