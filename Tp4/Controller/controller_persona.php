<?php
include_once(__DIR__ . '/../configuracion.php');
include_once(__DIR__ . '/../Model/persona.php');

class AbmPersona {
    public function buscar($param = null) {
        $resultado = [];

        if ($param != null && isset($param['NroDni'])) {
            $obj = new Persona();
            $obj->setNroDni($param['NroDni']);
            if ($obj->cargar()) {
                $resultado[] = $obj;
            }
        } else {
            $resultado = Persona::listar();
        }

        return $resultado;
    }
}
?>
