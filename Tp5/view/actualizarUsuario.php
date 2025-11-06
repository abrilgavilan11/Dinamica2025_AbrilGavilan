<?php
include_once '../configuracion.php';
include_once '../controller/session.php';
include_once '../controller/abm-usuario.php';

$session = new Session();

// Validar sesión
if (!$session->validar()) {
    header('Location: login.php');
    exit();
}

// Obtener el ID del usuario a actualizar
$idusuario = isset($_GET['idusuario']) ? (int)$_GET['idusuario'] : null;

if ($idusuario == null) {
    header('Location: listarUsuario.php');
    exit();
}

$abmUsuario = new AbmUsuario();
$usuarios = $abmUsuario->buscar(['idusuario' => $idusuario]);

if (count($usuarios) == 0) {
    header('Location: listarUsuario.php');
    exit();
}

$usuario = $usuarios[0];

include_once 'estructura/header.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    ✏️ Actualizar Usuario
                </div>
                <div class="card-body">
                    <form id="updateForm" action="action/actualizarLogin.php" method="POST" onsubmit="return validarForm()">
                        <input type="hidden" name="idusuario" value="<?php echo htmlspecialchars($usuario->getIdusuario()); ?>">
                        
                        <div class="mb-3">
                            <label for="usnombre" class="form-label">Nombre de Usuario</label>
                            <input type="text" class="form-control" id="usnombre" name="usnombre" 
                                   value="<?php echo htmlspecialchars($usuario->getUsnombre()); ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="usmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="usmail" name="usmail" 
                                   value="<?php echo htmlspecialchars($usuario->getUsmail()); ?>" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="uspass" class="form-label">Nueva Contraseña (dejar en blanco para no cambiar)</label>
                            <input type="password" class="form-control" id="uspass" name="uspass" 
                                   minlength="6">
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                            <a href="listarUsuario.php" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script>
function validarForm() {
    const nombre = document.getElementById('usnombre').value.trim();
    const email = document.getElementById('usmail').value.trim();
    const pass = document.getElementById('uspass').value;
    
    let isValid = true;
    
    if (nombre === '') {
        alert('El nombre de usuario es requerido');
        isValid = false;
    } else if (email === '') {
        alert('El email es requerido');
        isValid = false;
    } else if (pass !== '' && pass.length < 6) {
        alert('La contraseña debe tener al menos 6 caracteres');
        isValid = false;
    }
    
    return isValid;
}
</script> -->

<script src="assets/js/validaciones.js"></script>
</body>
</html>
<?php include_once 'estructura/footer.php'; ?>