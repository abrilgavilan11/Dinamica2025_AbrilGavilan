<?php
  include_once(__DIR__ . '../../../../configuracion.php');
  include_once(__DIR__ . '../../../../Controller/controller_persona.php');
  include_once(__DIR__ . '../../../../Util/funciones.php');

  $datos = data_submitted();
  $objAbmPersona = new AbmPersona();
  $persona = null;

  if (isset($datos['NroDni'])) {
    $lista = $objAbmPersona->buscar($datos);
    if (count($lista) == 1) {
      $persona = $lista[0];
    }
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Persona</title>
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
      <h2 class="text-center text-warning mb-4">Editar Datos de Persona</h2>

      <?php if ($persona != null): ?>
        <form method="post" action="../action_persona.php" class="mx-auto" style="max-width: 600px;">
          <input type="hidden" name="accion" value="editar">
          <input type="hidden" name="NroDni" value="<?= $persona->getNroDni(); ?>">

          <div class="mb-3">
            <label for="Apellido" class="form-label">Apellido</label>
            <input type="text" name="Apellido" id="Apellido" class="form-control" value="<?= $persona->getApellido(); ?>" required>
          </div>
          <div class="mb-3">
            <label for="Nombre" class="form-label">Nombre</label>
            <input type="text" name="Nombre" id="Nombre" class="form-control" value="<?= $persona->getNombre(); ?>" required>
          </div>
          <div class="mb-3">
            <label for="fechaNac" class="form-label">Fecha de Nacimiento</label>
            <input type="date" name="fechaNac" id="fechaNac" class="form-control" value="<?= $persona->getFechaNac(); ?>" required>
          </div>
          <div class="mb-3">
            <label for="Telefono" class="form-label">Teléfono</label>
            <input type="text" name="Telefono" id="Telefono" class="form-control" value="<?= $persona->getTelefono(); ?>" required>
          </div>
          <div class="mb-3">
            <label for="Domicilio" class="form-label">Domicilio</label>
            <input type="text" name="Domicilio" id="Domicilio" class="form-control" value="<?= $persona->getDomicilio(); ?>" required>
          </div>

          <div class="text-center">
            <input type="submit" value="Guardar Cambios" class="btn btn-warning">
          </div>
        </form>
      <?php else: ?>
        <div class="alert alert-danger text-center">No se encontró una persona con ese DNI.</div>
      <?php endif; ?>

      <div class="text-center mt-4">
        <a href="persona_buscar.php" class="btn btn-secondary">Buscar otra persona</a>
      </div>
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
