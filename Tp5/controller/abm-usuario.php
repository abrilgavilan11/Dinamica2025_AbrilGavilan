<?php
include_once(__DIR__ . '/../model/usuario.php');

class AbmUsuario {
    
    /**
     * Carga un objeto Usuario con los datos del parámetro
     * @param array $param
     * @return Usuario|null
     */
    private function cargarObjeto($param) {
        $obj = null;

        if (array_key_exists('idusuario', $param) && array_key_exists('idrol', $param) && array_key_exists('usnombre', $param) &&
            array_key_exists('uspass', $param) && array_key_exists('usmail', $param)) {
            
            $obj = new Usuario();
            $obj->cargar(
                $param['idusuario'],
                $param['idrol'],
                $param['usnombre'],
                $param['uspass'],
                $param['usmail'],
                array_key_exists('usdeshabilitado', $param) ? $param['usdeshabilitado'] : $param['usdeshabilitado'] = null
            );
        }

        return $obj;
    }
    
    /**
     * Carga un objeto Usuario solo con la clave primaria
     * @param array $param
     * @return Usuario|null
     */
    private function cargarObjetoConClave($param) {
        $obj = null;
        
        if (isset($param['idusuario'])) {
            $obj = new Usuario();
            $obj->setIdusuario($param['idusuario']);
        }
        
        return $obj;
    }
    
    /**
     * Verifica si están seteados los campos claves
     * @param array $param
     * @return boolean
     */
    private function seteadosCamposClaves($param) {
        $resp = false;
        
        if (isset($param['idusuario'])) {
            $resp = true;
        }
        
        return $resp;
    }
    
    /**
     * Inserta un nuevo usuario
     * @param array $param
     * @return boolean
     */
    public function alta($param) {
        $resp = false;
        $param['idusuario'] = null;
        $obj = $this->cargarObjeto($param);
        
        if ($obj != null && $obj->insertar()) {
            $resp = true;
        }
        
        return $resp;
    }
    
    /**
     * Elimina un usuario (borrado lógico)
     * @param array $param
     * @return boolean
     */
    public function baja($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $obj = $this->cargarObjetoConClave($param);
            if ($obj->buscar($param['idusuario'])) {
                // Mark as disabled keeping NOT NULL constraint
                $obj->setUsdeshabilitado('Deshabilitado');
                $resp = $obj->modificar();
            }
        }
        return $resp;
    }
    
    /**
     * Modifica los datos de un usuario
     * @param array $param
     * @return boolean
     */
    public function modificacion($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            // Obtener usuario existente
            $existentes = $this->buscar(['idusuario' => $param['idusuario']]);
            if (count($existentes) === 1) {
                $usuario = $existentes[0];
                if (isset($param['usnombre']) && $param['usnombre'] !== '') {
                    $usuario->setUsnombre($param['usnombre']);
                }
                if (isset($param['usmail']) && $param['usmail'] !== '') {
                    $usuario->setUsmail($param['usmail']);
                }
                if (isset($param['uspass']) && $param['uspass'] !== '') {
                    $usuario->setUspass($param['uspass']);
                }
                if (array_key_exists('usdeshabilitado', $param)) {
                    $usuario->setUsdeshabilitado($param['usdeshabilitado']);
                }
                if (isset($param['idrol'])) {
                    $usuario->setIdRol($param['idrol']);
                }
                $resp = $usuario->modificar();
            }
        }
        return $resp;
    }

    /**
     * Elimina físicamente un usuario de la base de datos
     * @param array $param
     * @return bool
     */
    public function eliminar($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $obj = $this->cargarObjetoConClave($param);
            if ($obj->buscar($param['idusuario'])) {
                $resp = $obj->eliminar();
            }
        }
        return $resp;
    }
    
    /**
     * Busca usuarios según los parámetros
     * @param array $param
     * @return array
     */
    public function buscar($param) {
        $where = " true ";
        
        if ($param != null) {
            if (isset($param['idusuario'])) {
                $where .= " AND idusuario = " . $param['idusuario'];
            }
            if (isset($param['idrol'])) {
                $where .= " AND idrol = " . $param['idrol'];
            }
            if (isset($param['usnombre'])) {
                $where .= " AND usnombre = '" . $param['usnombre'] . "'";
            }
            if (isset($param['usmail'])) {
                $where .= " AND usmail = '" . $param['usmail'] . "'";
            }
        }
        
        $obj = new Usuario();
        $arreglo = $obj->listar($where);
        
        return $arreglo;
    }
}

?>
