<?php
    include_once __DIR__ . '/../encapsulamiento/encapsulado.php';

    class calculadora{
        public function ejercicio7(){
            $string = "";
            $metodo = encapsuladorDeMetodos();
            $resp = 0;
            if (isset($metodo['number1']) && $metodo['number1'] != "" && $metodo['number2'] != "") {
                $operacion = $metodo['operacion'];
                if ($operacion == "suma") {
                    $resp = $metodo['number1'] + $metodo['number2'];
                } elseif ($operacion == "resta") {
                    $resp = $metodo['number1'] - $metodo['number2'];
                } elseif ($operacion == "multiplicacion") {
                    $resp = $metodo['number1'] * $metodo['number2'];
                }
            } else {
                $resp = "No se pudó obtener los operandos";
            }

            $string = "Al hacer la " . $metodo['operacion'] . " de: " . $metodo['number1'] . " y " . $metodo['number2'] . ". El resultado da " . $resp;
            return $string;
        }
    }
?>