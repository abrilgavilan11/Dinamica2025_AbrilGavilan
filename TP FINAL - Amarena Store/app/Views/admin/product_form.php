<?php
ob_start(); // Inicia el buffer de salida para capturar todo el HTML siguiente.


// Determinar si estamos en modo "edición" o "creación"
$isEditing = isset($data['product']);
$product = $data['product'] ?? null;

// Definir la URL del formulario y el método
$formAction = $isEditing ? "/admin/productos/actualizar/{$product['idproducto']}" : "/admin/productos/crear";
$formMethod = "POST";

// Título dinámico
$pageTitle = $isEditing ? 'Editar Producto' : 'Agregar Nuevo Producto';
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h2 class="mb-0"><?= $pageTitle ?></h2>
                </div>
                <div class="card-body">
                    <!-- Formulario multiparte para subir imágenes -->
                    <form action="<?= $formAction ?>" method="<?= $formMethod ?>" enctype="multipart/form-data">
                        
                        <div class="mb-3">
                            <label for="pronombre" class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" id="pronombre" name="pronombre" value="<?= htmlspecialchars($product['pronombre'] ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="prodetalle" class="form-label">Detalle</label>
                            <textarea class="form-control" id="prodetalle" name="prodetalle" rows="4" required><?= htmlspecialchars($product['prodetalle'] ?? '') ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="proprecio" class="form-label">Precio</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" id="proprecio" name="proprecio" step="0.01" value="<?= htmlspecialchars($product['proprecio'] ?? '') ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="procantstock" class="form-label">Stock</label>
                                <input type="number" class="form-control" id="procantstock" name="procantstock" value="<?= htmlspecialchars($product['procantstock'] ?? '') ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="idcategoria" class="form-label">Categoría</label>
                            <select class="form-select" id="idcategoria" name="idcategoria" required>
                                <option value="">Selecciona una categoría</option>
                                <?php foreach ($data['categories'] as $category): ?>
                                    <option value="<?= $category['idcategoria'] ?>" <?= ($isEditing && $product['idcategoria'] == $category['idcategoria']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($category['catnombre']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="proimagen" class="form-label">Imagen del Producto</label>
                            <input type="file" class="form-control" id="proimagen" name="proimagen" accept="image/*">
                            <?php if ($isEditing && !empty($product['proimagen'])): ?>
                                <div class="mt-2">
                                    <small>Imagen actual:</small>
                                    <img src="/uploads/products/<?= htmlspecialchars($product['proimagen']) ?>" alt="Imagen actual" style="max-width: 100px; margin-left: 10px;">
                                    <p class="form-text text-muted">Sube una nueva imagen solo si deseas reemplazar la actual.</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-end">
                            <a href="/admin/productos" class="btn btn-secondary me-2">Cancelar</a>
                            <button type="submit" class="btn btn-primary">
                                <?= $isEditing ? 'Actualizar Producto' : 'Guardar Producto' ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean(); // Captura todo el HTML anterior en la variable $content.
require_once VIEWS_PATH . '/admin/admin_layout.php'; // Carga el layout principal y le pasa el contenido.
?>