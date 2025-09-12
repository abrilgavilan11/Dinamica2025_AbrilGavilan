<?php
    include_once __DIR__ . '/../encapsulamiento/encapsulado.php';
    
    class varNumero{
        public function ejercicio1(){
            $metodo = encapsuladorDeMetodos();
            $respuesta = "No se encontró número";
            
            if (isset($metodo['num'])) {
                $numero = $metodo['num'];
    
                if ($numero > 0) {
                    $respuesta = "Positivo";
                } else if ($numero == 0) {
                    $respuesta = "Cero";
                } else {
                    $respuesta = "Negativo";
                }
            }
            return $respuesta;
        }
    }
?>