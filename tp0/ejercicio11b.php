<?php
    // Definición de la función saludo según la hora actual
    function saludo() {
        $hora = date("H"); // Hora en formato 24h (00-23)
        if ($hora >= 5 && $hora < 13) {
            return "Buenos días";
        } elseif ($hora >= 13 && $hora < 20) {
            return "Buenas tardes";
        } else {
            return "Buenas noches";
        }
    }

    $nombre = "Abril";
    echo "¡" . saludo() . ", $nombre!";
?>