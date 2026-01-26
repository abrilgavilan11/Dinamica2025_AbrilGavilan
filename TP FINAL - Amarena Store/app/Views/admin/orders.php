<?php
// Incluimos los layouts principales para mantener la consistencia del sitio.
require_once VIEWS_PATH . '/layouts/header.php';
require_once VIEWS_PATH . '/layouts/navbar.php';
?>

<main class="admin-page">
    <div class="admin-container">
        <aside class="admin-sidebar">
            <h2>Menú Admin</h2>
            <nav>
                <a href="/admin">Dashboard</a>
                <a href="/admin/productos">Gestionar Productos</a>
                <a href="/admin/ordenes" class="active">Gestionar Órdenes</a>
                <!-- Futuros enlaces aquí -->
            </nav>
        </aside>
        <section class="admin-content">
            <h1>Gestionar Órdenes</h1>
            <p>Aquí puedes ver y administrar las órdenes realizadas por los clientes.</p>

            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID Orden</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">No hay órdenes para mostrar. (Funcionalidad a implementar)</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
</main>

<?php
require_once VIEWS_PATH . '/layouts/footer.php';
?>