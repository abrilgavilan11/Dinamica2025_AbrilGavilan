<?php
    include_once __DIR__ . '/../encapsulamiento/encapsulado.php';
    
    class usuarioEstudios{
        public function ejercicio5(){
            $metodo = encapsuladorDeMetodos();
            $string = "No hay nada que mostrar";
            if (isset($metodo['estudios']) && isset($metodo['sexo'])) {
                $string = "Su tipo de estudios es " . $metodo['estudios'] . ", y su sexo es " . $metodo['sexo'];
            }

            return $string;
        }
    }
?>
