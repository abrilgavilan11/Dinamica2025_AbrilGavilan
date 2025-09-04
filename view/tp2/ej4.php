<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinem@s - Cargar Película</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="ej4_style.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="form-container">
                    <h2 class="form-title">
                        <i class="bi bi-film"></i>
                        🎬 Cinem@s
                    </h2>
                    
                    <form id="formularioPelicula" class="needs-validation" action="procesar_pelicula.php" method="POST" novalidate>
                        <div class="row">
                            <!-- Columna Izquierda -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="titulo" class="form-label">Título *</label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="titulo" 
                                           name="titulo" 
                                           placeholder="Título"
                                           minlength="2"
                                           maxlength="100"
                                           required>
                                    <div class="invalid-feedback">
                                        Por favor, ingrese el título de la película (mínimo 2 caracteres).
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Perfecto!
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="director" class="form-label">Director *</label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="director" 
                                           name="director" 
                                           placeholder="Director"
                                           minlength="2"
                                           maxlength="100"
                                           required>
                                    <div class="invalid-feedback">
                                        Por favor, ingrese el director (mínimo 2 caracteres).
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Perfecto!
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="produccion" class="form-label">Producción *</label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="produccion" 
                                           name="produccion" 
                                           placeholder="Producción"
                                           minlength="2"
                                           maxlength="150"
                                           required>
                                    <div class="invalid-feedback">
                                        Por favor, ingrese la productora (mínimo 2 caracteres).
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Perfecto!
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="nacionalidad" class="form-label">Nacionalidad *</label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="nacionalidad" 
                                           name="nacionalidad" 
                                           placeholder="Nacionalidad"
                                           minlength="2"
                                           maxlength="100"
                                           required>
                                    <div class="invalid-feedback">
                                        Por favor, ingrese la nacionalidad (mínimo 2 caracteres).
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Perfecto!
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="duracion" class="form-label">Duración (minutos) *</label>
                                    <input type="number" 
                                           class="form-control" 
                                           id="duracion" 
                                           name="duracion" 
                                           placeholder="Duración"
                                           min="1"
                                           max="999"
                                           required>
                                    <div class="form-text">Máximo 999 minutos</div>
                                    <div class="invalid-feedback">
                                        Por favor, ingrese una duración válida (1-999 minutos).
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Perfecto!
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Sinopsis *</label>
                                    <textarea class="form-control" 
                                              id="sinopsis" 
                                              name="sinopsis" 
                                              rows="4" 
                                              placeholder="Sinopsis de la película"
                                              minlength="10"
                                              maxlength="1000"
                                              required></textarea>
                                    <div class="invalid-feedback">
                                        Por favor, ingrese la sinopsis (mínimo 10 caracteres).
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Perfecto!
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Columna Derecha -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="actores" class="form-label">Actores *</label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="actores" 
                                           name="actores" 
                                           placeholder="Actores"
                                           minlength="2"
                                           maxlength="200"
                                           required>
                                    <div class="invalid-feedback">
                                        Por favor, ingrese los actores principales (mínimo 2 caracteres).
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Perfecto!
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="guion" class="form-label">Guión *</label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="guion" 
                                           name="guion" 
                                           placeholder="Guión"
                                           minlength="2"
                                           maxlength="100"
                                           required>
                                    <div class="invalid-feedback">
                                        Por favor, ingrese el guionista (mínimo 2 caracteres).
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Perfecto!
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="anio" class="form-label">Año *</label>
                                    <input type="number" 
                                           class="form-control" 
                                           id="anio" 
                                           name="anio" 
                                           placeholder="Año"
                                           min="1900"
                                           max="2034"
                                           required>
                                    <div class="invalid-feedback">
                                        Por favor, ingrese un año válido (1900-2034).
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Perfecto!
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="genero" class="form-label">Género *</label>
                                    <select class="form-select" id="genero" name="genero" required>
                                        <option value="">Seleccione un género</option>
                                        <option value="Comedia">Comedia</option>
                                        <option value="Drama">Drama</option>
                                        <option value="Terror">Terror</option>
                                        <option value="Románticas">Románticas</option>
                                        <option value="Suspenso">Suspenso</option>
                                        <option value="Acción">Acción</option>
                                        <option value="Ciencia Ficción">Ciencia Ficción</option>
                                        <option value="Documental">Documental</option>
                                        <option value="Otras">Otras</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Por favor, seleccione un género.
                                    </div>
                                    <div class="valid-feedback">
                                        ¡Perfecto!
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Restricciones de edad *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="radio" 
                                               name="restriccion" 
                                               id="todos" 
                                               value="Todos los públicos" 
                                               required>
                                        <label class="form-check-label" for="todos">
                                            Todos los públicos
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="radio" 
                                               name="restriccion" 
                                               id="mayores7" 
                                               value="Mayores de 7 años">
                                        <label class="form-check-label" for="mayores7">
                                            Mayores de 7 años
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="radio" 
                                               name="restriccion" 
                                               id="mayores18" 
                                               value="Mayores de 18 años">
                                        <label class="form-check-label" for="mayores18">
                                            Mayores de 18 años
                                        </label>
                                    </div>
                                    <div class="invalid-feedback">
                                        Por favor, seleccione las restricciones de edad.
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Botones -->
                        <div class="row mt-4">
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-secondary btn-clear me-2" onclick="limpiarFormulario()">
                                    <i class="bi bi-trash"></i> Borrar
                                </button>
                                <button type="submit" class="btn btn-primary btn-submit">
                                    <i class="bi bi-send"></i> Enviar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Clase para manejar la validación del formulario
        class FormularioValidator {
            constructor() {
                this.initializeValidation();
                this.setupRealTimeValidation();
            }
            
            // Inicializar validación de Bootstrap
            initializeValidation() {
                const forms = document.querySelectorAll('.needs-validation');
                
                forms.forEach(form => {
                    form.addEventListener('submit', (event) => {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }
            
            // Configurar validación en tiempo real
            setupRealTimeValidation() {
                this.setupNumericValidation();
                this.setupTextValidation();
            }
            
            // Validación para campos numéricos
            setupNumericValidation() {
                const anioInput = document.getElementById('anio');
                const duracionInput = document.getElementById('duracion');
                
                if (anioInput) {
                    anioInput.addEventListener('input', () => this.validateYear(anioInput));
                }
                
                if (duracionInput) {
                    duracionInput.addEventListener('input', () => this.validateDuration(duracionInput));
                }
            }
            
            // Validación para campos de texto
            setupTextValidation() {
                const textInputs = document.querySelectorAll('input[type="text"], textarea');
                textInputs.forEach(input => {
                    input.addEventListener('input', () => this.validateTextInput(input));
                });
            }
            
            // Validar año
            validateYear(input) {
                const value = parseInt(input.value);
                const isValid = input.value.length === 4 && value >= 1900 && value <= 2034;
                this.updateValidationState(input, isValid);
            }
            
            // Validar duración
            validateDuration(input) {
                const value = parseInt(input.value);
                const isValid = value > 0 && value <= 999;
                this.updateValidationState(input, isValid);
            }
            
            // Validar campo de texto
            validateTextInput(input) {
                const minLength = parseInt(input.getAttribute('minlength')) || 0;
                const maxLength = parseInt(input.getAttribute('maxlength')) || 999999;
                const value = input.value;
                const isValid = value.length >= minLength && value.length <= maxLength;
                this.updateValidationState(input, isValid);
            }
            
            // Actualizar estado de validación
            updateValidationState(input, isValid) {
                if (input.value.length > 0) {
                    if (isValid) {
                        input.classList.remove('is-invalid');
                        input.classList.add('is-valid');
                    } else {
                        input.classList.remove('is-valid');
                        input.classList.add('is-invalid');
                    }
                } else {
                    input.classList.remove('is-valid', 'is-invalid');
                }
            }
                }

        // Función para limpiar el formulario
        function limpiarFormulario() {
            const form = document.getElementById('formularioPelicula');
            form.reset();
            
            // Remover todas las clases de validación
            const forms = document.querySelectorAll('.needs-validation');
            forms.forEach(form => {
                form.classList.remove('was-validated');
            });
            
            // Limpiar feedback visual
            const inputs = document.querySelectorAll('.form-control, .form-select');
            inputs.forEach(input => {
                input.classList.remove('is-valid', 'is-invalid');
            });
            
            const radioButtons = document.querySelectorAll('.form-check-input');
            radioButtons.forEach(radio => {
                radio.classList.remove('is-valid', 'is-invalid');
            });
        }
        
        // Inicializar cuando el DOM esté listo
        document.addEventListener('DOMContentLoaded', function() {
            new FormularioValidator();
        });
    </script>
</body>
</html>
