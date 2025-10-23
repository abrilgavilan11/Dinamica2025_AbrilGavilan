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

                        <!-- Datos del Cliente -->
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

                        <!-- Detalle del Pago -->
                        <div class="resumen-box">
                            <h5 class="mb-3">
                                <i class="fas fa-money-check-alt me-2"></i>
                                Detalle del Pago
                            </h5>
                            <div class="resumen-item">
                                <span>Monto Original:</span>
                                <span id="resumen-monto-original" class="fw-bold"></span>
                            </div>
                            <!-- Solo mostrar descuento si realmente existe y es mayor a 0 -->
                            <div class="resumen-item" id="descuento-row" style="display: none;">
                                <span>Descuento:</span>
                                <span id="resumen-descuento" class="descuento-aplicado"></span>
                            </div>
                            <div class="resumen-item">
                                <span>Total a Pagar:</span>
                                <span id="resumen-total" class="text-primary"></span>
                            </div>
                        </div>

                        <!-- Mostrar mensaje de felicitación si ganó descuento -->
                        <div id="mensaje-descuento" class="alert alert-success alert-custom" style="display: none;">
                            <i class="fas fa-check-circle me-2"></i>
                            <strong>¡Felicitaciones!</strong> Has ganado un descuento en tu compra.
                        </div>

                        <!-- Botones de Acción -->
                        <!-- Ocultar botón de descuento si ya lo obtuvo -->
                        <div class="d-grid gap-3">
                            <button id="btn-descuento" class="btn btn-custom-warning btn-lg" onclick="irADescuento()">
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
// Cargar y mostrar el resumen cuando la página cargue
window.addEventListener('DOMContentLoaded', function() {
    const clienteData = ClienteData.obtenerDatosCliente();
    const monto = ClienteData.obtenerMonto();
    const descuento = ClienteData.obtenerDescuento();

    // Verificar que existan los datos necesarios
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

    // Mostrar monto original
    const montoOriginal = parseFloat(monto);
    document.getElementById('resumen-monto-original').textContent = formatearMoneda(montoOriginal);

    if (descuento > 0) {
        // Mostrar fila de descuento
        document.getElementById('descuento-row').style.display = 'flex';
        document.getElementById('resumen-descuento').textContent = `-${descuento}%`;
        
        // Calcular y mostrar monto final con descuento
        const montoFinal = ClienteData.calcularMontoFinal();
        document.getElementById('resumen-total').textContent = formatearMoneda(montoFinal);
        
        // Mostrar mensaje de felicitación
        document.getElementById('mensaje-descuento').style.display = 'block';
        
        // Ocultar botón de descuento porque ya lo obtuvo
        document.getElementById('btn-descuento').style.display = 'none';
    } else {
        // No hay descuento, mostrar monto sin descuento
        document.getElementById('resumen-total').textContent = formatearMoneda(montoOriginal);
        
        // Mostrar botón de descuento
        document.getElementById('btn-descuento').style.display = 'block';
    }
});

// Ir a la página del juego para obtener descuento
function irADescuento() {
    window.location.href = 'juego.php';
}

// Ir a la página de pago
function irAPagar() {
    window.location.href = 'pago.php';
}
</script>

<?php include_once('./estructura/footer.php'); ?>
