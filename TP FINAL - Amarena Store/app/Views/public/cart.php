<?php
// No incluimos header y navbar aquí para que pueda ser un componente reutilizable.
// Estos deberían estar en la página principal que carga el sidebar.
?>

<!-- Overlay para oscurecer el fondo cuando el carrito está visible -->
<div id="cart-overlay" class="cart-overlay"></div>

<!-- Contenedor del sidebar del carrito -->
<div id="cart-sidebar" class="cart-sidebar">
    <div class="cart-sidebar-header">
        <h3 class="mb-0">Tu Carrito</h3>
        <button id="close-cart-btn" class="btn-close"></button>
    </div>
    <div class="cart-sidebar-body">
        <?php if (empty($data['cartItems'])): ?>
            <div class="alert alert-info text-center py-4 m-3">
                <p class="mb-2">Tu carrito está vacío.</p>
                <a href="/catalog" class="btn btn-sm btn-primary">Explorar Productos</a>
            </div>
        <?php endif; ?>

        <!-- Este div se llenará dinámicamente con el contenido del carrito -->
        <div id="cart-items-container">
            <!-- El contenido del carrito se insertará aquí -->

        <?php if (!empty($data['cartItems'])): ?>
            <div class="cart-content">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th colspan="2">Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Disponible</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['cartItems'] as $item): ?>
                            <tr>
                                <td class="cart-item__image">
                                    <?php
                                    $imagePath = BASE_URL . '/img/ropa/' . htmlspecialchars($item['image'] ?? 'default.jpg');
                                    if (strpos($item['image'], 'product_') === 0) {
                                        // Si es una imagen subida, la ruta es diferente
                                        $imagePath = BASE_URL . '/uploads/products/' . htmlspecialchars($item['image']);
                                    }
                                    ?>
                                    <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="max-width: 60px;">
                                </td>
                                <td class="cart-item__details">
                                    <h5><?= htmlspecialchars($item['name']) ?></h5>
                                    <small class="text-muted">Talle: <?= htmlspecialchars($item['size']) ?> | Color: <?= htmlspecialchars($item['color']) ?></small>
                                </td>
                                <td>$<?= number_format($item['price'], 2) ?></td>
                                <td>
                                    <input type="number" value="<?= $item['quantity'] ?>" min="1" class="form-control quantity-input" data-item-id="<?= $item['item_id'] ?>" data-product-id="<?= $item['product_id'] ?>" style="width: 80px;">
                                </td>
                                <td>
                                    <!-- Mostrar stock disponible -->
                                    <span class="stock-display" data-product-id="<?= $item['product_id'] ?>">
                                        <span class="spinner-border spinner-border-sm" role="status"></span>
                                    </span>
                                </td>
                                <td>$<?= number_format($item['itemTotal'], 2) ?></td>
                                <td>
                                    <button class="btn btn-sm btn-danger remove-btn" data-item-id="<?= $item['item_id'] ?>">
                                        ✕
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="row mt-4">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Resumen de Compra</h5>
                                <hr>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal:</span>
                                    <span id="subtotal">$<?= number_format($data['total'], 2) ?></span>
                                </div>
                                <div class="d-flex justify-content-between mb-3 fw-bold">
                                    <span>Total:</span>
                                    <span id="total">$<?= number_format($data['total'], 2) ?></span>
                                </div>
                                <!-- Reemplazado botón de checkout por iniciador de pago con Mercado Pago -->
                                <button id="checkoutBtn" class="btn btn-success w-100 btn-lg mb-2" <?= empty($data['cartItems']) ? 'disabled' : '' ?>>
                                    Ir a Pagar con Mercado Pago
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        </div>
    </div>
</div>

<!-- Este es un ejemplo de cómo podrías tener un botón en tu navbar para abrir el carrito -->
<!-- Deberás agregarlo en tu archivo de layout/navbar.php -->
<!-- 
<button id="open-cart-btn" class="btn btn-primary">
    Ver Carrito <span class="badge bg-danger" id="cart-count">0</span>
</button> 
-->

