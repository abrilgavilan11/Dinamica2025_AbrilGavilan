<?php
// Script para verificar las credenciales del usuario
// Ejercicio 3 - TP3

// Arreglo asociativo con usuarios del sistema
$usuarios = array(
    array(
        "usuario" => "admin",
        "clave" => "admin123"
    ),
    array(
        "usuario" => "usuario1",
        "clave" => "password123"
    ),
    array(
        "usuario" => "maria",
        "clave" => "maria456"
    ),
    array(
        "usuario" => "juan",
        "clave" => "juan789"
    ),
    array(
        "usuario" => "ana",
        "clave" => "ana2024"
    )
);

// Función para verificar credenciales del usuario
function verificarCredenciales($usuarios, $usuario_ingresado, $password_ingresado) {
    $resultado = null;
    $indice = 0;
    $total_usuarios = count($usuarios);
    
    while ($indice < $total_usuarios && $resultado === null) {
        $usuario = $usuarios[$indice];
        if ($usuario["usuario"] === $usuario_ingresado && $usuario["clave"] === $password_ingresado) {
            $resultado = $usuario;
        }
        $indice++;
    }
    
    return $resultado;
}

// Función para obtener mensaje de resultado
function obtenerMensajeResultado($usuario_valido, $usuario_ingresado) {
    $resultado = array();
    
    if ($usuario_valido) {
        $resultado["mensaje"] = "¡Bienvenido " . htmlspecialchars($usuario_valido["usuario"]) . "! Has iniciado sesión correctamente.";
        $resultado["tipo"] = "exito";
    } else {
        $resultado["mensaje"] = "Error: Usuario o contraseña incorrectos. Por favor, verifique sus credenciales.";
        $resultado["tipo"] = "error";
    }
    
    return $resultado;
}

// Verificar si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario_ingresado = $_POST["usuario"] ?? "";
    $password_ingresado = $_POST["password"] ?? "";
    
    // Validar que ambos campos estén completos
    if (empty($usuario_ingresado) || empty($password_ingresado)) {
        $mensaje = "Error: Debe completar tanto el usuario como la contraseña.";
        $tipo_mensaje = "error";
    } else {
        // Verificar credenciales
        $usuario_valido = verificarCredenciales($usuarios, $usuario_ingresado, $password_ingresado);
        $resultado = obtenerMensajeResultado($usuario_valido, $usuario_ingresado);
        $mensaje = $resultado["mensaje"];
        $tipo_mensaje = $resultado["tipo"];
    }
} else {
    // Si no se recibió POST, redirigir al formulario
    header("Location: ../view/tp2/ej3Vista.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Verificación - Ejercicio 3</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .result-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0,0,0,0.1);
            padding: 2rem;
            width: 100%;
            max-width: 500px;
            text-align: center;
        }
        
        .mensaje-exito {
            color: #28a745;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }
        
        .mensaje-error {
            color: #dc3545;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
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
        
        .icono {
            font-size: 4rem;
            margin-bottom: 1rem;
        }
        
        .icono-exito {
            color: #28a745;
        }
        
        .icono-error {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="result-container">
                    <?php if ($tipo_mensaje === "exito"): ?>
                        <div class="icono icono-exito">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <h3 class="text-success mb-3">¡Acceso Exitoso!</h3>
                        <p class="mensaje-exito"><?php echo $mensaje; ?></p>
                    <?php else: ?>
                        <div class="icono icono-error">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                        </div>
                        <h3 class="text-danger mb-3">Error de Acceso</h3>
                        <p class="mensaje-error"><?php echo $mensaje; ?></p>
                    <?php endif; ?>
                    
                    <a href="../view/tp2/ej3Vista.php" class="btn-volver">
                        <i class="bi bi-arrow-left"></i> Volver al Login
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
