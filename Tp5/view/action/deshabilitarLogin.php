<?php
include_once '../../configuracion.php';
include_once '../../controller/session.php';
include_once '../../controller/abm-usuario.php';

// Inicializar sesión y ABM Usuario
$session = new Session();
$abmUsuario = new AbmUsuario();

// Validar sesión
if (!$session->validar()) {
    header('Location: ../login.php');
    exit();
}

// Obtener datos enviados desde el formulario
$datos = data_submitted();
$resultado = false;

// Validar ID de usuario y realizar eliminación
if (isset($datos['idusuario'])) {
    $resultado = $abmUsuario->baja(['idusuario' => (int)$datos['idusuario']]);
}

// Cerrar sesión si el usuario elimina su propia cuenta
if ($resultado && $datos['idusuario'] == $session->getUsuario()->getIdusuario()) {
    $session->cerrar();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Usuario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body class="bg-dark text-white d-flex justify-content-center align-items-center vh-100 w-100">
    <div class="container text-center d-flex w-50 container-fluid">
        <div class="card bg-secondary bg-opacity-25 border-0 mx-auto p-4 w-100 align-items-center">
            <?php if ($resultado): ?>
                <div class="text-center">
                    <i class="bi bi-check-circle text-success display-1"></i>
                    <h1 class="mb-3 text-light">Usuario dehabilitado con éxito</h1>
                    <?php if ($session->activa()): ?>
                        <a href="../listarUsuario.php" class="btn btn-success">
                            <i class="bi bi-list"></i> Volver al listado
                        </a>
                    <?php else: ?>
                        <a href="../login.php" class="btn btn-primary">
                            <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
                        </a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="text-center">
                    <i class="bi bi-x-circle text-danger display-1"></i>
                    <h1 class="mb-3 text-light">Error al eliminar usuario</h1>
                    <a href="../listarUsuario.php" class="btn btn-danger">
                        <i class="bi bi-arrow-left"></i> Volver al listado
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>