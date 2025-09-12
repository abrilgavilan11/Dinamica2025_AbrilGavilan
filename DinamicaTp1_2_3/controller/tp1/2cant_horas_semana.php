<?php
    include_once __DIR__ . '/../encapsulamiento/encapsulado.php';

    class CantidadHorasSemana {
        public function horas(){
            $metodo = encapsuladorDeMetodos();
            $dias = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes'];
            $horasTotales = 0;

            foreach ($dias as $dia) {
                if (isset($metodo[$dia]) && is_numeric($metodo[$dia])) {
                    $horasTotales += $metodo[$dia];
                }
            }

            return $horasTotales;
        }
    }
?>
