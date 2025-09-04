<?php
// a) Función darMes
function darMes($numero) {
    $meses = [
        1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril",
        5 => "Mayo", 6 => "Junio", 7 => "Julio", 8 => "Agosto",
        9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre"
    ];
    $resultado = "Mes inválido";
    // Verifica si existe un elemento en el array $meses con la clave $numero.
    if (isset($meses[$numero])) {
        $resultado = $meses[$numero];
    }
    return $resultado;
}

// b) Función para dar formato a una fecha "dd/mm/aaaa" a "aaaa-mm-dd"
function formatoFecha($fecha) {
    $partes = explode("/", $fecha);
    $resultado = "Formato inválido";
    if (count($partes) == 3) {
        $resultado = $partes[2] . "-" . $partes[1] . "-" . $partes[0];
    }
    return $resultado;
}

// c) Función para calcular el IVA
function calcularIVA($monto, $porcentaje = 21) {
    $iva = $monto * $porcentaje / 100;
    return $iva;
}

// d) Función PesosADolares
function PesosADolares($importe, $cotizacion) {
    if ($cotizacion == 0) {
        $cotizacion = 6;
    }
    $dolares = $importe / $cotizacion;
    $resultado = "La cantidad de $importe pesos equivalen a " . round($dolares, 2) . " u\$s.";
    return $resultado;
}

// e) Función para redondear a dos decimales
function redondearDosDecimales($numero) {
    // Redondea el valor de $numero a 2 decimales.
    $resultado = round($numero, 2);
    return $resultado;
}

// f) Función para reemplazar coma por punto en un float
function comaAPunto($numero) {
    // Reemplaza todas las comas por puntos en el string $numero.
    $resultado = str_replace(',', '.', $numero);
    return $resultado;
}

// g) Función para calcular la edad a partir de la fecha de nacimiento
function calcularEdad($fechaNacimiento) {
    $fechaNac = new DateTime($fechaNacimiento);
    $hoy = new DateTime();
    // Calcula la diferencia en años entre las fechas $hoy y $fechaNac.
    $edad = $hoy->diff($fechaNac)->y;
    return $edad;
}

// h) Función para calcular el promedio de un array de valores
function promedio($valores) {
    $resultado = 0;
    if (count($valores) > 0) {
        // Suma todos los elementos del array $valores.
        $resultado = array_sum($valores) / count($valores);
    }
    return $resultado;
}
?>