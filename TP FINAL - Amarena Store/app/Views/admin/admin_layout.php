<?php
require_once VIEWS_PATH . '/layouts/header.php';
require_once VIEWS_PATH . '/layouts/navbar.php';
?>

<main class="admin-page">
    <div class="admin-container">
        <aside class="admin-sidebar">
            <h2>Menú Admin</h2>
            <nav>
                <a href="/admin" class="<?= strpos($_SERVER['REQUEST_URI'], '/admin/productos') === false && strpos($_SERVER['REQUEST_URI'], '/admin/ordenes') === false ? 'active' : '' ?>">Dashboard</a>
                <a href="/admin/productos" class="<?= strpos($_SERVER['REQUEST_URI'], '/admin/productos') !== false ? 'active' : '' ?>">Gestionar Productos</a>
                <a href="/admin/ordenes" class="<?= strpos($_SERVER['REQUEST_URI'], '/admin/ordenes') !== false ? 'active' : '' ?>">Gestionar Órdenes</a>
            </nav>
        </aside>
        <section class="admin-content">
            <?= $content ?>
        </section>
    </div>
</main>

<?php
require_once VIEWS_PATH . '/layouts/footer.php';
?>