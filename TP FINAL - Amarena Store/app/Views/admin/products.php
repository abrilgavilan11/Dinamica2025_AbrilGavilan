<?php
ob_start(); // Inicia el buffer de salida para capturar el contenido de la vista
?>

<h1 class="mt-4">Gestionar Productos</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="/admin">Dashboard</a></li>
    <li class="breadcrumb-item active">Productos</li>
</ol>

<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-table me-1"></i> Lista de Productos</span>
        <a href="/admin/productos/nuevo" class="btn btn-primary">
            <i class="fas fa-plus"></i> Agregar Nuevo Producto
        </a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-custom">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Estado Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['products'])): ?>
                    <?php foreach ($data['products'] as $product): ?>
                        <tr>
                            <td><?= htmlspecialchars($product['idproducto']) ?></td>
                            <td><?= htmlspecialchars($product['pronombre']) ?></td>
                            <td><?= htmlspecialchars($product['catnombre']) ?></td>
                            <td>$<?= number_format($product['proprecio'], 2, ',', '.') ?></td>
                            <td><?= htmlspecialchars($product['procantstock']) ?></td>
                            <td>
                                <?php if ($product['procantstock'] == 0): ?>
                                    <span class="badge bg-danger">Sin Stock</span>
                                <?php elseif ($product['procantstock'] <= 5): ?>
                                    <span class="badge bg-warning text-dark">Bajo Stock</span>
                                <?php else: ?>
                                    <span class="badge bg-success">En Stock</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="/admin/productos/editar/<?= $product['idproducto'] ?>" class="btn btn-sm btn-info" title="Editar">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="/admin/productos/eliminar/<?= $product['idproducto'] ?>" class="btn btn-sm btn-danger" title="Eliminar" onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?');">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No hay productos para mostrar.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean(); // Captura el contenido y limpia el buffer
require_once VIEWS_PATH . '/admin/admin_layout.php'; // Carga el layout principal
?>