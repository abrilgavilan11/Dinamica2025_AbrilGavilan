<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6 - Formulario de Deportes</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="ej1y2_style.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <h2>
                    <i class="bi bi-person-badge"></i>
                    Formulario de Deportes
                </h2>
            </div>
            
            <div class="form-body">
                <form id="formularioDeportes" class="needs-validation" action="ver_deportes.php" method="POST" novalidate>
                    <div class="form-group">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" 
                               class="form-control" 
                               id="nombre" 
                               name="nombre" 
                               minlength="2"
                               maxlength="50"
                               pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$"
                               placeholder="Ingrese su nombre"
                               required>
                        <div class="invalid-feedback">
                            Por favor, ingrese su nombre (mínimo 2 caracteres, solo letras).
                        </div>
                        <div class="valid-feedback">
                            ¡Perfecto!
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="apellido" class="form-label">Apellido:</label>
                        <input type="text" 
                               class="form-control" 
                               id="apellido" 
                               name="apellido" 
                               minlength="2"
                               maxlength="50"
                               pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$"
                               placeholder="Ingrese su apellido"
                               required>
                        <div class="invalid-feedback">
                            Por favor, ingrese su apellido (mínimo 2 caracteres, solo letras).
                        </div>
                        <div class="valid-feedback">
                            ¡Perfecto!
                        </div>
                    </div>

                    <fieldset class="sports-section">
                        <legend>Deportes que practica</legend>
                        <div class="sports-grid">
                            <div class="sport-option">
                                <input class="form-check-input" type="checkbox" name="deportes[]" value="natacion" id="natacion">
                                <label for="natacion">
                                    <i class="bi bi-water"></i> Natación
                                </label>
                            </div>
                            <div class="sport-option">
                                <input class="form-check-input" type="checkbox" name="deportes[]" value="futbol" id="futbol">
                                <label for="futbol">
                                    <i class="bi bi-circle"></i> Fútbol
                                </label>
                            </div>
                            <div class="sport-option">
                                <input class="form-check-input" type="checkbox" name="deportes[]" value="basket" id="basket">
                                <label for="basket">
                                    <i class="bi bi-circle-fill"></i> Basket
                                </label>
                            </div>
                            <div class="sport-option">
                                <input class="form-check-input" type="checkbox" name="deportes[]" value="tennis" id="tennis">
                                <label for="tennis">
                                    <i class="bi bi-circle"></i> Tennis
                                </label>
                            </div>
                            <div class="sport-option">
                                <input class="form-check-input" type="checkbox" name="deportes[]" value="voley" id="voley">
                                <label for="voley">
                                    <i class="bi bi-circle-fill"></i> Vóley
                                </label>
                            </div>
                            <div class="sport-option">
                                <input class="form-check-input" type="checkbox" name="deportes[]" value="atletismo" id="atletismo">
                                <label for="atletismo">
                                    <i class="bi bi-lightning"></i> Atletismo
                                </label>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            Debe seleccionar al menos un deporte.
                        </div>
                    </fieldset>

                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send"></i> Enviar
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="limpiarFormulario()">
                            <i class="bi bi-trash"></i> Limpiar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Inicialización de validación de formularios de Bootstrap
        (function() {
            'use strict';
            
            // Obtener todos los formularios a los que queremos aplicar validación personalizada
            var forms = document.querySelectorAll('.needs-validation');
            
            // Bucle sobre ellos y prevenir envío
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    
                    form.classList.add('was-validated');
                }, false);
            });
        })();

        // Función para limpiar el formulario
        function limpiarFormulario() {
            const form = document.getElementById('formularioDeportes');
            form.reset();
            
            // Remover todas las clases de validación
            const forms = document.querySelectorAll('.needs-validation');
            forms.forEach(form => {
                form.classList.remove('was-validated');
            });
            
            // Limpiar feedback visual
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.classList.remove('is-valid', 'is-invalid');
            });
            
            const checkboxes = document.querySelectorAll('.form-check-input');
            checkboxes.forEach(checkbox => {
                checkbox.classList.remove('is-valid', 'is-invalid');
            });
        }

        // Validación en tiempo real para campos de texto
        document.addEventListener('DOMContentLoaded', function() {
            const nombreInput = document.getElementById('nombre');
            const apellidoInput = document.getElementById('apellido');
            
            // Validar nombre en tiempo real
            nombreInput.addEventListener('input', function() {
                const value = this.value;
                const pattern = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
                
                if (value.length >= 2 && value.length <= 50 && pattern.test(value)) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                } else if (value.length > 0) {
                    this.classList.remove('is-valid');
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-valid', 'is-invalid');
                }
            });
            
            // Validar apellido en tiempo real
            apellidoInput.addEventListener('input', function() {
                const value = this.value;
                const pattern = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
                
                if (value.length >= 2 && value.length <= 50 && pattern.test(value)) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                } else if (value.length > 0) {
                    this.classList.remove('is-valid');
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-valid', 'is-invalid');
                }
            });
            
            // Validar checkboxes en tiempo real
            const checkboxes = document.querySelectorAll('input[name="deportes[]"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const checkedBoxes = document.querySelectorAll('input[name="deportes[]"]:checked');
                    const fieldset = this.closest('fieldset');
                    
                    if (checkedBoxes.length > 0) {
                        fieldset.classList.remove('is-invalid');
                        fieldset.classList.add('is-valid');
                    } else {
                        fieldset.classList.remove('is-valid');
                        fieldset.classList.add('is-invalid');
                    }
                });
            });
        });
    </script>
</body>
</html>
