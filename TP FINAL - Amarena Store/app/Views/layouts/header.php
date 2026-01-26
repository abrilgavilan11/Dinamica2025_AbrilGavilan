<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?? 'Amarena Store - Moda para todas' ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/base.css">
    <!-- Añadimos Bootstrap para estilos de tablas, tarjetas y botones -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php if (isset($data['pageCss'])): ?>
        <link rel="stylesheet" href="<?= BASE_URL ?>/css/<?= $data['pageCss'] ?>.css">
    <?php endif; ?>
    <link rel="icon" href="<?= BASE_URL ?>/img/logo_amarena.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Croissant+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poiret+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <?php
    require_once VIEWS_PATH . '/layouts/notification_modal.php';
    ?>
    <div class="main-content">
