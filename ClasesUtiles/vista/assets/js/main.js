/**
 * Funciones para manejo de localStorage y validaciones
 */

// Objeto para manejar los datos del cliente
const ClienteData = {
  // Guardar datos del cliente
  guardarDatosCliente: (nombre, apellido, dni) => {
    const cliente = {
      nombre: nombre,
      apellido: apellido,
      dni: dni,
      timestamp: new Date().getTime(),
    };
    localStorage.setItem("clienteData", JSON.stringify(cliente));
  },

  // Obtener datos del cliente
  obtenerDatosCliente: () => {
    const data = localStorage.getItem("clienteData");
    return data ? JSON.parse(data) : null;
  },

  // Guardar monto
  guardarMonto: (monto) => {
    localStorage.setItem("monto", monto);
  },

  // Obtener monto
  obtenerMonto: () => localStorage.getItem("monto"),

  // Guardar descuento
  guardarDescuento: (porcentaje) => {
    localStorage.setItem("descuento", porcentaje);
  },

  // Obtener descuento
  obtenerDescuento: () => localStorage.getItem("descuento") || 0,

  // Calcular monto final con descuento
  calcularMontoFinal: function () {
    const monto = Number.parseFloat(this.obtenerMonto());
    const descuento = Number.parseFloat(this.obtenerDescuento());
    return monto - monto * (descuento / 100);
  },

  // Limpiar todos los datos
  limpiarDatos: () => {
    localStorage.removeItem("clienteData");
    localStorage.removeItem("monto");
    localStorage.removeItem("descuento");
  },
};

function validarFormularioCliente() {
  const nombre = document.getElementById("nombre").value.trim();
  const apellido = document.getElementById("apellido").value.trim();
  const dni = document.getElementById("dni").value.trim();

  let esValido = true;

  // Validar que los campos no estén vacíos
  if (nombre === "" || apellido === "" || dni === "") {
    mostrarAlerta("Por favor, complete todos los campos", "danger");
    esValido = false;
    return esValido;
  }

  // Validar nombre: solo letras y máximo 15 caracteres
  if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(nombre)) {
    mostrarAlerta("El nombre solo puede contener letras", "danger");
    esValido = false;
    return esValido;
  }

  if (nombre.length > 15) {
    mostrarAlerta("El nombre no puede tener más de 15 caracteres", "danger");
    esValido = false;
    return esValido;
  }

  // Validar apellido: solo letras y máximo 15 caracteres
  if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(apellido)) {
    mostrarAlerta("El apellido solo puede contener letras", "danger");
    esValido = false;
    return esValido;
  }

  if (apellido.length > 15) {
    mostrarAlerta("El apellido no puede tener más de 15 caracteres", "danger");
    esValido = false;
    return esValido;
  }

  // Validar DNI: solo números y 7 u 8 dígitos
  if (!/^[0-9]+$/.test(dni)) {
    mostrarAlerta("El DNI solo puede contener números", "danger");
    esValido = false;
    return esValido;
  }

  if (!/^[0-9]{7,8}$/.test(dni)) {
    mostrarAlerta("El DNI debe contener 7 u 8 dígitos", "danger");
    esValido = false;
    return esValido;
  }

  return esValido;
}

function configurarValidacionTiempoReal() {
  const nombreInput = document.getElementById("nombre");
  const apellidoInput = document.getElementById("apellido");
  const dniInput = document.getElementById("dni");

  // Validar nombre: solo letras y máximo 15 caracteres
  if (nombreInput) {
    nombreInput.addEventListener("input", function (e) {
      // Remover números y caracteres especiales
      this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, "");
      // Limitar a 15 caracteres
      if (this.value.length > 15) {
        this.value = this.value.substring(0, 15);
      }
    });
  }

  // Validar apellido: solo letras y máximo 15 caracteres
  if (apellidoInput) {
    apellidoInput.addEventListener("input", function (e) {
      // Remover números y caracteres especiales
      this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, "");
      // Limitar a 15 caracteres
      if (this.value.length > 15) {
        this.value = this.value.substring(0, 15);
      }
    });
  }

  // Validar DNI: solo números y máximo 8 dígitos
  if (dniInput) {
    dniInput.addEventListener("input", function (e) {
      // Remover letras y caracteres especiales
      this.value = this.value.replace(/[^0-9]/g, "");
      // Limitar a 8 dígitos
      if (this.value.length > 8) {
        this.value = this.value.substring(0, 8);
      }
    });
  }
}

if (typeof document !== "undefined") {
  document.addEventListener("DOMContentLoaded", configurarValidacionTiempoReal);
}

function validarMonto() {
  const monto = document.getElementById("monto").value.trim();
  let esValido = true;

  if (monto === "" || isNaN(monto) || Number.parseFloat(monto) <= 0) {
    mostrarAlerta("Por favor, ingrese un monto válido", "danger");
    esValido = false;
  }

  return esValido;
}

// Mostrar alertas
function mostrarAlerta(mensaje, tipo) {
  const alertaDiv = document.createElement("div");
  alertaDiv.className = `alert alert-${tipo} alert-dismissible fade show alert-custom`;
  alertaDiv.innerHTML = `
        ${mensaje}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

  const container = document.querySelector(".container");
  container.insertBefore(alertaDiv, container.firstChild);

  setTimeout(() => {
    alertaDiv.remove();
  }, 5000);
}

// Formatear moneda
function formatearMoneda(monto) {
  return new Intl.NumberFormat("es-AR", {
    style: "currency",
    currency: "ARS",
  }).format(monto);
}

// Animación de carga
function mostrarCargando() {
  const spinner = document.createElement("div");
  spinner.id = "loading-spinner";
  spinner.className = "spinner-container";
  spinner.innerHTML = `
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Cargando...</span>
        </div>
    `;
  document.body.appendChild(spinner);
}

function ocultarCargando() {
  const spinner = document.getElementById("loading-spinner");
  if (spinner) {
    spinner.remove();
  }
}
