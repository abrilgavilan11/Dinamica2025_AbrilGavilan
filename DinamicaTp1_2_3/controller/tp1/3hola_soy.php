<?php
    include_once __DIR__ . '/../encapsulamiento/encapsulado.php';

    class hola_soy{
        public function ejercicio3(){
            $metodo = encapsuladorDeMetodos();
            $mensaje = "No hay datos que mostrar.";

            $campos = ['nombre', 'apellido', 'edad', 'direccion'];
            $datosCompletos = true;

            foreach ($campos as $campo) {
                $datosCompletos = $datosCompletos && isset($metodo[$campo]) && trim($metodo[$campo]) !== '';
            }

            if ($datosCompletos) {
                $nombre = htmlspecialchars($metodo['nombre']);
                $apellido = htmlspecialchars($metodo['apellido']);
                $edad = htmlspecialchars($metodo['edad']);
                $direccion = htmlspecialchars($metodo['direccion']);

                $mensaje = "Hola, yo soy $nombre, $apellido, tengo $edad años y vivo en $direccion.";
            }

            return $mensaje;
        }
    }
?>
