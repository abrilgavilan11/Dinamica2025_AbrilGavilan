<?php
include_once '../configuracion.php';
include_once '../controller/session.php';

$session = new Session();

// If already logged in, redirect to secure page
if ($session->validar()) {
    header('Location: paginaSegura.php');
    exit();
}

// Check for error message
$error = isset($_GET['error']) ? $_GET['error'] : '';

include_once 'estructura/header.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="login-container">
        <div class="card">
            <div class="card-header text-center">
                <div class="login-icon">🔐</div>
                Iniciar Sesión
            </div>
            <div class="card-body">
                <?php if ($error == '1'): ?>
                    <div class="alert alert-danger" role="alert">
                        Usuario o contraseña incorrectos. Por favor, intente nuevamente.
                    </div>
                <?php endif; ?>
                
                <form id="loginForm" action="action/verificarLogin.php" method="POST">
                    <div class="mb-3">
                        <label for="usnombre" class="form-label">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="usnombre" name="usnombre" placeholder="Ingrese su usuario">
                    </div>
                    
                    <div class="mb-4">
                        <label for="uspass" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="uspass" name="uspass" placeholder="Ingrese su contraseña">
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Ingresar</button>
                    </div>
                </form>
                
                <div class="mt-4 text-center">
                    <small class="text-muted">
                        Usuario de prueba: <strong>admin</strong> / Contraseña: <strong>admin123</strong>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="assets/js/validaciones.js"></script>
</body>
</html>


<?php include_once 'estructura/footer.php'; ?>
