<?php


require __DIR__ . '/vendor/autoload.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Logo\Logo;

class GeneradorQR
{
    private const LABEL = 'Link del pago';
    private const RUTA_LOGO = __DIR__ . '/../../Vista/img/dinero.png';
    private const RUTA_GUARDADO = __DIR__ . '/../../Vista/img/'; 

    public function generarQR($monto)
    {
       //pasar el monto a formato moneda (para que se lea mejor)
        $monto = '$' . number_format($monto, 2, ',', '.');
        
        //se define la URL del QR
        $url = 'https://large-type.com/#Pagaste%20un%20total%20de%20' . $monto . '%20pesos';

         // Crear el código QR con el monto asignado
        $qrCode = QrCode::create($url)
            ->setSize(320)
            ->setMargin(12)
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->setForegroundColor(new Color(25, 45, 80))
            ->setBackgroundColor(new Color(245, 248, 255));

        // Etiqueta
        $label = Label::create(self::LABEL)
            ->setFont(new NotoSans(16))
            ->setTextColor(new Color(25, 45, 80));

        // Logo (solo si existe)
        $logo = null;
        if (file_exists(self::RUTA_LOGO)) {
            $logo = Logo::create(self::RUTA_LOGO)->setResizeToWidth(120);
        }

        // Crear imagen final
        $writer = new PngWriter();
        $result = $writer->write($qrCode, $logo, $label);

        // Guardar en archivo
        $nombreArchivo = 'qr_generado.png';
        $rutaGuardado = self::RUTA_GUARDADO . $nombreArchivo;
        $result->saveToFile($rutaGuardado);

    }
}




/*
* Instalar composer 
* luego checkear de que este en el PATH del sistema
* en terminal: composer require endroid/qr-code
* En el xampp ir al config del apache y cambiar ";extension=gd" por "extension=gd"
*
*/
