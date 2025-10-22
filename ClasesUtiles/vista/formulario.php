<?php
if ($_SESSION['historial'][count($_SESSION['historial']) - 1]['bot'] == "Correcto!!!") {

    echo '<form method="POST">
            <input type="hidden" name="Descuento" value="1">
            <button class="btn-success" type="submit">Pagar</button>
        </form>';
} elseif ($_SESSION['historial'][count($_SESSION['historial']) - 1]['bot'] == "Agotaste tus intentos 😥") {

    echo '<form method="POST">
            <input type="hidden" name="Descuento" value="0">
            <button class="btn-danger" type="submit">Pagar</button>
        </form>';
} else {

    echo '<form method="POST">
            <input type="text" name="mensaje" placeholder="Escribí tu respuesta..." required>
            <button type="submit">Enviar</button>
        </form>';
}