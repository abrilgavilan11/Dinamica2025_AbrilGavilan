<?php
    // Definición de la función divisores
    function divisores($parametro) {
        $resultado = [];
        for ($i = 1; $i <= $parametro; $i++) {
            if ($parametro % $i == 0) {
                $resultado[] = $i;
            }
        }
        return $resultado;
    }

    $num = 20;
    echo "Los divisores de $num son: \n";
    foreach(divisores($num) as $divisor){
        echo "$divisor \n";
    }
?>