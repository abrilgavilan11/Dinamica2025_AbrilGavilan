<?php
require_once VIEWS_PATH . '/layouts/header.php';
require_once VIEWS_PATH . '/layouts/navbar.php';
?>
<!-- HERO SECTION - NUEVO DISEÑO -->
<section class="hero">
    <div class="hero__content">
        <div class="hero__text">
            <h1 class="hero__title">Estilo que empodera</h1>
            <h2 class="hero__subtitle">Talles reales. Belleza auténtica.</h2>
            <p class="hero__description">
                Descubrí tu mejor versión con nuestra nueva colección. Moda inclusiva que celebra la diversidad de cada mujer.
            </p>
            <div class="hero__buttons">
                <a href="/catalog" class="hero__btn--primary">Ver Colección</a>
                <a href="/about" class="hero__btn--secondary">Conocenos</a>
            </div>
        </div>
        <div class="hero__image">
            <img src="<?= BASE_URL ?>/img/imageninicio.jpeg" alt="Amarena Store">
        </div>
    </div>
</section>

<!-- PRODUCTOS DESTACADOS -->
<section class="featured-products">
    <h2 class="featured-products__title">Productos Destacados</h2>
    <div class="featured-carousel">
        <div class="featured-carousel__track">
            <?php if (!empty($data['featuredProducts'])): ?>
                <?php foreach ($data['featuredProducts'] as $product): ?>
                    <div class="featured-carousel__slide">
                        <div class="featured-card">
                            <div class="featured-card__image">
                                <img src="<?= BASE_URL ?>/img/ropa/<?= htmlspecialchars($product['proimagen'] ?? 'default.jpg') ?>" alt="<?= htmlspecialchars($product['pronombre'] ?? '') ?>" />
                                <button class="featured-card__quick-view">+</button>
                            </div>
                            <div class="featured-card__info">
                                <h3 class="featured-card__title"><?= htmlspecialchars($product['pronombre'] ?? '') ?></h3>
                                <p class="featured-card__price">$<?= number_format($product['proprecio'] ?? 0, 0, ',', '.') ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Productos por defecto si no hay en BD -->
                <div class="featured-carousel__slide">
                    <div class="featured-card">
                        <div class="featured-card__image">
                            <img src="<?= BASE_URL ?>/img/ropa/remera_placeholder.jpg" alt="Remera de Ejemplo">
                        </div>
                        <div class="featured-card__info">
                            <h3 class="featured-card__title">Remera Estampada</h3>
                            <p class="featured-card__price">$12.500</p>
                        </div>
                    </div>
                </div>
                <div class="featured-carousel__slide">
                    <div class="featured-card">
                        <div class="featured-card__image">
                            <img src="<?= BASE_URL ?>/img/ropa/pantalon_placeholder.jpg" alt="Pantalón de Ejemplo">
                        </div>
                        <div class="featured-card__info">
                            <h3 class="featured-card__title">Pantalón Cargo</h3>
                            <p class="featured-card__price">$25.000</p>
                        </div>
                    </div>
                </div>
                <div class="featured-carousel__slide">
                    <div class="featured-card">
                        <div class="featured-card__image">
                            <img src="<?= BASE_URL ?>/img/ropa/buzo_placeholder.jpg" alt="Buzo de Ejemplo">
                        </div>
                        <div class="featured-card__info">
                            <h3 class="featured-card__title">Buzo Oversize</h3>
                            <p class="featured-card__price">$28.900</p>
                        </div>
                    </div>
                </div>
                <div class="featured-carousel__slide">
                    <div class="featured-card">
                        <div class="featured-card__image">
                            <img src="<?= BASE_URL ?>/img/ropa/short_placeholder.jpg" alt="Short de Ejemplo">
                        </div>
                        <div class="featured-card__info">
                            <h3 class="featured-card__title">Short de Jean</h3>
                            <p class="featured-card__price">$18.000</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <button class="featured-carousel__btn featured-carousel__btn--left">‹</button>
        <button class="featured-carousel__btn featured-carousel__btn--right">›</button>
    </div>
</section>

<!-- FAQ INTEGRADO -->
<section class="faq-section">
    <div class="faq-section__container">
        <h2 class="faq-section__title">Preguntas Frecuentes</h2>
        <div class="faq-accordion">
            <div class="faq-item">
                <button class="faq-question" type="button">
                    <span>¿Cómo puedo realizar un pedido?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">
                    <p>Podés realizar tu pedido a través de nuestro WhatsApp (+54 9 299 521-0099) o visitando nuestra tienda física. También podés navegar por nuestro catálogo online y contactarnos directamente con los productos que te interesen.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question" type="button">
                    <span>¿Qué talles manejan?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">
                    <p>Manejamos talles reales desde XS hasta XXL. Creemos en la moda inclusiva y trabajamos para que todas las mujeres encuentren su talle perfecto.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question" type="button">
                    <span>¿Cuáles son los métodos de pago?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">
                    <p>Aceptamos efectivo, transferencia bancaria, MercadoPago y tarjetas de débito y crédito. Para compras online, trabajamos con MercadoPago para mayor seguridad en tus transacciones.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question" type="button">
                    <span>¿Hacen envíos?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">
                    <p>Sí, realizamos envíos a toda la provincia de Neuquén. Los costos varían según la distancia. Para Plottier y alrededores, el envío es gratuito en compras superiores a $50.000.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require_once VIEWS_PATH . '/layouts/footer.php';
?>
