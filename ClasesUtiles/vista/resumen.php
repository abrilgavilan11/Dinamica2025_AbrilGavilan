<?php
include_once('../configuracion.php');
$titulo = 'Resumen de Pago';
$BASE_URL = "http://" . $_SERVER['HTTP_HOST'] . "/qr-payment-system";
include_once('./estructura/header.php');
?>

<div class="main-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-animated slide-in-left">
                    <div class="card-body p-5">
                        <h2 class="card-title text-center mb-4">
                            <i class="fas fa-receipt text-info"></i>
                            Resumen de Pago
                        </h2>

                        <div class="resumen-box">
                            <h5 class="mb-3">
                                <i class="fas fa-user me-2"></i>
                                Datos del Cliente
                            </h5>
                            <div class="resumen-item">
                                <span>Nombre:</span>
                                <span id="resumen-nombre" class="fw-bold"></span>
                            </div>
                            <div class="resumen-item">
                                <span>Apellido:</span>
                                <span id="resumen-apellido" class="fw-bold"></span>
                            </div>
                            <div class="resumen-item">
                                <span>DNI:</span>
                                <span id="resumen-dni" class="fw-bold"></span>
                            </div>
                        </div>

                        <div class="resumen-box">
                            <h5 class="mb-3">
                                <i class="fas fa-money-check-alt me-2"></i>
                                Detalle del Pago
                            </h5>
                            <div class="resumen-item">
                                <span>Monto Original:</span>
                                <span id="resumen-monto-original" class="fw-bold"></span>
                            </div>
                            <div class="resumen-item" id="descuento-row" style="display: none;">
                                <span>Descuento:</span>
                                <span id="resumen-descuento" class="descuento-aplicado"></span>
                            </div>
                            <div class="resumen-item">
                                <span>Total a Pagar:</span>
                                <span id="resumen-total" class="text-primary"></span>
                            </div>
                        </div>

                        <div class="d-grid gap-3">
                            <button class="btn btn-custom-warning btn-lg" onclick="irADescuento()">
                                <i class="fas fa-gift me-2"></i>
                                ¿Desea un descuento?
                            </button>
                            <button class="btn btn-custom-success btn-lg" onclick="irAPagar()">
                                <i class="fas fa-qrcode me-2"></i>
                                Ir a Pagar
                            </button>
                            <a href="monto.php" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Modificar Monto
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Cargar datos del resumen
window.addEventListener('DOMContentLoaded', function() {
    const clienteData = ClienteData.obtenerDatosCliente();
    const monto = ClienteData.obtenerMonto();
    const descuento = ClienteData.obtenerDescuento();

    // Verificar que existan los datos
    if (!clienteData || !monto) {
        mostrarAlerta('Faltan datos. Redirigiendo...', 'warning');
        setTimeout(() => {
            window.location.href = 'index.php';
        }, 2000);
        return;
    }

    // Mostrar datos del cliente
    document.getElementById('resumen-nombre').textContent = clienteData.nombre;
    document.getElementById('resumen-apellido').textContent = clienteData.apellido;
    document.getElementById('resumen-dni').textContent = clienteData.dni;

    // Mostrar montos
    const montoOriginal = parseFloat(monto);
    document.getElementById('resumen-monto-original').textContent = formatearMoneda(montoOriginal);

    // Mostrar descuento si existe
    if (descuento > 0) {
        document.getElementById('descuento-row').style.display = 'flex';
        document.getElementById('resumen-descuento').textContent = `-${descuento}%`;
        
        const montoFinal = ClienteData.calcularMontoFinal();
        document.getElementById('resumen-total').textContent = formatearMoneda(montoFinal);
    } else {
        document.getElementById('resumen-total').textContent = formatearMoneda(montoOriginal);
    }
});

function irADescuento() {
    window.location.href = 'juego.php';
}

function irAPagar() {
    window.location.href = 'pago.php';
}
</script>

<?php include_once('./estructura/footer.php'); ?>
