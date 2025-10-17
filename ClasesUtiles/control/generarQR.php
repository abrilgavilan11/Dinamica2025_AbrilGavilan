<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar si la extensión GD está habilitada
if (!extension_loaded('gd')) {
    header('Content-Type: text/plain');
    die("Error: La extensión GD de PHP no está habilitada. Es necesaria para generar imágenes (incluyendo el QR y las imágenes de error). Por favor, habilítela en su php.ini y reinicie el servidor web.");
}

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;

try {
     $autoloadPath = __DIR__ . '/../vendor/autoload.php';
    
    if (!file_exists($autoloadPath)) {
        $realPath = realpath(__DIR__ . '/..');
        throw new Exception("Autoload no encontrado en: $autoloadPath (Directorio real: $realPath). Ejecuta 'composer install' en la raíz del proyecto.");
    }
    
    require_once($autoloadPath);

    // Obtener parámetros
    $monto = $_GET['monto'] ?? '';
    $dni = $_GET['dni'] ?? '';
    $nombre = $_GET['nombre'] ?? '';
    $descuento = $_GET['descuento'] ?? 0;

    // Validar que existan los datos
    if (empty($monto) || empty($dni)) {
        throw new Exception('Faltan datos para generar el QR');
    }

    // Crear el contenido del QR
    // Formato: JSON con los datos del pago
    $datosPago = [
        'tipo' => 'pago',
        'monto' => floatval($monto),
        'dni' => $dni,
        'nombre' => $nombre,
        'descuento' => floatval($descuento),
        'fecha' => date('Y-m-d H:i:s'),
        'referencia' => uniqid('PAY-')
    ];

    $contenidoQR = json_encode($datosPago);

    $result = Builder::create()
        ->writer(new PngWriter())
        ->writerOptions([])
        ->data($contenidoQR)
        ->encoding(new Encoding('UTF-8'))
        ->errorCorrectionLevel(ErrorCorrectionLevel::Low)
        ->size(300)
        ->margin(10)
        ->roundBlockSizeMode(RoundBlockSizeMode::Margin)
        ->build();

    // Configurar headers para imagen PNG
    header('Content-Type: ' . $result->getMimeType());
    header('Cache-Control: no-cache, must-revalidate');

    // Enviar la imagen
    echo $result->getString();
    
} catch (Exception $e) {
    header('Content-Type: image/png');
    error_log("Error en generarQR.php: " . $e->getMessage());
    
    // Crear una imagen de error más informativa y robusta
    $width = 300;
    $height = 300;
    $image = imagecreate($width, $height);
    
    // Colores
    $bgColor = imagecolorallocate($image, 255, 240, 240);
    $textColor = imagecolorallocate($image, 200, 0, 0);
    $titleColor = imagecolorallocate($image, 0, 0, 0); 
    
    if (!file_exists($font)) {
        $font = 5;
    }

    imagestring($image, 5, 50, 50, "Error al generar QR", $titleColor);
    
    // Ajustar el texto del mensaje de error para que quepa en la imagen
    $errorMessage = wordwrap($e->getMessage(), 45, "\n", true);
    $lines = explode("\n", $errorMessage);
    $y = 100;
    foreach ($lines as $line) {
        imagestring($image, 3, 20, $y, $line, $textColor);
        $y += 20;
    }
    
    imagepng($image);
    imagedestroy($image);
}
?>
