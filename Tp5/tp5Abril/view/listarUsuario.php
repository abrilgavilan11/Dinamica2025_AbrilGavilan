<?php
include_once '../configuracion.php';
include_once '../controller/session.php';
include_once '../controller/abm-usuario.php';
include_once '../controller/abm-ver_usuarios.php';

$session = new Session();

// Validar sesión
if (!$session->validar()) {
    header('Location: login.php');
    exit();
}

$abmUsuario = new AbmUsuario();
$abmVerUsuarios = new VerUsuarios();
$usuarios = $abmUsuario->buscar(null);

// Obtener mensaje de estado si existe
$mensaje = isset($_GET['mensaje']) ? $_GET['mensaje'] : '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<?php include_once 'estructura/header.php'; ?>
    <div class="container py-5">
        <div class="card mx-auto p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-white m-0">👥 Lista de Usuarios</h2>
                <a href="crearUsuario.php" class="btn btn-success btn-sm"><i class="bi bi-person-plus"></i> Nuevo</a>
            </div>

            <?php if ($mensaje): ?>
                <div class="alert alert-<?php echo $mensaje == 'error' ? 'danger' : 'success'; ?> alert-dismissible fade show" role="alert">
                    <?php
                    switch($mensaje) {
                        case 'actualizado':
                            echo 'Usuario actualizado correctamente.';
                            break;
                        case 'eliminado':
                            echo 'Usuario deshabilitado correctamente.';
                            break;
                        case 'error':
                            echo 'Ocurrió un error al procesar la solicitud.';
                            break;
                    }
                    ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($usuarios)): ?>
                            <tr>
                                <td colspan="6" class="text-center">No hay usuarios registrados</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($usuarios as $usuario): 
                                $rol = $abmVerUsuarios->verRolesUsuario($usuario->getIdusuario());
                                $rolNombre = is_object($rol) ? $rol->getRoldescripcion() : 'Sin rol';
                                $estadoActivo = $usuario->getUsdeshabilitado() === 'Habilitado';
                                $estado = $estadoActivo ? 'Activo' : 'Deshabilitado';
                                $estadoClass = $estadoActivo ? 'success' : 'danger';
                            ?>
                                <tr>
                                    <td><?php echo $usuario->getIdusuario(); ?></td>
                                    <td><?php echo $usuario->getUsnombre(); ?></td>
                                    <td><?php echo $usuario->getUsmail(); ?></td>
                                    <td><?php echo $rolNombre; ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo $estadoClass; ?>">
                                            <?php echo $estado; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="./actualizarUsuario.php?idusuario=<?php echo $usuario->getIdusuario(); ?>" class="btn btn-warning btn-sm" title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <?php if ($usuario->getUsdeshabilitado() === 'Habilitado'): ?>
                                                <form action="action/deshabilitarLogin.php" method="post" class="d-inline" title="Deshabilitar (baja lógica)">
                                                    <input type="hidden" name="idusuario" value="<?php echo $usuario->getIdusuario(); ?>">
                                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Deshabilitar este usuario? Podrá rehabilitarse luego.')">
                                                        <i class="bi bi-slash-circle"></i>
                                                    </button>
                                                </form>
                                                <form action="action/eliminarUsuario.php" method="post" class="d-inline" title="Eliminar definitivamente">
                                                    <input type="hidden" name="idusuario" value="<?php echo $usuario->getIdusuario(); ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Eliminar DEFINITIVAMENTE este usuario? Esta acción no se puede deshacer.')">
                                                        <i class="bi bi-trash3"></i>
                                                    </button>
                                                </form>
                                            <?php else: ?>
                                                <form action="action/habilitarUsuario.php" method="post" class="d-inline" title="Rehabilitar usuario">
                                                    <input type="hidden" name="idusuario" value="<?php echo $usuario->getIdusuario(); ?>">
                                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('¿Rehabilitar este usuario?')">
                                                        <i class="bi bi-check-circle"></i>
                                                    </button>
                                                </form>
                                                <form action="action/eliminarUsuario.php" method="post" class="d-inline" title="Eliminar definitivamente">
                                                    <input type="hidden" name="idusuario" value="<?php echo $usuario->getIdusuario(); ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Eliminar DEFINITIVAMENTE este usuario deshabilitado?')">
                                                        <i class="bi bi-trash3"></i>
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="text-center mt-4">
                <a href="index.php" class="btn btn-light">
                    <i class="bi bi-arrow-left"></i> Volver al Inicio
                </a>
            </div>
        </div>
    </div>
    <?php include_once 'estructura/footer.php'; ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alerts = document.getElementsByClassName('alert');
                for (let alert of alerts) {
                    alert.classList.remove('show');
                }
            }, 5000);
        });
    </script>
    <script src="assets/js/validaciones.js"></script>
</body>
</html>