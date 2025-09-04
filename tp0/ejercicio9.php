<?php
    // Array de 10 números enteros
    $numeros = [12, 45, 7, 89, 23, 56, 34, 90, 11, 67];

    // Suponemos que el primer elemento es el máximo
    $maximo = $numeros[0];

    // Recorrer el array para encontrar el máximo
    for ($i = 1; $i < count($numeros); $i++) {
        if ($numeros[$i] > $maximo) {
            $maximo = $numeros[$i];
        }
    }

    // Mostrar el máximo
    echo "El número máximo es: $maximo";
?>