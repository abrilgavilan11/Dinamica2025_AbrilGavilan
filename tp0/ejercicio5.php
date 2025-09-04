<?php
    // Usando for
    for ($i = 1; $i <= 10; $i++) {
        echo "2 x $i es " . (2 * $i) . "\n";
    }

    echo "\n";

    // Usando while
    $i = 1;
    while ($i <= 10) {
        echo "2 x $i es " . (2 * $i) . "\n";
        $i++;
    }

    echo "\n";

    // Usando do/while
    $i = 1;
    do {
        echo "2 x $i es " . (2 * $i) . "\n";
        $i++;
    } while ($i <= 10);
?>