<script>
const baseUrl = '<?= BASE_URL ?>';
document.addEventListener('DOMContentLoaded', function() {

    const cartSidebar = document.getElementById('cart-sidebar');
    const cartOverlay = document.getElementById('cart-overlay');
    const closeCartBtn = document.getElementById('close-cart-btn');
    // Asumiendo que tendrás un botón con id 'open-cart-btn' en tu navbar/header
    const openCartBtn = document.getElementById('open-cart-btn'); 

    function openCart() {
        cartOverlay.classList.add('active');
        cartSidebar.classList.add('active');
    }

    function closeCart() {
        cartOverlay.classList.remove('active');
        cartSidebar.classList.remove('active');
    }

    if (openCartBtn) {
        openCartBtn.addEventListener('click', openCart);
    }
    if (closeCartBtn) {
        closeCartBtn.addEventListener('click', closeCart);
    }
    if (cartOverlay) {
        cartOverlay.addEventListener('click', closeCart);
    }

    // Función para actualizar el contador de items del carrito
    function updateCartCounter() {
        const cartCounter = document.getElementById('cart-count');
        if (!cartCounter) return;

        fetch(`${baseUrl}/cart/count`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    cartCounter.textContent = data.count;
                }
            })
            .catch(error => console.error('Error al contar items:', error));
    }

    // Llama a la función para establecer el contador inicial
    updateCartCounter();

    // Delegación de eventos para los botones dentro del carrito
    cartSidebar.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-btn')) {
            handleRemoveItem(e.target);
        }
    });
    cartSidebar.addEventListener('change', function(e) {
        if (e.target.classList.contains('quantity-input')) {
            handleQuantityChange(e.target);
        }
    });

    // Cargar stock disponible para cada producto
    function loadStockDisplay() {
        document.querySelectorAll('.stock-display').forEach(el => {
            const productId = el.getAttribute('data-product-id');
            fetch(`${baseUrl}/admin/verificar-stock`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'product_id=' + productId + '&quantity=1'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                el.innerHTML = `<span class="badge bg-info">${data.current_stock} disp.</span>`;
            }
        })
        .catch(error => console.error('Error:', error));
        });
    }
    loadStockDisplay();

    // --- Funciones refactorizadas para manejar eventos del carrito ---

    function handleQuantityChange(inputElement) {
        const itemId = inputElement.getAttribute('data-item-id');
        let quantity = parseInt(inputElement.value);
        const productId = inputElement.getAttribute('data-product-id');

        if (isNaN(quantity) || quantity < 1) {
            quantity = 1;
            inputElement.value = 1;
        }

        // Verificar stock disponible
        fetch(`${baseUrl}/admin/verificar-stock`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'product_id=' + productId + '&quantity=' + quantity
        })
        .then(response => response.json())
        .then(data => {
            if (!data.has_stock) {
                alert('Stock insuficiente. Disponibles: ' + data.current_stock);
                inputElement.value = data.current_stock > 0 ? data.current_stock : 1;
                // Si el stock es 0, podríamos querer eliminar el item o deshabilitar la entrada
                if (data.current_stock === 0) {
                    // Opcional: recargar para que el servidor lo elimine si la lógica lo contempla
                    location.reload(); 
                }
                return;
            }

            // Actualizar cantidad en el servidor
            fetch(`${baseUrl}/cart/actualizar`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'item_id=' + itemId + '&quantity=' + quantity
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload(); // Recargamos para actualizar totales y subtotales
                } else {
                    alert('Error: ' + data.message);
                }
            });
        });
    }

    function handleRemoveItem(buttonElement) {
        const itemId = buttonElement.getAttribute('data-item-id');
        
        fetch(`${baseUrl}/cart/eliminar`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'item_id=' + itemId
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload(); // Recargamos para actualizar la vista del carrito
            } else {
                alert('Error: ' + data.message);
            }
        });
    }

    // Checkout con verificación final de stock y pago con Mercado Pago
    const checkoutBtn = document.getElementById('checkoutBtn');
    if (checkoutBtn) {
        checkoutBtn.addEventListener('click', function() {
            // Verificar stock de todos los items antes de procesar
            const items = document.querySelectorAll('.quantity-input');
            if (items.length === 0) {
                alert("Tu carrito está vacío.");
                return;
            }
            let allHaveStock = true;
            let checkPromises = [];

            items.forEach(input => {
                const productId = input.getAttribute('data-product-id');
                const quantity = parseInt(input.value);

                const promise = fetch(`${baseUrl}/admin/verificar-stock`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'product_id=' + productId + '&quantity=' + quantity
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.has_stock) {
                        allHaveStock = false;
                        const productName = input.closest('tr').querySelector('.cart-item__details h5').innerText;
                        alert('Stock insuficiente para: ' + productName);
                    }
                });

                checkPromises.push(promise);
            });

            Promise.all(checkPromises).then(() => {
                if (allHaveStock) {
                    // Iniciar pago con Mercado Pago
                    fetch(`${baseUrl}/pago/iniciar`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success && data.init_point) {
                            // Redirigir a Mercado Pago
                            window.location.href = data.init_point;
                        } else {
                            alert('Error: ' + (data.message || 'No se pudo procesar el pago'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error al procesar el pago');
                    });
                }
            });
        });
    }
});
</script>

<style>
.cart-sidebar {
    position: fixed;
    top: 0;
    right: -450px; /* Inicia fuera de la pantalla */
    width: 450px;
    max-width: 90%;
    height: 100%;
    background-color: #fff;
    box-shadow: -2px 0 5px rgba(0,0,0,0.1);
    transition: right 0.4s ease-in-out;
    z-index: 1050;
    display: flex;
    flex-direction: column;
}
.cart-sidebar.active {
    right: 0; /* Se desliza a la vista */
}
.cart-sidebar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #dee2e6;
    background-color: #f8f9fa;
}
.cart-sidebar-body {
    flex-grow: 1;
    overflow-y: auto;
    padding: 1rem;
}
.cart-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.4s ease-in-out, visibility 0.4s;
    z-index: 1040;
}
.cart-overlay.active {
    opacity: 1;
    visibility: visible;
}
.cart-content .table {
    font-size: 0.9rem;
}
.cart-content .card {
    border: none;
    background-color: #f8f9fa;
}
</style>
