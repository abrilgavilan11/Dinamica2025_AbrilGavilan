<?php
include_once '../configuracion.php';
include_once '../controller/session.php';

$session = new Session();

// Validar sesión
if (!$session->validar()) {
    header('Location: login.php');
    exit();
}

// Obtener información del usuario y rol
$usuario = $session->getUsuario();
$rol = $session->getRol();

include_once 'estructura/header.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Segura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    🎉 Bienvenido al Sistema
                </div>
                <div class="card-body">
                    <h3 class="mb-4">Hola, <?php echo $usuario->getUsnombre(); ?>!</h3>
                    
                    <div class="alert alert-info">
                        <strong>Información de tu cuenta:</strong>
                        <ul class="mb-0 mt-2">
                            <li><strong>Usuario:</strong> <?php echo $usuario->getUsnombre(); ?></li>
                            <li><strong>Email:</strong> <?php echo $usuario->getUsmail(); ?></li>
                            <li><strong>Rol:</strong> 
                                <span class="badge <?php echo $rol ? 'bg-success' : 'bg-warning'; ?>">
                                    <?php 
                                    if (is_object($rol) && method_exists($rol, 'getRoldescripcion')) {
                                        echo $rol->getRoldescripcion();
                                    } else {
                                        echo 'Sin rol asignado';
                                    }
                                    ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="mt-4">
                        <h5>Acciones disponibles:</h5>
                        <div class="d-grid gap-2 d-md-block mt-3">
                            <a href="./listarUsuario.php" class="btn btn-primary me-2">
                                👥 Ver Lista de Usuarios
                            </a>
                            <a href="./action/cerrarSesion.php" class="btn btn-secondary">
                                🚪 Cerrar Sesión
                            </a>
                        </div>
                    </div>
                    
                    <div class="mt-5">
                        <h5>Información del Sistema:</h5>
                        <p class="text-muted">
                            Has iniciado sesión correctamente en el sistema de autenticación seguro. 
                            Este sistema utiliza encriptación MD5 para las contraseñas y gestión de 
                            sesiones PHP para mantener tu información segura.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="./assets/js/validaciones.js"></script>

<?php include_once 'estructura/footer.php'; ?>
</body>
</html>