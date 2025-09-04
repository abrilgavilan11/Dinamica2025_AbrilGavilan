<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <title>Ejercicio 1</title>
    <script>
      function validarFormulario() {
        ingresoCorrecto = true;
        const numero = document.getElementById("number").value;
        if (numero === "" || isNaN(numero)) {
          alert("Por favor, ingrese un número válido.");
          ingresoCorrecto = false;
        }
        return ingresoCorrecto;
      }
    </script>
  </head>
  <body>
    <h1>Ejercicio 1 - Insgresar un número</h1>
    <form
      action="vernumero.php"
      method="post"
      onsubmit="return validarFormulario();"
    >
      <label for="number">Ingrese un número:</label>
      <input type="number" id="number" name="number" required step="any" />
      <input type="submit"></input>
    </form>
  </body>
</html>
