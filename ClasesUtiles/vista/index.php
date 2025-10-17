<?php
include_once('../configuracion.php');
include_once('./estructura/header.php');
?>

<div class="main-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-animated">
                    <div class="card-body p-5">
                        <h2 class="card-title text-center mb-4">
                            <i class="fas fa-user-circle text-primary"></i>
                            Datos del Cliente
                        </h2>
                        <p class="text-center text-muted mb-4">
                            Ingrese sus datos para continuar con el pago
                        </p>

                        <form id="formCliente" method="POST" action="../control/procesarCliente.php">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">
                                    <i class="fas fa-user me-2"></i>Nombre
                                </label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="nombre" 
                                    name="nombre" 
                                    placeholder="Ingrese su nombre"
                                    required
                                >
                            </div>

                            <div class="mb-3">
                                <label for="apellido" class="form-label">
                                    <i class="fas fa-user me-2"></i>Apellido
                                </label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="apellido" 
                                    name="apellido" 
                                    placeholder="Ingrese su apellido"
                                    required
                                >
                            </div>

                            <div class="mb-4">
                                <label for="dni" class="form-label">
                                    <i class="fas fa-id-card me-2"></i>DNI
                                </label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="dni" 
                                    name="dni" 
                                    placeholder="Ingrese su DNI (sin puntos)"
                                    maxlength="8"
                                    required
                                >
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-custom-primary">
                                    Continuar
                                    <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('formCliente').addEventListener('submit', function(e) {
    e.preventDefault();
    
    if (validarFormularioCliente()) {
        const nombre = document.getElementById('nombre').value.trim();
        const apellido = document.getElementById('apellido').value.trim();
        const dni = document.getElementById('dni').value.trim();
        
        // Guardar en localStorage
        ClienteData.guardarDatosCliente(nombre, apellido, dni);
        
        // Redirigir a la página de monto
        window.location.href = './monto.php';
    }
});

</script>

<?php include_once('./estructura/footer.php'); ?>
