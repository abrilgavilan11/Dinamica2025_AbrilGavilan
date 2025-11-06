<?php
include_once('../modelo/rol.php');

class AbmRol {
    
    /**
     * Carga un objeto Rol con los datos del parámetro
     * @param array $param
     * @return Rol|null
     */
    private function cargarObjeto($param) {
        $obj = null;
        
        if (array_key_exists('idrol', $param) && array_key_exists('roldescripcion', $param)) {
            $obj = new Rol();
            $obj->cargar($param['idrol'], $param['roldescripcion']);
        }
        
        return $obj;
    }
    
    /**
     * Carga un objeto Rol solo con la clave primaria
     * @param array $param
     * @return Rol|null
     */
    private function cargarObjetoConClave($param) {
        $obj = null;
        
        if (isset($param['idrol'])) {
            $obj = new Rol();
            $obj->setIdrol($param['idrol']);
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
        
        if (isset($param['idrol'])) {
            $resp = true;
        }
        
        return $resp;
    }
    
    /**
     * Inserta un nuevo rol
     * @param array $param
     * @return boolean
     */
    public function alta($param) {
        $resp = false;
        $param['idrol'] = null;
        $obj = $this->cargarObjeto($param);
        
        if ($obj != null && $obj->insertar()) {
            $resp = true;
        }
        
        return $resp;
    }
    
    /**
     * Elimina un rol
     * @param array $param
     * @return boolean
     */
    public function baja($param) {
        $resp = false;
        
        if ($this->seteadosCamposClaves($param)) {
            $obj = $this->cargarObjetoConClave($param);
            
            if ($obj != null && $obj->cargar($param['idrol'], '') && $obj->eliminar()) {
                $resp = true;
            }
        }
        
        return $resp;
    }
    
    /**
     * Modifica los datos de un rol
     * @param array $param
     * @return boolean
     */
    public function modificacion($param) {
        $resp = false;
        
        if ($this->seteadosCamposClaves($param)) {
            $obj = $this->cargarObjeto($param);
            
            if ($obj != null && $obj->modificar()) {
                $resp = true;
            }
        }
        
        return $resp;
    }
    
    /**
     * Busca roles según los parámetros
     * @param array $param
     * @return array
     */
    public function buscar($param) {
        $where = " true ";
        
        if ($param != null) {
            if (isset($param['idrol'])) {
                $where .= " AND idrol = " . $param['idrol'];
            }
            if (isset($param['roldescripcion'])) {
                $where .= " AND roldescripcion = '" . $param['roldescripcion'] . "'";
            }
        }
        
        $obj = new Rol();
        $arreglo = $obj->listar($where);
        
        return $arreglo;
    }
}

?>
