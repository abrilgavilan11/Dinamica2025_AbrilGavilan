<?php
    include_once __DIR__ . '/../encapsulamiento/encapsulado.php';

    class val_entradas{
        public function ejercicio8(){
            $string = "";
            $metodo = encapsuladorDeMetodos();
            $valor = 300;
            if (isset($metodo['edad'])) {
                if (isset($metodo['esEstudiante'])) {
                    $esEstudiante = $metodo['esEstudiante'];
                } else {
                    $esEstudiante = 'no definido';
                }
                if ($metodo['edad'] < 12 || $esEstudiante == "si") {
                    $valor = 160;
                }
                if ($metodo['edad'] >= 12 & $esEstudiante == "si") {
                    $valor = 180;
                }
            }
            $string = "El valor a pagar es de $" . $valor;
            return $string;
        }
    }
?>