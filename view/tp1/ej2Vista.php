<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <title>Ejercicio 2</title>
    <script>
      function validarFormulario() {
        const dias = [
          "lunes",
          "martes",
          "miercoles",
          "jueves",
          "viernes",
          "sabado",
          "domingo",
        ];
        ingresoCorrecto = true;
        for (let dia of dias) {
          const valor = document.getElementById(dia).value;
          if (valor === "" || isNaN(valor) || valor < 0) {
            alert(
              "Por favor, ingrese una cantidad válida de horas para " +
                dia +
                "."
            );
            ingresoCorrecto = false;
          }
        }
        return ingresoCorrecto;
      }
    </script>
  </head>
  <body>
    <h1>Horas de cursada por día</h1>
    <form
      action="verhoras.php"
      method="post"
      onsubmit="return validarFormulario();"
    >
      <label for="lunes">Lunes:</label>
      <input type="number" id="lunes" name="horas[]" min="0" required /><br />
      <label for="martes">Martes:</label>
      <input type="number" id="martes" name="horas[]" min="0" required /><br />
      <label for="miercoles">Miércoles:</label>
      <input
        type="number"
        id="miercoles"
        name="horas[]"
        min="0"
        required
      /><br />
      <label for="jueves">Jueves:</label>
      <input type="number" id="jueves" name="horas[]" min="0" required /><br />
      <label for="viernes">Viernes:</label>
      <input type="number" id="viernes" name="horas[]" min="0" required /><br />
      <label for="sabado">Sábado:</label>
      <input type="number" id="sabado" name="horas[]" min="0" required /><br />
      <label for="domingo">Domingo:</label>
      <input
        type="number"
        id="domingo"
        name="horas[]"
        min="0"
        required
      /><br /><br />
      <button type="submit">Calcular total</button>
    </form>
  </body>
</html>
