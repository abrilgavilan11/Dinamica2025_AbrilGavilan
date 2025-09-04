<?php
// Script para procesar el formulario de películas
// Ejercicio 4 - TP2

// Función para validar campos del formulario
function validarCamposFormulario($datos) {
    $campos_vacios = array();
    $campos_requeridos = array(
        'titulo', 'actores', 'director', 'guion', 'produccion', 
        'anio', 'nacionalidad', 'genero', 'duracion', 'restriccion', 'sinopsis'
    );
    
    foreach ($campos_requeridos as $campo) {
        if (empty($datos[$campo])) {
            $campos_vacios[] = ucfirst($campo);
        }
    }
    
    return $campos_vacios;
}

// Función para validar formato del año
function validarFormatoAnio($anio) {
    return preg_match("/^\d{4}$/", $anio);
}

// Función para validar formato de la duración
function validarFormatoDuracion($duracion) {
    return preg_match("/^\d{1,3}$/", $duracion);
}

// Función para validar rango del año
function validarRangoAnio($anio) {
    $anio_int = intval($anio);
    return $anio_int >= 1900 && $anio_int <= (date("Y") + 10);
}

// Función para validar rango de la duración
function validarRangoDuracion($duracion) {
    $duracion_int = intval($duracion);
    return $duracion_int >= 1 && $duracion_int <= 999;
}

// Función para obtener resultado de validación
function obtenerResultadoValidacion($campos_vacios, $anio, $duracion) {
    if (!empty($campos_vacios)) {
        return array(
            "mensaje" => "Error: Los siguientes campos están vacíos: " . implode(", ", $campos_vacios),
            "tipo" => "error"
        );
    }
    
    if (!validarFormatoAnio($anio)) {
        return array(
            "mensaje" => "Error: El año debe ser un número de 4 dígitos.",
            "tipo" => "error"
        );
    }
    
    if (!validarFormatoDuracion($duracion)) {
        return array(
            "mensaje" => "Error: La duración debe ser un número de 1 a 3 dígitos.",
            "tipo" => "error"
        );
    }
    
    if (!validarRangoAnio($anio)) {
        return array(
            "mensaje" => "Error: El año debe estar entre 1900 y " . (date("Y") + 10) . ".",
            "tipo" => "error"
        );
    }
    
    if (!validarRangoDuracion($duracion)) {
        return array(
            "mensaje" => "Error: La duración debe estar entre 1 y 999 minutos.",
            "tipo" => "error"
        );
    }
    
    return array(
        "mensaje" => "Película cargada exitosamente.",
        "tipo" => "exito"
    );
}

