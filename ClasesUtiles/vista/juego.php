<?php
include_once('../configuracion.php');
$BASE_URL = "http://" . $_SERVER['HTTP_HOST'] . "/qr-payment-system";
include_once('./estructura/header.php');
?>

<div class="main-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-animated">
                    <div class="card-body p-5">
                        <h2 class="card-title text-center mb-4">
                            <i class="fas fa-gamepad text-warning"></i>
                            ¡Gana tu Descuento!
                        </h2>
                        <p class="text-center text-muted mb-4">
                            Responde correctamente las preguntas para obtener un descuento
                        </p>

                        <div id="juego-container">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Verificar que existan datos
window.addEventListener('DOMContentLoaded', function() {
    const clienteData = ClienteData.obtenerDatosCliente();
    const monto = ClienteData.obtenerMonto();

    if (!clienteData || !monto) {
        mostrarAlerta('Faltan datos. Redirigiendo...', 'warning');
        setTimeout(() => {
            window.location.href = 'index.php';
        }, 2000);
    }
});

// Función para aplicar descuento
function aplicarDescuento(porcentaje) {
    ClienteData.guardarDescuento(porcentaje);
    mostrarAlerta(`¡Felicitaciones! Has ganado un ${porcentaje}% de descuento`, 'success');
    
    setTimeout(() => {
        window.location.href = 'resumen.php';
    }, 2000);
}

// Volver sin descuento
function volverSinDescuento() {
    window.location.href = 'resumen.php';
}

</script>

<?php include_once('./estructura/footer.php'); ?>
