<?php
include_once('../model/usuario.php');
include_once('../model/rol.php');

class AbmUsuarioRol {
    
    /**
     * Carga una relación usuario-rol con los datos del parámetro
     * @param array $param
     * @return UsuarioRol|null
     */
    private function cargarObjeto($param) {
        $obj = null;
        
        if (array_key_exists('idusuario', $param) && array_key_exists('idrol', $param)) {
            $obj = new UsuarioRol();
            
            $objUsuario = new Usuario();
            $objUsuario->setIdusuario($param['idusuario']);
            $objUsuario->cargar($param['idusuario'], $param['idrol'], '', '', '', '');
            
            $objRol = new Rol();
            $objRol->setIdrol($param['idrol']);
            $objRol->cargar($param['idrol'], '');
            
            $obj->cargar($objUsuario, $objRol);
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
        
        if (isset($param['idusuario']) && isset($param['idrol'])) {
            $resp = true;
        }
        
        return $resp;
    }
    
    /**
     * Inserta una nueva relación usuario-rol
     * @param array $param
     * @return boolean
     */
    public function alta($param) {
        $resp = false;
        $obj = $this->cargarObjeto($param);
        
        if ($obj != null && $obj->insertar()) {
            $resp = true;
        }
        
        return $resp;
    }
    
    /**
     * Elimina una relación usuario-rol
     * @param array $param
     * @return boolean
     */
    public function baja($param) {
        $resp = false;
        
        if ($this->seteadosCamposClaves($param)) {
            $obj = $this->cargarObjeto($param);
            
            if ($obj != null && $obj->eliminar()) {
                $resp = true;
            }
        }
        
        return $resp;
    }
    
    /**
     * Busca relaciones usuario-rol según los parámetros
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
        }
        
        $obj = new UsuarioRol();
        $arreglo = $obj->listar($where);
        
        return $arreglo;
    }
    
    /**
     * Obtiene los roles de un usuario específico
     * @param int $idusuario
     * @return array
     */
    public function obtenerRolesUsuario($idusuario) {
        $roles = [];
        $param = ['idusuario' => $idusuario];
        $usuarioRoles = $this->buscar($param);
        
        foreach ($usuarioRoles as $ur) {
            array_push($roles, $ur->getObjRol());
        }
        
        return $roles;
    }
}

?>
