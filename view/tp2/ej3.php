<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ejercicio 3</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="ej3_style.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-container">
                    <h2 class="login-title">
                        <i class="bi bi-person-circle"></i>
                        Member Login
                    </h2>
                    
                    <form id="loginForm" class="needs-validation" action="verificaPass.php" method="POST" novalidate>
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="bi bi-person"></i>
                            </span>
                            <input type="text" 
                                   class="form-control with-icon" 
                                   id="usuario" 
                                   name="usuario" 
                                   placeholder="Username"
                                   minlength="3"
                                   maxlength="50"
                                   pattern="^[a-zA-Z0-9_-]+$"
                                   required>
                            <div class="invalid-feedback">
                                El usuario debe tener entre 3 y 50 caracteres (solo letras, números, guiones y guiones bajos).
                            </div>
                            <div class="valid-feedback">
                                ¡Perfecto!
                            </div>
                        </div>
                        
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password" 
                                   class="form-control with-icon" 
                                   id="password" 
                                   name="password" 
                                   placeholder="Password"
                                   minlength="8"
                                   pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$"
                                   required>
                            <div class="invalid-feedback">
                                La contraseña debe tener al menos 8 caracteres y contener letras y números.
                            </div>
                            <div class="valid-feedback">
                                ¡Perfecto!
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-login">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </button>
                    </form>
                </div>
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
                    
                    // Validación adicional personalizada
                    if (!validarContraseñaDiferente()) {
                        event.preventDefault();
                        event.stopPropagation();
                        mostrarErrorContraseña();
                    }
                    
                    form.classList.add('was-validated');
                }, false);
            });
        })();

        // Función para validar que la contraseña no sea igual al usuario
        function validarContraseñaDiferente() {
            var usuario = document.getElementById('usuario').value;
            var password = document.getElementById('password').value;
            return password !== usuario;
        }

        // Función para mostrar error de contraseña
        function mostrarErrorContraseña() {
            var passwordInput = document.getElementById('password');
            var feedback = passwordInput.nextElementSibling.nextElementSibling;
            
            if (feedback && feedback.classList.contains('invalid-feedback')) {
                feedback.textContent = 'La contraseña no puede ser igual al nombre de usuario.';
                passwordInput.classList.add('is-invalid');
            }
        }

        // Validación en tiempo real
        document.addEventListener('DOMContentLoaded', function() {
            var usuarioInput = document.getElementById('usuario');
            var passwordInput = document.getElementById('password');
            
            // Validar usuario en tiempo real
            usuarioInput.addEventListener('input', function() {
                var value = this.value;
                var pattern = /^[a-zA-Z0-9_-]+$/;
                
                if (value.length >= 3 && value.length <= 50 && pattern.test(value)) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                } else if (value.length > 0) {
                    this.classList.remove('is-valid');
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-valid', 'is-invalid');
                }
            });
            
            // Validar contraseña en tiempo real
            passwordInput.addEventListener('input', function() {
                var value = this.value;
                var pattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$/;
                
                if (pattern.test(value) && value !== usuarioInput.value) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                } else if (value.length > 0) {
                    this.classList.remove('is-valid');
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-valid', 'is-invalid');
                }
            });
        });
    </script>
</body>
</html>
