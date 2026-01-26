document.addEventListener("DOMContentLoaded", function () {
  const userMenuButton = document.querySelector(".navbar__user-link");
  const userMenu = document.querySelector(".navbar__user-menu");

  if (userMenuButton && userMenu) {
    userMenuButton.addEventListener("click", function (event) {
      // Previene que el enlace navegue si es un <a> con href="#"
      event.preventDefault();
      // Alterna la visibilidad del menú
      userMenu.style.display =
        userMenu.style.display === "block" ? "none" : "block";
      // Detiene la propagación para que el click no llegue al 'document'
      event.stopPropagation();
    });

    // Cierra el menú si se hace clic fuera de él
    document.addEventListener("click", function (event) {
      // Comprueba si el menú está visible y si el clic fue fuera del botón y del menú
      if (
        userMenu.style.display === "block" &&
        !userMenuButton.contains(event.target)
      ) {
        userMenu.style.display = "none";
      }
    });
  }
});
