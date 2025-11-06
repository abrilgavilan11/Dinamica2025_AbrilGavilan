<?php
include_once __DIR__ . '/../model/rol.php';
include_once __DIR__ . '/../model/usuario.php';
include_once __DIR__ . '/abm-ver_usuarios.php';
include_once('abm-usuario.php');
class Session {
    
    /**
     * Constructor - Inicia la sesión
     */
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    /**
     * Actualiza las variables de sesión con los datos de login
     * @param string $nombreUsuario
     * @param string $psw
     * @return boolean
     */
    public function iniciar($nombreUsuario, $psw) {
        $resp = false;
        $abmUsuario = new AbmUsuario();
        $param = ['usnombre' => $nombreUsuario];
        $usuarios = $abmUsuario->buscar($param);
        
        if (count($usuarios) > 0) {
            $usuario = $usuarios[0];
            // Comparación directa (plain text) para que funcione con datos actuales.
            // RECOMENDADO: migrar a password_hash + password_verify.
            if ($usuario->getUspass() === $psw && $usuario->getUsdeshabilitado() === 'Habilitado') {
                $_SESSION['idusuario'] = $usuario->getIdusuario();
                $_SESSION['usnombre'] = $usuario->getUsnombre();
                $resp = true;
            }
        }
        
        return $resp;
    }
    
    /**
     * Valida si la sesión actual tiene usuario y password válidos
     * @return boolean
     */
    public function validar() {
        $resp = false;
        
        if ($this->activa() && isset($_SESSION['idusuario'])) {
            $resp = true;
        }
        
        return $resp;
    }
    
    /**
     * Verifica si la sesión está activa
     * @return boolean
     */
    public function activa() {
        $resp = false;
        
        if (session_status() == PHP_SESSION_ACTIVE) {
            $resp = true;
        }
        
        return $resp;
    }
    
    /**
     * Devuelve el usuario logueado
     * @return Usuario|null
     */
    public function getUsuario() {
        $usuario = null;
        
        if ($this->validar()) {
            $abmUsuario = new AbmUsuario();
            $param = ['idusuario' => $_SESSION['idusuario']];
            $usuarios = $abmUsuario->buscar($param);
            
            if (count($usuarios) > 0) {
                $usuario = $usuarios[0];
            }
        }
        
        return $usuario;
    }
    
    /**
     * Devuelve el rol del usuario logueado
     * @return Rol|null
     */
    public function getRol() {
        $rol = null;
        
        if ($this->validar() && isset($_SESSION['idusuario'])) {
            $verUsuarios = new VerUsuarios();
            $rol = $verUsuarios->verRolesUsuario($_SESSION['idusuario']);
            // Verify that we have a Rol object
            if (!is_object($rol)) {
                return null;
            }
        }
        
        return $rol;
        
        return $roles;
    }
    
    /**
     * Cierra la sesión actual
     */
    public function cerrar() {
        session_unset();
        session_destroy();
    }
}

?>
