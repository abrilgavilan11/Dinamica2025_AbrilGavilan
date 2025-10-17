<?php
include_once('../configuracion.php');
$titulo = 'Pagar con QR';
$BASE_URL = "http://" . $_SERVER['HTTP_HOST'] . "/qr-payment-system";
include_once('./estructura/header.php');
?>

<div class="main-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-animated">
                    <div class="card-body p-5">
                        <h2 class="card-title text-center mb-4">
                            <i class="fas fa-qrcode text-success"></i>
                            Escanea para Pagar
                        </h2>

                        <div class="qr-container">
                            <!-- Integración del código QR -->
                            <div id="qr-code-container" class="text-center mb-4">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Generando QR...</span>
                                </div>
                                <p class="mt-2">Generando código QR...</p>
                            </div>

                            <div class="mb-3 text-center">
                                <h5>Total a Pagar:</h5>
                                <h3 class="text-success" id="total-pagar"></h3>
                            </div>

                            <!-- Información adicional del pago -->
                            <div class="alert alert-info alert-custom">
                                <div class="resumen-item">
                                    <span><i class="fas fa-user me-2"></i>Cliente:</span>
                                    <span id="info-cliente" class="fw-bold"></span>
                                </div>
                                <div class="resumen-item">
                                    <span><i class="fas fa-id-card me-2"></i>DNI:</span>
                                    <span id="info-dni" class="fw-bold"></span>
                                </div>
                                <div class="resumen-item" id="info-descuento-row" style="display: none;">
                                    <span><i class="fas fa-tag me-2"></i>Descuento:</span>
                                    <span id="info-descuento" class="descuento-aplicado"></span>
                                </div>
                            </div>

                            <p class="text-muted small text-center">
                                <i class="fas fa-mobile-alt me-1"></i>
                                Escanea el código QR con tu aplicación de pago
                            </p>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button class="btn btn-custom-success" onclick="descargarQR()">
                                <i class="fas fa-download me-2"></i>
                                Descargar QR
                            </button>
                            <a href="./resumen.php" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Volver al Resumen
                            </a>
                            <button class="btn btn-outline-danger" onclick="cancelarPago()">
                                <i class="fas fa-times me-2"></i>
                                Cancelar Pago
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let qrImageUrl = '';

window.addEventListener('DOMContentLoaded', function() {
    console.log('Cargando página de pago...');
    
    const clienteData = ClienteData.obtenerDatosCliente();
    const monto = ClienteData.obtenerMonto();
    const descuento = ClienteData.obtenerDescuento();

    console.log('Datos obtenidos:', { clienteData, monto, descuento });

    if (!clienteData || !monto) {
        mostrarAlerta('Faltan datos. Redirigiendo...', 'warning');
        setTimeout(() => {
            window.location.href = './index.php';
        }, 2000);
        return;
    }

    // Mostrar información del pago
    const montoFinal = ClienteData.calcularMontoFinal();
    document.getElementById('total-pagar').textContent = formatearMoneda(montoFinal);
    document.getElementById('info-cliente').textContent = `${clienteData.nombre} ${clienteData.apellido}`;
    document.getElementById('info-dni').textContent = clienteData.dni;

    if (descuento > 0) {
        document.getElementById('info-descuento-row').style.display = 'flex';
        document.getElementById('info-descuento').textContent = `-${descuento}%`;
    }

    // Generar el código QR
    generarCodigoQR(clienteData, montoFinal, descuento);
});

function generarCodigoQR(clienteData, monto, descuento) {
    console.log('Generando código QR...');
    
    // Construir la URL para generar el QR
    const params = new URLSearchParams({
        monto: monto,
        dni: clienteData.dni,
        nombre: `${clienteData.nombre} ${clienteData.apellido}`,
        descuento: descuento
    });

    qrImageUrl = `../control/generarQR.php?${params.toString()}`;
    
    console.log('URL del QR:', qrImageUrl);

    // Crear la imagen del QR
    const qrContainer = document.getElementById('qr-code-container');
    
    const timestamp = new Date().getTime();
    qrContainer.innerHTML = `
        <img src="${qrImageUrl}&t=${timestamp}" 
             alt="Código QR de Pago" 
             class="img-fluid qr-image"
             style="max-width: 300px; border: 3px solid #28a745; border-radius: 10px; padding: 10px; background: white;"
             onload="console.log('QR cargado exitosamente')"
             onerror="console.error('Error al cargar QR'); mostrarErrorQR()">
    `;
}

function mostrarErrorQR() {
    const qrContainer = document.getElementById('qr-code-container');
    qrContainer.innerHTML = `
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle me-2"></i>
            Error al generar el código QR. Por favor, intente nuevamente.
        </div>
        <button class="btn btn-primary" onclick="location.reload()">
            <i class="fas fa-redo me-2"></i>
            Reintentar
        </button>
    `;
}

function descargarQR() {
    if (!qrImageUrl) {
        mostrarAlerta('El código QR aún no está listo', 'warning');
        return;
    }

    // Crear un enlace temporal para descargar
    const link = document.createElement('a');
    link.href = qrImageUrl;
    link.download = `QR-Pago-${Date.now()}.png`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    
    mostrarAlerta('Descargando código QR...', 'success');
}

function cancelarPago() {
    if (confirm('¿Está seguro que desea cancelar el pago?')) {
        ClienteData.limpiarDatos();
        window.location.href = './index.php';
    }
}
</script>

<?php include_once('./estructura/footer.php'); ?>
