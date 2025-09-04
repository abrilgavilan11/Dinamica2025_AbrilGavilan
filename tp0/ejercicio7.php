<?php
    // Array de 20 elementos con números reales (ventas diarias)
    $ventas = [120.5, 98.3, 110.0, 87.6, 130.2, 95.7, 102.4, 115.9, 123.8, 99.1,
               105.6, 112.3, 108.7, 117.5, 121.0, 109.9, 100.2, 113.4, 118.6, 104.8];

    $suma = 0;
    $cantidad = count($ventas);

    // Calcular la suma de las ventas usando un for
    for ($i = 0; $i < $cantidad; $i++) {
        $suma += $ventas[$i];
    }
    echo "El total de la suma es de " . $suma;

    // Calcular el promedio
    $promedio = $suma / $cantidad;

    // Mostrar el promedio
    echo "\nEl promedio de ventas es: " . number_format($promedio, 2, ',', '.') . "\n";
?>