<?php
use App\Utils\Session;
$currentUser = Session::get('user_name', 'Usuario');
$userRole = Session::get('user_role', '');
$currentPath = $_SERVER['REQUEST_URI'] ?? '/';
$cartCount = count(Session::get('cart', []));
?>
<header class="navbar">
    <div class="navbar__logo">
        <a href="/">
            <span>Amarena Store</span>
        </a>
    </div>
    <nav class="navbar__links">
        <a href="/" class="<?= $currentPath === '/' || $currentPath === '/home' ? 'active' : '' ?>">Inicio</a>
        <a href="/catalog" class="<?= strpos($currentPath, '/catalog') !== false ? 'active' : '' ?>">Catálogo</a>
        <a href="/about" class="<?= strpos($currentPath, '/about') !== false ? 'active' : '' ?>">Nosotros</a>
        <a href="/contact" class="<?= strpos($currentPath, '/contact') !== false ? 'active' : '' ?>">Contacto</a>
        <a href="/cart" class="navbar__carrito <?= strpos($currentPath, '/cart') !== false ? 'active' : '' ?>">
            <i class="fas fa-shopping-cart fa-lg"></i>
            <!-- El contador solo se muestra cuando hay productos en el carrito -->
            <?php if ($cartCount > 0): ?>
                <span class="cart-counter"><?= $cartCount ?></span>
            <?php endif; ?>
        </a>
        <?php if (Session::has('user_id')): ?>
            <div class="navbar__user">
                <a href="#" class="navbar__user-link">
                    <?= htmlspecialchars($currentUser) ?>
                    <?php if ($userRole === 'admin'): ?>
                        <span class="user-badge">Admin</span>
                    <?php endif; ?>
                </a>
                <div class="navbar__user-menu">
                    <?php if ($userRole === 'admin'): ?>
                        <a href="/admin">Panel Admin</a>
                    <?php endif; ?>
                    <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
                    <form id="logout-form" action="/logout" method="POST" style="display: none;"></form>
                </div>
            </div>
        <?php else: ?>
            <a href="#" class="navbar__login" onclick="event.preventDefault(); document.getElementById('login-modal').style.display='flex';">Ingresar</a>
        <?php endif; ?>
    </nav>
</header>
