/**
 * ARCHIVO PRINCIPAL DE JAVASCRIPT
 * Contiene todas las funciones de validación y manejo de datos del cliente
 */

// ============================================
// OBJETO PARA MANEJAR DATOS DEL CLIENTE
// ============================================

const ClienteData = {
  /**
   * Guarda los datos del cliente en el navegador
   * Usa sessionStorage para que se borren al cerrar la pestaña
   */
  guardarDatosCliente: (nombre, apellido, dni) => {
    const cliente = {
      nombre: nombre,
      apellido: apellido,
      dni: dni,
      timestamp: new Date().getTime(),
    }
    sessionStorage.setItem("clienteData", JSON.stringify(cliente))
  },

  /**
   * Obtiene los datos del cliente guardados
   */
  obtenerDatosCliente: () => {
    const data = sessionStorage.getItem("clienteData")
    return data ? JSON.parse(data) : null
  },

  /**
   * Guarda el monto a pagar
   */
  guardarMonto: (monto) => {
    sessionStorage.setItem("monto", monto)
  },

  /**
   * Obtiene el monto guardado
   */
  obtenerMonto: () => {
    return sessionStorage.getItem("monto")
  },

  /**
   * Guarda el porcentaje de descuento obtenido
   */
  guardarDescuento: (porcentaje) => {
    const descuentoNumero = Number.parseFloat(porcentaje) || 0
    sessionStorage.setItem("descuento", descuentoNumero)
  },

  /**
   * Obtiene el descuento guardado (0 si no hay)
   */
  obtenerDescuento: () => {
    const descuento = sessionStorage.getItem("descuento")
    return Number.parseFloat(descuento) || 0
  },

  /**
   * Calcula el monto final aplicando el descuento
   */
  calcularMontoFinal: function () {
    const monto = Number.parseFloat(this.obtenerMonto())
    const descuento = Number.parseFloat(this.obtenerDescuento())
    const montoDescuento = monto * (descuento / 100)
    return monto - montoDescuento
  },

  /**
   * Elimina todos los datos guardados
   */
  limpiarDatos: () => {
    sessionStorage.removeItem("clienteData")
    sessionStorage.removeItem("monto")
    sessionStorage.removeItem("descuento")
  },
}

// ============================================
// FUNCIONES DE VALIDACIÓN
// ============================================

/**
 * Valida el formulario completo de datos del cliente
 * Verifica nombre, apellido y DNI
 */
function validarFormularioCliente() {
  const nombre = document.getElementById("nombre").value.trim()
  const apellido = document.getElementById("apellido").value.trim()
  const dni = document.getElementById("dni").value.trim()

  // Verificar que ningún campo esté vacío
  if (nombre === "" || apellido === "" || dni === "") {
    mostrarAlerta("Por favor, complete todos los campos", "danger")
    return false
  }

  // Validar nombre: solo letras y máximo 15 caracteres
  if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(nombre)) {
    mostrarAlerta("El nombre solo puede contener letras", "danger")
    return false
  }

  if (nombre.length > 15) {
    mostrarAlerta("El nombre no puede tener más de 15 caracteres", "danger")
    return false
  }

  // Validar apellido: solo letras y máximo 15 caracteres
  if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/.test(apellido)) {
    mostrarAlerta("El apellido solo puede contener letras", "danger")
    return false
  }

  if (apellido.length > 15) {
    mostrarAlerta("El apellido no puede tener más de 15 caracteres", "danger")
    return false
  }

  // Validar DNI: solo números y 7 u 8 dígitos
  if (!/^[0-9]{7,8}$/.test(dni)) {
    mostrarAlerta("El DNI debe contener 7 u 8 dígitos numéricos", "danger")
    return false
  }

  return true
}

/**
 * Valida que el monto ingresado sea válido
 */
function validarMonto() {
  const monto = document.getElementById("monto").value.trim()

  // Verificar que sea un número válido y mayor a cero
  if (monto === "" || isNaN(monto) || Number.parseFloat(monto) <= 0) {
    mostrarAlerta("Por favor, ingrese un monto válido mayor a 0", "danger")
    return false
  }

  return true
}

// ============================================
// VALIDACIÓN EN TIEMPO REAL
// ============================================

/**
 * Configura las validaciones mientras el usuario escribe
 * Evita que ingrese caracteres no permitidos
 */
function configurarValidacionTiempoReal() {
  const nombreInput = document.getElementById("nombre")
  const apellidoInput = document.getElementById("apellido")
  const dniInput = document.getElementById("dni")

  // Validar nombre mientras se escribe
  if (nombreInput) {
    nombreInput.addEventListener("input", function () {
      // Eliminar números y caracteres especiales
      this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, "")
      // Limitar a 15 caracteres
      if (this.value.length > 15) {
        this.value = this.value.substring(0, 15)
      }
    })
  }

  // Validar apellido mientras se escribe
  if (apellidoInput) {
    apellidoInput.addEventListener("input", function () {
      // Eliminar números y caracteres especiales
      this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, "")
      // Limitar a 15 caracteres
      if (this.value.length > 15) {
        this.value = this.value.substring(0, 15)
      }
    })
  }

  // Validar DNI mientras se escribe
  if (dniInput) {
    dniInput.addEventListener("input", function () {
      // Eliminar letras y caracteres especiales
      this.value = this.value.replace(/[^0-9]/g, "")
      // Limitar a 8 dígitos
      if (this.value.length > 8) {
        this.value = this.value.substring(0, 8)
      }
    })
  }
}

// Activar validaciones cuando la página cargue
if (typeof document !== "undefined") {
  document.addEventListener("DOMContentLoaded", configurarValidacionTiempoReal)
}

// ============================================
// FUNCIONES DE INTERFAZ
// ============================================

/**
 * Muestra un mensaje de alerta en la pantalla
 */
function mostrarAlerta(mensaje, tipo) {
  const alertaDiv = document.createElement("div")
  alertaDiv.className = `alert alert-${tipo} alert-dismissible fade show alert-custom`
  alertaDiv.innerHTML = `
        ${mensaje}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `

  const container = document.querySelector(".container")
  container.insertBefore(alertaDiv, container.firstChild)

  // Eliminar la alerta después de 5 segundos
  setTimeout(() => {
    alertaDiv.remove()
  }, 5000)
}

/**
 * Formatea un número como moneda argentina
 */
function formatearMoneda(monto) {
  return new Intl.NumberFormat("es-AR", {
    style: "currency",
    currency: "ARS",
  }).format(monto)
}

/**
 * Muestra un indicador de carga en pantalla
 */
function mostrarCargando() {
  const spinner = document.createElement("div")
  spinner.id = "loading-spinner"
  spinner.className = "spinner-container"
  spinner.innerHTML = `
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Cargando...</span>
        </div>
    `
  document.body.appendChild(spinner)
}

/**
 * Oculta el indicador de carga
 */
function ocultarCargando() {
  const spinner = document.getElementById("loading-spinner")
  if (spinner) {
    spinner.remove()
  }
}
