<?php
    include_once __DIR__ . '/../encapsulamiento/encapsulado.php';

    class usuarioDeportes{
        public function ejercicio6(){
            $string = "No hay nada que mostrar";
            $metodo = encapsuladorDeMetodos();
            if (isset($metodo['deportes'])) {
                $string = "La cantidad de deportes que practican son " . count($metodo['deportes']);
            }
            return $string;
        }
    }
?>