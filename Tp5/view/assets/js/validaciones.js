// Form validation functions

/**
 * Validates login form
 */
function validarLogin() {
  let valido = true;

  const username = document.getElementById("usnombre");
  const password = document.getElementById("uspass");

  // Clear previous errors
  limpiarErrores();

  // Validate username
  if (username.value.trim() === "") {
    mostrarError(username, "El nombre de usuario es requerido");
    valido = false;
  } else if (username.value.length < 3) {
    mostrarError(
      username,
      "El nombre de usuario debe tener al menos 3 caracteres"
    );
    valido = false;
  }

  // Validate password
  if (password.value.trim() === "") {
    mostrarError(password, "La contraseña es requerida");
    valido = false;
  } else if (password.value.length < 6) {
    mostrarError(password, "La contraseña debe tener al menos 6 caracteres");
    valido = false;
  }

  return valido;
}

/**
 * Validates user update form
 */
function validarActualizacion() {
  let valido = true;

  const username = document.getElementById("usnombre");
  const email = document.getElementById("usmail");
  const password = document.getElementById("uspass");

  // Clear previous errors
  limpiarErrores();

  // Validate username
  if (username.value.trim() === "") {
    mostrarError(username, "El nombre de usuario es requerido");
    valido = false;
  } else if (username.value.length < 3) {
    mostrarError(
      username,
      "El nombre de usuario debe tener al menos 3 caracteres"
    );
    valido = false;
  }

  // Validate email
  if (email.value.trim() === "") {
    mostrarError(email, "El email es requerido");
    valido = false;
  } else if (!validarEmail(email.value)) {
    mostrarError(email, "El email no es válido");
    valido = false;
  }

  // Validate password (only if provided)
  if (password.value.trim() !== "" && password.value.length < 6) {
    mostrarError(password, "La contraseña debe tener al menos 6 caracteres");
    valido = false;
  }

  return valido;
}

/**
 * Validates email format
 */
function validarEmail(email) {
  const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return regex.test(email);
}

/**
 * Shows error message for a field
 */
function mostrarError(campo, mensaje) {
  campo.classList.add("is-invalid");

  const feedback = document.createElement("div");
  feedback.className = "invalid-feedback";
  feedback.textContent = mensaje;

  campo.parentNode.appendChild(feedback);
}

/**
 * Clears all error messages
 */
function limpiarErrores() {
  const campos = document.querySelectorAll(".is-invalid");
  campos.forEach((campo) => {
    campo.classList.remove("is-invalid");
  });

  const feedbacks = document.querySelectorAll(".invalid-feedback");
  feedbacks.forEach((feedback) => {
    feedback.remove();
  });
}

/**
 * Confirms delete action
 */
function confirmarEliminacion(username) {
  return confirm(
    "¿Está seguro que desea deshabilitar al usuario " + username + "?"
  );
}

// Add event listeners when DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
  // Login form validation
  const loginForm = document.getElementById("loginForm");
  if (loginForm) {
    loginForm.addEventListener("submit", (e) => {
      if (!validarLogin()) {
        e.preventDefault();
      }
    });
  }

  // Update form validation
  const updateForm = document.getElementById("updateForm");
  if (updateForm) {
    updateForm.addEventListener("submit", (e) => {
      if (!validarActualizacion()) {
        e.preventDefault();
      }
    });
  }

  // Real-time validation
  const inputs = document.querySelectorAll(".form-control");
  inputs.forEach((input) => {
    input.addEventListener("blur", function () {
      if (this.classList.contains("is-invalid")) {
        limpiarErrores();

        if (loginForm) {
          validarLogin();
        } else if (updateForm) {
          validarActualizacion();
        }
      }
    });
  });
});
