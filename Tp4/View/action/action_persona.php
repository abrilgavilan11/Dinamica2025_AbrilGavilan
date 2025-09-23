<?php
include_once(__DIR__ . '/../../configuracion.php');
include_once(__DIR__ . '/../../Controller/controller_persona.php');
include_once(__DIR__ . '/../../Util/funciones.php');


    $datos = data_submitted();
    $objAbmPersona = new AbmPersona();
    $mensaje = "";

    if (isset($datos['accion'])) {
        $accion = $datos['accion'];

        if ($accion == 'nuevo') {
            $nueva = new Persona();
            $nueva->setear(
                $datos['NroDni'],
                $datos['Apellido'],
                $datos['Nombre'],
                $datos['fechaNac'],
                $datos['Telefono'],
                $datos['Domicilio']
            );

            if ($nueva->insertar()) {
                $mensaje = "Persona registrada correctamente.";
            } else {
                $mensaje = "Error al registrar persona: " . $nueva->getMensajeOperacion();
            }

        } elseif ($accion == 'editar') {
            $persona = new Persona();
            $persona->setear(
                $datos['NroDni'],
                $datos['Apellido'],
                $datos['Nombre'],
                $datos['fechaNac'],
                $datos['Telefono'],
                $datos['Domicilio']
            );

            if ($persona->modificar()) {
                $mensaje = "Datos modificados correctamente.";
            } else {
                $mensaje = "Error al modificar: " . $persona->getMensajeOperacion();
            }

        } elseif ($accion == 'eliminar') {
            $persona = new Persona();
            $persona->setNroDni($datos['NroDni']);

            if ($persona->eliminar()) {
                $mensaje = "Persona eliminada correctamente.";
            } else {
                $mensaje = "Error al eliminar persona: " . $persona->getMensajeOperacion();
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
  <title>Resultado Alta Persona</title>
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
            <a href="./persona/persona_nuevo.php" class="btn btn-success">Registrar otra persona</a>
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
