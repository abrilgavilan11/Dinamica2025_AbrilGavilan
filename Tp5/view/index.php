<?php
include_once '../configuracion.php';
include_once '../controller/session.php';

// Iniciar sesión


// Verificar si el usuario ya ha iniciado sesión
if (isset($_SESSION["nombreUsuario"]) && isset($_SESSION['psw'])) {
    header('Location: paginaSegura.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Autenticación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Sistema de Autenticación</h1>
                <p class="hero-subtitle">Gestiona usuarios y roles de forma segura y eficiente</p>
                
                <div class="hero-buttons mb-5">
                    <a href="login.php" class="btn btn-hero btn-hero-primary">
                        Iniciar Sesión
                    </a>
                    <a href="listarUsuario.php" class="btn btn-hero btn-hero-secondary">
                        Ver Usuarios Registrados
                    </a>
                </div>

                <!-- Features Section -->
                <div class="row g-4 mt-5">
                    <div class="col-md-4">
                        <div class="feature-card">
                            <div class="feature-icon">🔒</div>
                            <h3 class="feature-title">Seguridad</h3>
                            <p class="feature-description">
                                Sistema seguro de autenticación y gestión de sesiones
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card">
                            <div class="feature-icon">👥</div>
                            <h3 class="feature-title">Gestión de Usuarios</h3>
                            <p class="feature-description">
                                Administración completa de usuarios del sistema
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card">
                            <div class="feature-icon">🎯</div>
                            <h3 class="feature-title">Control de Roles</h3>
                            <p class="feature-description">
                                Sistema avanzado de roles y permisos
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="assets/js/validaciones.js"></script>
</body>
</html>