<?php
require_once __DIR__ . '/../../configuracion.php';
require_once __DIR__ . '/../../model/usuario.php';
require_once __DIR__ . '/../../model/rol.php';
require_once __DIR__ . '/../../controller/abm-ver_usuarios.php';
require_once __DIR__ . '/../../controller/session.php';


// Obtener datos del formulario de inicio de sesión
$datos = data_submitted();
$session = new Session();
$verUsuarios = new VerUsuarios();

try {
    // Verificar si se enviaron las credenciales
    if (isset($datos['usnombre']) && isset($datos['uspass'])) {
        $username = trim($datos['usnombre']);
        $password = trim($datos['uspass']);

        // Verificar si el usuario y la contraseña son correctos
        // Verificar credenciales (plaintext comparando según lógica actual)
        if (!$verUsuarios->verificarUsuarioLogueado($username, $password)) {
            header('Location: ../login.php?error=1');
            exit();
        }

        // Intentar iniciar sesión (establece variables básicas)
        if (!$session->iniciar($username, $password)) {
            header('Location: ../login.php?error=2'); // Fallo al iniciar sesión
            exit();
        }

        // Obtener usuario y rol para completar datos de sesión
        $usuario = $verUsuarios->encontrarId($username, $password);
        if (!$usuario) {
            header('Location: ../login.php?error=2'); // Usuario no encontrado
            exit();
        }

        $rol = $verUsuarios->verRolesUsuario($usuario->getIdusuario());
        if (!$rol) {
            header('Location: ../login.php?error=3'); // Usuario sin rol
            exit();
        }

        $_SESSION['rol'] = $rol->getRoldescripcion();
        $_SESSION['nombre'] = $usuario->getUsnombre();

        header('Location: ../paginaSegura.php');
        exit();
    } else {
        header('Location: ../login.php?error=4'); // Error: Datos incompletos
        exit();
    }
    
    // If we get here, authentication failed
    // header('Location: ../login.php?error=1');
    exit();
} catch (Exception $e) {
    // Log error and redirect
    error_log($e->getMessage());
    header('Location: ../login.php?error=2');
    exit();
}
?>