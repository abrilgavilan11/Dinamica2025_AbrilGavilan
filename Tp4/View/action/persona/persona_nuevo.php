<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Alta de Persona</title>
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
      <h2 class="text-center text-success mb-4">Registrar Nueva Persona</h2>

      <form method="post" action="../action_persona.php" class="mx-auto" style="max-width: 600px;">
        <div class="mb-3">
          <label for="NroDni" class="form-label">DNI</label>
          <input type="text" name="NroDni" id="NroDni" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="Apellido" class="form-label">Apellido</label>
          <input type="text" name="Apellido" id="Apellido" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="Nombre" class="form-label">Nombre</label>
          <input type="text" name="Nombre" id="Nombre" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="fechaNac" class="form-label">Fecha de Nacimiento</label>
          <input type="date" name="fechaNac" id="fechaNac" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="Telefono" class="form-label">Teléfono</label>
          <input type="text" name="Telefono" id="Telefono" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="Domicilio" class="form-label">Domicilio</label>
          <input type="text" name="Domicilio" id="Domicilio" class="form-control" required>
        </div>
        <input type="hidden" name="accion" value="nuevo">
        <div class="text-center">
          <input type="submit" value="Registrar" class="btn btn-success">
        </div>
      </form>

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
