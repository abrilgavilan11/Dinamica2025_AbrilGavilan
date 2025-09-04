<?php
include 'funcionesVariasEj12.php';

// a) Probar darMes
echo "Mes 3: " . darMes(3) . "\n";

// b) Probar formatoFecha
echo "Fecha 25/12/2020 a formato: " . formatoFecha("25/12/2020") . "\n";

// c) Probar calcularIVA
echo "IVA de 1000 (21%): " . calcularIVA(1000) . "\n";

// d) Probar PesosADolares
echo PesosADolares(1200, 0) . "\n";

// e) Probar redondearDosDecimales
echo "Redondear 3.14159: " . redondearDosDecimales(3.14159) . "\n";

// f) Probar comaAPunto
echo "Coma a punto en '3,14': " . comaAPunto('3,14') . "\n";

// g) Probar calcularEdad
echo "Edad para nacimiento 2000-08-22: " . calcularEdad("2000-08-22") . "\n";

// h) Probar promedio
$valores = [10, 8, 7, 9, 6];
echo "Promedio: " . promedio($valores) . "\n";
?>