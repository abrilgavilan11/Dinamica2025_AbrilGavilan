<?php
    include_once(__DIR__ . '/../../configuracion.php');
    include_once(__DIR__ . '/../../Controller/controller_auto.php');
    include_once(__DIR__ . '/../../Util/funciones.php');
    include_once(__DIR__ . '/../../Model/persona.php');

    $datos = data_submitted();
    $objAbmAuto = new AbmAuto();
    $mensaje = "";

    if (isset($datos['accion'])) {
        $accion = $datos['accion'];

        if ($accion == 'nuevo') {
            $duenio = new Persona();
            $duenio->setNroDni($datos['DniDuenio']);

            if ($duenio->cargar()) {
                $nuevo = new Auto();
                $nuevo->setear($datos['Patente'], $datos['Marca'], $datos['Modelo'], $datos['DniDuenio']);

                if ($nuevo->insertar()) {
                    $mensaje = "Auto registrado correctamente.";
                } else {
                    $mensaje = "Error al registrar auto: " . $nuevo->getMensajeOperacion();
                }
            } else {
                $mensaje = "No se puede registrar el auto porque el DNI del dueño no existe en la base.";
            }

        } elseif ($accion == 'editar') {
            $auto = new Auto();
            $auto->setear($datos['Patente'], $datos['Marca'], $datos['Modelo'], $datos['DniDuenio']);

            if ($auto->modificar()) {
                $mensaje = "Datos del auto modificados correctamente.";
            } else {
                $mensaje = "Error al modificar auto: " . $auto->getMensajeOperacion();
            }

        } elseif ($accion == 'eliminar') {
            $auto = new Auto();
            $auto->setPatente($datos['Patente']);

            if ($auto->eliminar()) {
                $mensaje = "Auto eliminado correctamente.";
            } else {
                $mensaje = "Error al eliminar auto: " . $auto->getMensajeOperacion();
            }

        } else {
            $mensaje = "Acción no reconocida.";
        }
    } else {
        $mensaje = "No se recibió ninguna acción.";
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resultado Alta Auto</title>
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
              <li class="nav-item"><a class="nav-link" href="../pages/consignas.php">Consignas</a></li>
              <li class="nav-item"><a class="nav-link" href="../pages/test.php">Test</a></li>
          </ul>
        </div>
    </div>
  </nav>

  <!--Main -->
  <main class="container text-center" style="margin-top: 100px;">
    <div class="container mt-5">
    <h2 class="text-center text-primary mb-4">Resultado del Registro</h2>
    <div class="alert alert-info text-center"><?= $mensaje ?></div>
    <div class="text-center mt-4">
        <a href="./auto/auto_nuevo.php" class="btn btn-success">Registrar otro auto</a>
        <a href="../../../index.php" class="btn btn-secondary">Volver al inicio</a>
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
