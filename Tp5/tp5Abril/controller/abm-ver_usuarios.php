<?php 
include_once(__DIR__ . '/../configuracion.php');
include_once(__DIR__ . '/../model/rol.php');
include_once(__DIR__ . '/../model/usuario.php');

class VerUsuarios{
        
        /**
         * Lista todos los usuarios
         * @return array
         */
        public function listarUsuarios(){

            $obj = new Usuario();

            $arrayUsuarios = $obj->listar("usdeshabilitado IS NOT NULL");

            return $arrayUsuarios;
        }

        /**
         * Ver los datos de un usuario específico
         * @param int $idusuario
         * @return Usuario
         */
        public function verUsuario($idusuario){

            $obj = new Usuario();

            $obj->setIdusuario($idusuario);

            $obj->buscar($idusuario);

            return $obj;
        }

        /**
         * Modifica los datos de un usuario
         * @param array $datos
         * @return boolean
         */
        public function modificarUsuario($datos){

            $obj = new Usuario();
            $obj2 = new Rol();
            
            $resp = false;
            if ($obj->buscar($datos['idusuario']) && $obj2->buscar($datos['idrol'])) {
                $obj->setUsnombre($datos['usnombre']);
                $obj->setUspass($datos['uspass']);
                $obj->setUsmail($datos['usmail']);
                $obj->setUsdeshabilitado($datos['usfecha']);
                $obj2->setIdrol($datos['idrol']);
                $obj2->setRoldescripcion($datos['roldescripcion']);
                if($obj->modificar() && $obj2->modificar()){
                    $resp = true;
                }
            }
            return $resp;
        }

        /**
         * Ver los roles asignados a un usuario
         * @param int $idusuario
         * @return Rol
         */
        public function verRolesUsuario($idusuario){

            $usr = new Usuario();
            $rol = new Rol();

            if ($usr->buscar($idusuario)) {
                $idRol = $usr->getIdRol();
                if($rol->buscar($idRol)) {
                    return $rol;
                }
            }

            return null;
        }
        
        /**
         * Elimina un usuario (deshabilitándolo)
         * @param int $idusuario
         * @return boolean
         */
        public function eliminarUsuario($idusuario){

            $obj = new Usuario();
            $resp = false;
            if ($obj->buscar($idusuario)) { 
                $obj->setUsdeshabilitado(null);
                if($obj->modificar() !== false){
                    $resp = true;
                }
            }
            return $resp;
        }

        /**
         * Verifica si un usuario y contraseña son correctos
         * @param string $usuario
         * @param string $psw
         * @return boolean
         */
        public function verificarUsuarioLogueado($usuario, $psw){

            $obj = new Usuario();
            $resp = false;

            $query = "usnombre='" . $usuario . "' AND uspass='" . $psw . "' AND usdeshabilitado='Habilitado'";
            if(count($obj->listar($query)) > 0){
                $resp = true;
            }
            return $resp;
        }

        /**
         * Encuentra un usuario por nombre y contraseña
         * @param string $nombre
         * @param string $psw
         * @return Usuario|null
         */
        public function encontrarId($nombre, $psw){

            $obj = new Usuario();

            $usuario = null;
            
            $usuarios = $obj->listar("usnombre='" . $nombre . "' AND uspass='" . $psw . "' AND usdeshabilitado='Habilitado'");

            if (count($usuarios) >0 ){

                $usuario = $usuarios[0];
            }

            return $usuario;
        }
    }
?>