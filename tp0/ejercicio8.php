<?php
    $nombres = array('roberto','juan','marta','moria','martin','jorge','miriam','nahuel','mirta');
    $nombres_m = array();

    // Usamos foreach porque es simple para recorrer arrays
    foreach ($nombres as $nombre) {
        // Verifica si el nombre comienza con la letra 'm', sin importar si está en mayúscula o minúscula.
        if (strtolower(substr($nombre, 0, 1)) === 'm') {
            $nombres_m[] = $nombre;
        }
    }

    // Mostrar los nombres que comienzan con 'm', uno debajo del otro
    foreach ($nombres_m as $nombre) {
        echo $nombre . "\n";
    }
?>