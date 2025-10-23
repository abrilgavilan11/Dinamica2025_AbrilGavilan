<?php
if ($_SESSION['historial'][count($_SESSION['historial']) - 1]['bot'] == "Correcto!!!") {
    // El usuario ganó - mostrar botón para aplicar descuento
    echo '<div class="alert alert-success mt-3">
            <i class="fas fa-trophy me-2"></i>
            <strong>¡Felicitaciones!</strong> Has ganado un 10% de descuento.
          </div>
          <button class="btn btn-success btn-lg w-100" onclick="aplicarDescuentoYVolver(10)">
              <i class="fas fa-check me-2"></i>
              Aplicar Descuento y Continuar
          </button>';

} elseif ($_SESSION['historial'][count($_SESSION['historial']) - 1]['bot'] == "Agotaste tus intentos 😥") {
    // El usuario perdió - mostrar botón para volver sin descuento
    echo '<div class="alert alert-danger mt-3">
            <i class="fas fa-times-circle me-2"></i>
            Lo sentimos, no has ganado el descuento esta vez.
          </div>
          <button class="btn btn-primary btn-lg w-100" onclick="volverSinDescuento()">
              <i class="fas fa-arrow-left me-2"></i>
              Volver al Resumen
          </button>';

} else {
    // El juego está en progreso - mostrar formulario para responder
    echo '<form method="POST" class="mt-3">
            <div class="input-group input-group-lg">
                <input type="text" 
                       name="mensaje" 
                       class="form-control" 
                       placeholder="Escribí tu respuesta..." 
                       required 
                       autocomplete="off">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane me-2"></i>
                    Enviar
                </button>
            </div>
          </form>';
}
?>
