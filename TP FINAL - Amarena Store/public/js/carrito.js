// ===============================
// GESTIÓN DEL CARRITO DE COMPRAS (Backend)
// ===============================

const baseUrl = window.location.origin;

document.addEventListener("DOMContentLoaded", () => {
  console.log("[v0] Cart JavaScript initialized");
  initCart();
});

function initCart() {
  // Los items del carrito se renderizan desde el servidor
  // Solo manejamos las acciones de actualización y eliminación
  console.log("[v0] Cart items loaded from server");
}

// ===============================
// ACTUALIZAR CANTIDAD
// ===============================

function updateQuantity(event, itemId, change) {
  console.log("[v0] Updating quantity for item:", itemId, "change:", change);
  const cartItem = event.target.closest(".cart-item");
  const quantityInput = cartItem.querySelector(".quantity-input");
  const currentQuantity = Number.parseInt(quantityInput.value) || 1;
  let newQuantity = currentQuantity + change;

  if (newQuantity < 1) {
    newQuantity = 1;
  }

  const formData = new FormData();
  formData.append("item_id", itemId);
  formData.append("quantity", newQuantity);

  fetch(`${baseUrl}/cart/actualizar`, {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("[v0] Update quantity response:", data);
      if (data.success) {
        showNotification(data.message || "Cantidad actualizada.");
        location.reload();
      } else {
        showNotification(
          data.message || "Error al actualizar cantidad",
          "error"
        );
      }
    })
    .catch((error) => {
      console.error("[v0] Error updating quantity:", error);
      showNotification("Error al actualizar cantidad", "error");
    });
}

// ===============================
// ELIMINAR ITEM
// ===============================

function removeItem(itemId) {
  console.log("[v0] Removing item:", itemId);
  if (
    !confirm("¿Estás seguro de que quieres eliminar este producto del carrito?")
  ) {
    return;
  }

  const formData = new FormData();
  formData.append("item_id", itemId);

  fetch(`${baseUrl}/cart/eliminar`, {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("[v0] Remove item response:", data);
      if (data.success) {
        showNotification(data.message || "Producto eliminado.");
        location.reload();
      } else {
        showNotification(data.message || "Error al eliminar producto", "error");
      }
    })
    .catch((error) => {
      console.error("[v0] Error removing item:", error);
      showNotification("Error al eliminar producto", "error");
    });
}

// ===============================
// PROCESAR COMPRA
// ===============================

function procesarCompra() {
  console.log("[v0] Processing purchase");
  // Redirigir al inicio del proceso de pago con Mercado Pago
  fetch(`${baseUrl}/pago/iniciar`, { method: "POST" })
    .then((response) => response.json())
    .then((data) => {
      console.log("[v0] Payment initiation response:", data);
      if (data.success && data.init_point) {
        window.location.href = data.init_point;
      } else {
        showNotification(data.message || "Error al iniciar el pago.", "error");
      }
    })
    .catch((error) => {
      console.error("[v0] Error processing purchase:", error);
      showNotification("Error de conexión al procesar la compra.", "error");
    });
}

// Función showNotification (si no está disponible globalmente)
function showNotification(message, type = "success") {
  const existingNotification = document.querySelector(".notification");
  if (existingNotification) {
    existingNotification.remove();
  }

  const notification = document.createElement("div");
  notification.className = `notification notification--${type}`;
  notification.textContent = message;
  document.body.appendChild(notification);

  setTimeout(() => {
    notification.style.animation = "slideOutRight 0.4s ease";
    setTimeout(() => {
      if (notification.parentNode) {
        notification.remove();
      }
    }, 400);
  }, 3000);
}
