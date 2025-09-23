<?php
include_once '../../../configuracion.php';
include_once '../../../controller/controller_persona.php';

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
</body>
</html>
