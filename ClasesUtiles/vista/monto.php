<?php
include_once('../configuracion.php');
include_once('./estructura/header.php');
?>

<div class="main-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-animated slide-in-right">
                    <div class="card-body p-5">
                        <h2 class="card-title text-center mb-4">
                            <i class="fas fa-dollar-sign text-success"></i>
                            Monto a Pagar
                        </h2>
                        <p class="text-center text-muted mb-4">
                            Ingrese el monto que desea abonar
                        </p>

                        <form id="formMonto">
                            <div class="mb-4">
                                <label for="monto" class="form-label">
                                    <i class="fas fa-money-bill-wave me-2"></i>Monto (ARS)
                                </label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text">$</span>
                                    <input 
                                        type="number" 
                                        class="form-control" 
                                        id="monto" 
                                        name="monto" 
                                        placeholder="0.00"
                                        step="0.01"
                                        min="0"
                                        required
                                    >
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-custom-success">
                                    Ver Resumen
                                    <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                                <a href="index.php" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Volver
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Verificar que el usuario haya ingresado sus datos primero
window.addEventListener('DOMContentLoaded', function() {
    const clienteData = ClienteData.obtenerDatosCliente();
    
    // Si no hay datos del cliente, redirigir al inicio
    if (!clienteData) {
        mostrarAlerta('Debe ingresar sus datos primero', 'warning');
        setTimeout(() => {
            window.location.href = 'index.php';
        }, 2000);
    }
});

// Manejar el envío del formulario
document.getElementById('formMonto').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Validar el monto usando la función de main.js
    if (validarMonto()) {
        const monto = document.getElementById('monto').value.trim();
        
        // Guardar el monto en el navegador
        ClienteData.guardarMonto(monto);
        
        // Ir a la página de resumen
        window.location.href = 'resumen.php';
    }
});

// Formatear el monto cuando el usuario termine de escribir
document.getElementById('monto').addEventListener('blur', function() {
    if (this.value) {
        this.value = parseFloat(this.value).toFixed(2);
    }
});
</script>

<?php include_once('./estructura/footer.php'); ?>
