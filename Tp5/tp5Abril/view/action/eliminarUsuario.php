<?php
include_once '../../configuracion.php';
include_once '../../controller/session.php';
include_once '../../controller/abm-usuario.php';

$session = new Session();
if (!$session->validar()) {
    header('Location: ../login.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../listarUsuario.php');
    exit();
}
$datos = data_submitted();
$abmUsuario = new AbmUsuario();
$resultado = false;
if (isset($datos['idusuario'])) {
    $resultado = $abmUsuario->eliminar(['idusuario' => (int)$datos['idusuario']]);
}
// Si se elimina a sí mismo, cerrar sesión
if ($resultado && $session->getUsuario() && $session->getUsuario()->getIdusuario() == (int)$datos['idusuario']) {
    $session->cerrar();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Usuario (Hard Delete)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white d-flex justify-content-center align-items-center vh-100">
    <div class="container text-center d-flex w-50 container-fluid">
        <div class="card bg-secondary bg-opacity-25 border-0 mx-auto p-4 w-100 align-items-center">
            <?php if ($resultado): ?>
                <div class="text-center">
                    <i class="bi bi-check-circle text-success display-1"></i>
                    <h1 class="mb-3 text-light">Usuario eliminado con éxito</h1>
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
</body>
</html>