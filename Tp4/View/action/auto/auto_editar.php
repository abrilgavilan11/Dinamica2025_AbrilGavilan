<?php
include_once(__DIR__ . '/../../../configuracion.php');
include_once(__DIR__ . '/../../../Controller/controller_auto.php');
include_once(__DIR__ . '/../../../Util/funciones.php');
include_once(__DIR__ . '/../../../Model/auto.php');


  $datos = data_submitted();
  $objAbmAuto = new AbmAuto();
  $auto = null;

  if (isset($datos['Patente'])) {
    $lista = $objAbmAuto->buscar($datos);
    if (count($lista) == 1) {
      $auto = $lista[0];
    }
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Auto</title>
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

  <!--Main -->
  <main class="container text-center" style="margin-top: 100px;">
    <div class="container mt-5">
      <h2 class="text-center text-warning mb-4">Editar Datos del Auto</h2>

      <?php if ($auto != null): ?>
        <form method="post" action="../action_auto.php" class="mx-auto" style="max-width: 600px;">
          <input type="hidden" name="accion" value="editar">
          <input type="hidden" name="Patente" value="<?= $auto->getPatente(); ?>">

          <div class="mb-3">
            <label for="Marca" class="form-label">Marca</label>
            <input type="text" name="Marca" id="Marca" class="form-control" value="<?= $auto->getMarca(); ?>" required>
          </div>
          <div class="mb-3">
            <label for="Modelo" class="form-label">Modelo</label>
            <input type="text" name="Modelo" id="Modelo" class="form-control" value="<?= $auto->getModelo(); ?>" required>
          </div>
          <div class="mb-3">
            <label for="DniDuenio" class="form-label">DNI del Dueño</label>
            <input type="text" name="DniDuenio" id="DniDuenio" class="form-control" value="<?= $auto->getDniDuenio(); ?>" required>
          </div>

          <div class="text-center">
            <input type="submit" value="Guardar Cambios" class="btn btn-warning">
          </div>
        </form>
      <?php else: ?>
        <div class="alert alert-danger text-center">No se encontró un auto con esa patente.</div>
      <?php endif; ?>

      <div class="text-center mt-4">
        <a href="auto_buscar_editar.php" class="btn btn-secondary">Buscar otro auto</a>
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
