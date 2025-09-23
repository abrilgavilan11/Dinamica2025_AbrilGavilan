<?php
include_once(__DIR__ . '/../configuracion.php');
include_once(__DIR__ . '/../Model/auto.php');

class AbmAuto {
    public function buscar($param = null) {
        $resultado = [];

        if ($param != null && isset($param['Patente'])) {
            $obj = new Auto();
            $obj->setPatente($param['Patente']);
            if ($obj->cargar()) {
                $resultado[] = $obj;
            }
        } else {
            $resultado = Auto::listar();
        }

        return $resultado;
    }
}
?>
