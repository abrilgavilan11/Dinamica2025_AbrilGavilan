<?php
    // Crear un array asociativo con los datos personales
    $datos = [
        "apellido" => "Gavilan",
        "nombre" => "Abril",
        "documento" => "46404056",
        "direccion" => "Av. Argentina"
    ];

    // Obtener las claves y valores en arrays separados
    $claves = array_keys($datos);
    $valores = array_values($datos);

    // Inicializar el índice
    $i = 0;

    // Recorrer el array usando while
    while ($i < count($datos)) {
        echo $claves[$i] . ": " . $valores[$i] . "\n";
        $i++;
    }
?>