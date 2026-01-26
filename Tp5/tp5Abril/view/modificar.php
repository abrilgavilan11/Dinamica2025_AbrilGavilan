<?php
include_once '../configuracion.php';
include_once '../controller/session.php';
// Correct controller filename (underscore instead of second hyphen)
include_once '../controller/abm-ver_usuarios.php';

$session = new Session();

// Validar sesión
if (!$session->validar()) {
    header('Location: login.php');
    exit();
}

// Obtener datos del usuario a modificar
$datos = data_submitted();
$verUsuarios = new VerUsuarios();
$usuario = $verUsuarios->verUsuario($datos['idusuario']);
$rol = $verUsuarios->verRolesUsuario($datos['idusuario']);
$soloFecha = $usuario->getUsdeshabilitado() ? date('Y-m-d', strtotime($usuario->getUsdeshabilitado())) : '';

// Definir roles disponibles
$roles = [
    0 => 'Jefe',
    1 => 'Obrero',
    2 => 'Carpintero',
    3 => 'Sub-Jefe',
    4 => 'Barrendero'
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Usuario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-dark text-white d-flex justify-content-center align-items-center min-vh-100">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card bg-secondary bg-opacity-25 border-0 p-4">
                    <div class="card-body">
                        <h2 class="card-title text-center text-white mb-4">
                            <i class="bi bi-pencil-square"></i> Modificar Usuario
                        </h2>

                        <form action="accion/actualizarLogin.php" method="post" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="usnombre" class="form-label text-light">
                                    <i class="bi bi-person"></i> Nombre de Usuario
                                </label>
                                <input type="text" class="form-control" id="usnombre" name="usnombre" 
                                       value="<?php echo htmlspecialchars($usuario->getUsnombre()); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="uspass" class="form-label text-light">
                                    <i class="bi bi-key"></i> Contraseña
                                </label>
                                <input type="password" class="form-control" id="uspass" name="uspass" 
                                       placeholder="Dejar en blanco para mantener la actual">
                            </div>

                            <div class="mb-3">
                                <label for="usmail" class="form-label text-light">
                                    <i class="bi bi-envelope"></i> Email
                                </label>
                                <input type="email" class="form-control" id="usmail" name="usmail" 
                                       value="<?php echo htmlspecialchars($usuario->getUsmail()); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="usfecha" class="form-label text-light">
                                    <i class="bi bi-calendar"></i> Fecha de Habilitación
                                </label>
                                <input type="date" class="form-control" id="usfecha" name="usfecha" 
                                       value="<?php echo $soloFecha; ?>">
                            </div>

                            <div class="mb-4">
                                <label for="idrol" class="form-label text-light">
                                    <i class="bi bi-person-badge"></i> Rol
                                </label>
                                <select class="form-select" id="idrol" name="idrol" required>
                                    <?php foreach ($roles as $id => $descripcion): ?>
                                        <option value="<?php echo $id; ?>" 
                                                <?php echo ($id == $rol->getIdrol()) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars(ucfirst($descripcion)); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <input type="hidden" name="idusuario" value="<?php echo $usuario->getIdusuario(); ?>">

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-lg"></i> Guardar Cambios
                                </button>
                                <a href="listarUsuario.php" class="btn btn-light">
                                    <i class="bi bi-arrow-left"></i> Volver
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Form validation
    (function() {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
    </script>
    <script src="assets/js/validaciones.js"></script>
</body>
</html>