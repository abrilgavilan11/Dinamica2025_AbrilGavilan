<?php
ob_start(); // Inicia el buffer de salida
?>

<h1>Panel de Administración</h1>
<p>Bienvenido, <strong><?= htmlspecialchars(\App\Utils\Session::get('user_name')) ?></strong>.</p>
<p>Desde aquí puedes gestionar los productos, órdenes y otros aspectos de la tienda.</p>

<?php
$content = ob_get_clean(); // Captura el contenido
require_once VIEWS_PATH . '/admin/admin_layout.php'; // Carga el layout
?>