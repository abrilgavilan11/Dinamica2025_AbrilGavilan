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
                            Responde correctamente las preguntas para obtener un 10% de descuento
                        </p>

                        <div id="juego-container">
                            <?php
                            // Incluye el chat del juego
                            include_once 'chat.php';
                            ?>

                            <?php 
                            // Incluye el formulario del juego
                            include_once 'formulario.php' 
                            ?>
                        </div>

                        <!-- Agregar botón para cancelar y volver -->
                        <div class="mt-3">
                            <button class="btn btn-outline-secondary w-100" onclick="cancelarJuego()">
                                <i class="fas fa-times me-2"></i>
                                Cancelar y Volver al Resumen
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Verificar que existan los datos necesarios
window.addEventListener('DOMContentLoaded', function() {
    const clienteData = ClienteData.obtenerDatosCliente();
    const monto = ClienteData.obtenerMonto();

    // Si faltan datos, redirigir al inicio
    if (!clienteData || !monto) {
        mostrarAlerta('Faltan datos. Redirigiendo...', 'warning');
        setTimeout(() => {
            window.location.href = 'index.php';
        }, 2000);
    }
});

/**
 * Aplica el descuento ganado y redirige al resumen
 * Esta función se llama cuando el usuario gana el juego
 */
function aplicarDescuentoYVolver(porcentaje) {
    // Guardar el descuento en localStorage
    ClienteData.guardarDescuento(porcentaje);
    
    // Mostrar mensaje de éxito
    mostrarAlerta(`¡Felicitaciones! Has ganado un ${porcentaje}% de descuento`, 'success');

    // Redirigir al resumen después de 1.5 segundos
    setTimeout(() => {
        window.location.href = 'resumen.php';
    }, 1500);
}

/**
 * Vuelve al resumen sin aplicar descuento
 * Esta función se llama cuando el usuario pierde el juego
 */
function volverSinDescuento() {
    // Asegurarse de que no haya descuento guardado
    ClienteData.guardarDescuento(0);
    
    // Redirigir al resumen
    window.location.href = 'resumen.php';
}

/**
 * Cancela el juego y vuelve al resumen sin descuento
 */
function cancelarJuego() {
    if (confirm('¿Estás seguro que deseas cancelar el juego? No obtendrás descuento.')) {
        volverSinDescuento();
    }
}
</script>

<?php include_once('./estructura/footer.php'); ?>
