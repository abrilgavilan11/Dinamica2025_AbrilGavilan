<?php
include_once '../../configuracion.php';
include_once '../../controller/session.php';
include_once '../../controller/abm-usuario.php';

$session = new Session();

// Validar sesión
if (!$session->validar()) {
    header('Location: ../login.php');
    exit();
}

// Validar que sea una petición POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../listarUsuario.php');
    exit();
}

$datos = data_submitted();
$abmUsuario = new AbmUsuario();

// Preparar los datos para la actualización
$param = [
    'idusuario' => isset($datos['idusuario']) ? (int)$datos['idusuario'] : 0,
    'usnombre' => isset($datos['usnombre']) ? trim($datos['usnombre']) : '',
    'usmail' => isset($datos['usmail']) ? trim($datos['usmail']) : '',
    // Guardamos en texto plano para ser consistente con login actual (pendiente migrar a password_hash)
    'uspass' => isset($datos['uspass']) && !empty($datos['uspass']) ? $datos['uspass'] : '',
];

// Validar datos mínimos
if ($param['idusuario'] <= 0 || empty($param['usnombre']) || empty($param['usmail'])) {
    $resultado = false;
} else {
    // Si no se proporciona contraseña, mantener la actual
    if (empty($param['uspass'])) {
        $usuarios = $abmUsuario->buscar(['idusuario' => $param['idusuario']]);
        if (count($usuarios) > 0) {
            $param['uspass'] = $usuarios[0]->getUspass();
        }
    }
    
    $resultado = $abmUsuario->modificacion($param);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualización de Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-center">
                        <?php if($resultado): ?>
                            <h4 class="text-success mb-4">✅ Usuario actualizado con éxito</h4>
                        <?php else: ?>
                            <h4 class="text-danger mb-4">❌ Error al actualizar usuario</h4>
                        <?php endif; ?>
                        
                        <a href="../listarUsuario.php" class="btn btn-primary">Volver al listado</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>