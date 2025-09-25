<?php
  include_once (__DIR__ . '../../../../configuracion.php');
  include_once (__DIR__ . '../../../../Controller/controller_persona.php');
  include_once (__DIR__ .'../../../../Model/persona.php');

$objAbmPersona = new AbmPersona();
$listaPersonas = $objAbmPersona->buscar(null);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Personas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="../../../index.php">Grupo 8</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
              <li class="nav-item"><a class="nav-link" href="../../pages/consignas.php">Consignas</a></li>
              <li class="nav-item"><a class="nav-link" href="../../pages/test.php">Test</a></li>
          </ul>
        </div>
    </div>
  </nav>

  <!-- Main -->
  <main class="container text-center" style="margin-top: 100px;">
    <div class="container mt-5">
      <h2 class="text-center text-primary mb-4">Listado de Personas</h2>

      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th>DNI</th>
            <th>Apellido</th>
            <th>Nombre</th>
            <th>Fecha Nac.</th>
            <th>Teléfono</th>
            <th>Domicilio</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($listaPersonas as $persona): ?>
            <tr>
              <td><?= $persona->getNroDni(); ?></td>
              <td><?= $persona->getApellido(); ?></td>
              <td><?= $persona->getNombre(); ?></td>
              <td><?= $persona->getFechaNac(); ?></td>
              <td><?= $persona->getTelefono(); ?></td>
              <td><?= $persona->getDomicilio(); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <div class="text-center mt-4">
        <a href="../../../index.php" class="btn btn-secondary">Volver al inicio</a>
      </div>
    </div>
  </main>

  <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <h5>Integrantes del Grupo 8</h5>
            <ul class="list-unstyled mb-3">
                <li>Abril Gavilan - Legajo: FAI-5163 - abril.gavilan@est.fi.uncoma.edu.ar</li>
                <li>Lucas San Segundo - Legajo: FAI-1921 - lucas.sansegundo@est.fi.uncoma.edu.ar</li>
                <li>Joaquín Castillo - Legajo: FAI-5521 - joaquin.castillo@est.fi.uncoma.edu.ar</li>
            </ul>
            <small>TP4 PHP & MySQL | Facultad de Informática</small>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
