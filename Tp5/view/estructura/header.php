<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Login</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts - Merriweather -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header class="header-fixed">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="../view/index.php">
                    <span class="brand-icon">🔐</span>
                    Sistema Seguro
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <?php
                        // Carga robusta de configuración y sesión
                        $configPath = dirname(__DIR__,2).'/configuracion.php';
                        if (file_exists($configPath)) {
                            include_once $configPath;
                        }
                        if (!class_exists('Session')) {
                            include_once dirname(__DIR__,2).'/controller/session.php';
                        }

                        $session = new Session();
                        $baseView = '/Abril/view'; // Ajustar si cambia el nombre del proyecto

                        if ($session->validar()) {
                            $usuario = $session->getUsuario();
                            echo '<li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>';
                            echo '<li class="nav-item"><a class="nav-link" href="listarUsuario.php">Usuarios</a></li>';
                            echo '<li class="nav-item"><a class="nav-link btn-logout" href="action/cerrarSesion.php">Cerrar Sesión</a></li>';
                            $nombre = ($usuario && method_exists($usuario,'getUsnombre')) ? htmlspecialchars($usuario->getUsnombre()) : 'Usuario';
                            echo '<li class="nav-item"><span class="nav-link user-info">👤 ' . $nombre . '</span></li>';
                        } else {
                            echo '<li class="nav-item"><a class="nav-link" href="login.php">Iniciar Sesión</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    
    <main class="main-content">
