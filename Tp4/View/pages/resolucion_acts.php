<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>TP4 - Grupo 8</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="../../index.php">Grupo 8</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="consignas.php">Consignas</a></li>
            <li class="nav-item"><a class="nav-link" href="test.php">Test</a></li>
        </ul>
        </div>
    </div>
    </nav>

    <!--Main -->
    <main class="container text-center" style="margin-top: 100px;">
        <div class="row justify-content-center mt-5">
            <h2 class="display-4 text-primary">Resolución de Actividades</h2>
            <!-- Card de AUTO -->
            <div class="col-md-5">
                <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Formularios de Auto 🚗</h4>
                </div>
                <div class="card-body d-grid gap-2">
                    <?php
                    $formulariosAuto = [
                        'auto_buscar.php',
                        'auto_buscar_editar.php',
                        'auto_editar.php',
                        'auto_eliminar.php',
                        'auto_listar.php',
                        'auto_nuevo.php',
                        'auto_por_persona.php',
                        'auto_resultado.php'
                    ];
                    foreach ($formulariosAuto as $form) {
                        echo "<a href='../action/auto/$form' class='btn btn-outline-primary'>$form</a>";
                    }
                    ?>
                </div>
                </div>
            </div>

            <!-- Card de PERSONA -->
            <div class="col-md-5">
                <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Formularios de Persona 👤</h4>
                </div>
                <div class="card-body d-grid gap-2">
                    <?php
                    $formulariosPersona = [
                        'persona_autos.php',
                        'persona_buscar.php',
                        'persona_editar.php',
                        'persona_eliminar.php',
                        'persona_listar.php',
                        'persona_nuevo.php',
                        'persona_resultado.php'
                    ];
                    foreach ($formulariosPersona as $form) {
                        echo "<a href='../action/persona/$form' class='btn btn-outline-success'>$form</a>";
                    }
                    ?>
                </div>
                </div>
            </div>
        </div>
    </main>


    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <h5>Integrantes del Grupo 8</h5>
            <ul class="list-unstyled mb-3">
                <li>Abril Gavilan - Legajo: 12345 - abril.gavilan@mail.com</li>
                <li>Lucas San Segundo - Legajo: 67890 - lucas.sansegundo@mail.com</li>
                <li>Joaquín Castillo - Legajo: 54321 - joaquin.castillo@mail.com</li>
            </ul>
            <small>TP4 PHP & MySQL | Facultad de Informática</small>
        </div>
    </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
