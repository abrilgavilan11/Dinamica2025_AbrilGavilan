<?php
    // Array bidimensional asociativo: día => [materia, carga horaria]
    $horario = [
        "Lunes" => ["materia" => "Matemática", "carga_horaria" => 4],
        "Martes" => ["materia" => "Lengua", "carga_horaria" => 2],
        "Miércoles" => ["materia" => "Historia", "carga_horaria" => 2],
        "Jueves" => ["materia" => "Inglés", "carga_horaria" => 2],
        "Viernes" => ["materia" => "Programación", "carga_horaria" => 4]
    ];

    // Recorrer el array y mostrar la información
    foreach ($horario as $dia => $info) {
        echo "$dia: \n" . " -> Materia: " . $info["materia"] . "\n -> Carga horaria: " . $info["carga_horaria"] . " horas.\n";
    }
?>