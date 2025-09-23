<?php
include_once '../../configuracion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>TP4 - Grupo 8</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    iframe {
      width: 100%;
      height: 800px;
      border: none;
    }
  </style>
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
        <div class="container mt-5">
            <h2 class="text-center text-primary mb-4">Test de Clases</h2>
            <p class="lead text-center mb-5">Esta sección permite probar el funcionamiento de las clases <strong>Auto</strong> y <strong>Persona</strong> mediante operaciones directas sobre la base de datos: insertar, modificar, eliminar y listar.</p>

            <div class="row justify-content-center g-4">
                <div class="col-md-4 text-center">
                <a href="../../Test/test_auto.php" class="btn btn-outline-info btn-lg w-100">Test Auto</a>
                </div>
                <div class="col-md-4 text-center">
                <a href="../../Test/test_persona.php" class="btn btn-outline-success btn-lg w-100">Test Persona</a>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="../../index.php" class="btn btn-secondary">Volver al inicio</a>
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
