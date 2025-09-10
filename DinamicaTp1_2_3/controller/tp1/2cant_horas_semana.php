<?php
    define('ROOT_PATH', dirname(__DIR__, 2));
    include_once ROOT_PATH . '/controller/encapsulamiento/encapsulado.php';
    
    /* Este código define una clase llamada CantidadHorasSemana que calcula la cantidad total
    de horas trabajadas de lunes a viernes.

    *   Dentro del método horas(), se usa la función encapsuladorDeMetodos() para
        obtener los datos enviados por el usuario (por POST o GET).
    *   Luego recorre los días de la semana (lunes a viernes) y, si el valor
        recibido para cada día existe y es numérico, lo suma a $horasTotales.
    *   Finalmente, devuelve el total acumulado.*/

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
