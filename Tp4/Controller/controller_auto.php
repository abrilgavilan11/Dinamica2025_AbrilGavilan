<?php
    include_once(__DIR__ . '/../configuracion.php');
    include_once(__DIR__ . '/../Model/auto.php');

    class AbmAuto {
        public function buscar($param = null) {
            $resultado = [];

            if ($param != null) {
                if (isset($param['Patente'])) {
                    $obj = new Auto();
                    $obj->setPatente($param['Patente']);
                    if ($obj->cargar()) {
                        $resultado[] = $obj;
                    }
                } elseif (isset($param['DniDuenio'])) {
                    $condicion = "DniDuenio = '" . $param['DniDuenio'] . "'";
                    $resultado = Auto::listar($condicion);
                } else {
                    $resultado = Auto::listar();
                }
            } else {
                $resultado = Auto::listar();
            }

            return $resultado;
        }
    }
?>
