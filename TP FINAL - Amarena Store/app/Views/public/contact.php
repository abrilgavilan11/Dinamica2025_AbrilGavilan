<?php
require_once VIEWS_PATH . '/layouts/header.php';
require_once VIEWS_PATH . '/layouts/navbar.php';
?>

<section class="contact-page">
    <div class="contact-page__container">
        <h1>Contacto - Amarena Store</h1>
        
        <!-- Agregar contenedor con grid de formulario e información -->
        <div class="contact-content-wrapper">
            <!-- Formulario de contacto -->
            <div class="form-container">
                <h2 style="text-align: left; margin-top: 0; font-size: 1.5rem; color: var(--color-primary-dark);">Envíanos un Mensaje</h2>
                <form action="/contacto/enviar" method="POST" id="contact-form">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="apellido">Apellido:</label>
                        <input type="text" id="apellido" name="apellido" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="tel" id="telefono" name="telefono" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="comentarios">Comentarios:</label>
                        <textarea id="comentarios" name="comentarios" rows="5" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                </form>
            </div>

            <!-- Información de contacto -->
            <div class="contact-info">
                <h2 style="text-align: left; font-size: 1.5rem; margin: 0; color: var(--color-primary-dark);">Información</h2>
                
                <div class="contact-info__item">
                    <div class="contact-info__title">📍 Ubicación</div>
                    <div class="contact-info__content">
                        Amarena Store<br>
                        Tienda Física - Neuquén, Argentina
                    </div>
                </div>

                <div class="contact-info__item">
                    <div class="contact-info__title">📞 Teléfono</div>
                    <div class="contact-info__content">
                        <a href="tel:+5429952110099">+54 9 299 521-0099</a><br>
                        <small>Disponible por WhatsApp</small>
                    </div>
                </div>

                <div class="contact-info__item">
                    <div class="contact-info__title">⏰ Horarios</div>
                    <div class="contact-info__content">
                        Lunes a Viernes: 10:00 - 18:00<br>
                        Sábado: 10:00 - 14:00<br>
                        <small>Cerrado los domingos</small>
                    </div>
                </div>

                <div class="contact-info__item">
                    <div class="contact-info__title">✉️ Email</div>
                    <div class="contact-info__content">
                        <a href="mailto:hola@amarenastore.com">hola@amarenastore.com</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require_once VIEWS_PATH . '/layouts/footer.php';
?>