// Verificar si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y sanitizar los datos del formulario
    $datos_formulario = array(
        'titulo' => htmlspecialchars($_POST["titulo"] ?? ""),
        'actores' => htmlspecialchars($_POST["actores"] ?? ""),
        'director' => htmlspecialchars($_POST["director"] ?? ""),
        'guion' => htmlspecialchars($_POST["guion"] ?? ""),
        'produccion' => htmlspecialchars($_POST["produccion"] ?? ""),
        'anio' => htmlspecialchars($_POST["anio"] ?? ""),
        'nacionalidad' => htmlspecialchars($_POST["nacionalidad"] ?? ""),
        'genero' => htmlspecialchars($_POST["genero"] ?? ""),
        'duracion' => htmlspecialchars($_POST["duracion"] ?? ""),
        'restriccion' => htmlspecialchars($_POST["restriccion"] ?? ""),
        'sinopsis' => htmlspecialchars($_POST["sinopsis"] ?? "")
    );
    
    // Validar campos
    $campos_vacios = validarCamposFormulario($datos_formulario);
    $resultado = obtenerResultadoValidacion($campos_vacios, $datos_formulario['anio'], $datos_formulario['duracion']);
    
    $mensaje = $resultado["mensaje"];
    $tipo_mensaje = $resultado["tipo"];
} else {
    // Si no se recibió POST, redirigir al formulario
    header("Location: ../view/tp2/ej4Vista.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado - Cinem@s</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px 0;
        }
        
        .result-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0,0,0,0.1);
            padding: 2rem;
            max-width: 900px;
            margin: 0 auto;
        }
        
        .movie-info {
            background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
            border: 1px solid #bee5eb;
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
            position: relative;
        }
        
        .movie-title {
            color: #0c5460;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }
        
        .info-row {
            display: flex;
            margin-bottom: 1.2rem;
            align-items: center;
            padding: 0.5rem;
            border-radius: 8px;
            background: rgba(255,255,255,0.7);
        }
        
        .info-label {
            font-weight: 700;
            color: #0c5460;
            min-width: 180px;
            margin-right: 1rem;
            display: flex;
            align-items: center;
        }
        
        .info-label i {
            margin-right: 0.5rem;
            color: #17a2b8;
        }
        
        .info-value {
            color: #495057;
            flex: 1;
            font-weight: 500;
        }
        
        .btn-volver {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            border: none;
            border-radius: 25px;
            padding: 15px 30px;
            font-weight: 600;
            text-decoration: none;
            color: white;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,123,255,0.3);
        }
        
        .btn-volver:hover {
            background: linear-gradient(135deg, #0056b3 0%, #004085 100%);
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,123,255,0.4);
        }
        
        .error-container {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            border: 1px solid #f5c6cb;
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
            text-align: center;
        }
        
        .error-title {
            color: #721c24;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .error-message {
            color: #721c24;
            font-size: 1.2rem;
            font-weight: 500;
        }
        
        .close-icon {
            position: absolute;
            top: 20px;
            right: 25px;
            font-size: 2rem;
            color: #6c757d;
            cursor: pointer;
            transition: color 0.3s ease;
            background: rgba(255,255,255,0.8);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .close-icon:hover {
            color: #495057;
            background: rgba(255,255,255,1);
        }
        
        .success-icon {
            text-align: center;
            font-size: 4rem;
            color: #28a745;
            margin-bottom: 1rem;
        }
        
        .error-icon {
            text-align: center;
            font-size: 4rem;
            color: #dc3545;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="result-container">
                    <?php if ($tipo_mensaje === "exito"): ?>
                        <!-- Información de la película -->
                        <div class="movie-info position-relative">
                            <span class="close-icon" onclick="cerrarMensaje(this)">
                                <i class="bi bi-x-lg"></i>
                            </span>
                            
                            <div class="success-icon">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            
                            <h3 class="movie-title">
                                <i class="bi bi-film"></i>
                                La película introducida es
                            </h3>
                            
                            <div class="info-row">
                                <span class="info-label">
                                    <i class="bi bi-tag"></i>Título:
                                </span>
                                <span class="info-value"><?php echo $datos_formulario['titulo']; ?></span>
                            </div>
                            
                            <div class="info-row">
                                <span class="info-label">
                                    <i class="bi bi-people"></i>Actores:
                                </span>
                                <span class="info-value"><?php echo $datos_formulario['actores']; ?></span>
                            </div>
                            
                            <div class="info-row">
                                <span class="info-label">
                                    <i class="bi bi-person-badge"></i>Director:
                                </span>
                                <span class="info-value"><?php echo $datos_formulario['director']; ?></span>
                            </div>
                            
                            <div class="info-row">
                                <span class="info-label">
                                    <i class="bi bi-pencil"></i>Guión:
                                </span>
                                <span class="info-value"><?php echo $datos_formulario['guion']; ?></span>
                            </div>
                            
                            <div class="info-row">
                                <span class="info-label">
                                    <i class="bi bi-building"></i>Producción:
                                </span>
                                <span class="info-value"><?php echo $datos_formulario['produccion']; ?></span>
                            </div>
                            
                            <div class="info-row">
                                <span class="info-label">
                                    <i class="bi bi-calendar-event"></i>Año:
                                </span>
                                <span class="info-value"><?php echo $datos_formulario['anio']; ?></span>
                            </div>
                            
                            <div class="info-row">
                                <span class="info-label">
                                    <i class="bi bi-flag"></i>Nacionalidad:
                                </span>
                                <span class="info-value"><?php echo $datos_formulario['nacionalidad']; ?></span>
                            </div>
                            
                            <div class="info-row">
                                <span class="info-label">
                                    <i class="bi bi-collection"></i>Género:
                                </span>
                                <span class="info-value"><?php echo $datos_formulario['genero']; ?></span>
                            </div>
                            
                            <div class="info-row">
                                <span class="info-label">
                                    <i class="bi bi-clock"></i>Duración:
                                </span>
                                <span class="info-value"><?php echo $datos_formulario['duracion']; ?> minutos</span>
                            </div>
                            
                            <div class="info-row">
                                <span class="info-label">
                                    <i class="bi bi-shield-check"></i>Restricciones de edad:
                                </span>
                                <span class="info-value"><?php echo $datos_formulario['restriccion']; ?></span>
                            </div>
                            
                            <div class="info-row">
                                <span class="info-label">
                                    <i class="bi bi-chat-text"></i>Sinopsis:
                                </span>
                                <span class="info-value"><?php echo $datos_formulario['sinopsis']; ?></span>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <a href="cinem@s.php" class="btn-volver">
                                <i class="bi bi-arrow-left"></i> Volver al Formulario
                            </a>
                        </div>
                        
                    <?php else: ?>
                        <!-- Mensaje de error -->
                        <div class="error-container">
                            <div class="error-icon">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                            </div>
                            <h3 class="error-title">❌ Error de Validación</h3>
                            <p class="error-message"><?php echo $mensaje; ?></p>
                        </div>
                        
                        <div class="text-center">
                            <a href="../view/tp2/ej4Vista.php" class="btn-volver">
                                <i class="bi bi-arrow-left"></i> Volver al Formulario
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Función para cerrar el mensaje
        function cerrarMensaje(element) {
            element.parentElement.style.display = 'none';
        }
        
        // Cerrar mensaje con Escape
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                var movieInfo = document.querySelector('.movie-info');
                if (movieInfo) {
                    movieInfo.style.display = 'none';
                }
            }
        });
    </script>
</body>
</html>
