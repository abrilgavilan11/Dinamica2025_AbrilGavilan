# Amarena Store - Proyecto E-commerce con PHP y MVC

**Amarena Store** es una plataforma de e-commerce completamente funcional, desarrollada desde cero utilizando PHP puro y el patrón de arquitectura Modelo-Vista-Controlador (MVC). Este proyecto simula una tienda de indumentaria online, implementando funcionalidades clave tanto para clientes como para administradores.

## 🚀 Recorrido por la Aplicación (Tour)

Este proyecto ofrece una experiencia completa dividida en tres áreas principales:

### 1. Vista Pública y Catálogo

Cualquier visitante puede explorar la tienda, conocer la marca y ver los productos.

- **Inicio (`/`):** Página de bienvenida con un diseño moderno, acceso a productos destacados y una sección de Preguntas Frecuentes (FAQ) integrada.
- **Catálogo (`/catalog`):** Galería de todos los productos disponibles, con filtros por categoría.
- **Sobre Nosotros (`/about`):** Página que narra la historia y valores de la marca.
- **Contacto (`/contacto`):** Un formulario para que los visitantes puedan enviar consultas.

### 2. Flujo del Cliente

Una vez registrado, el cliente tiene acceso a funcionalidades de compra personalizadas.

- **Autenticación:** Sistema seguro de registro e inicio de sesión.
- **Carrito de Compras (`/carrito`):** Los clientes pueden agregar productos, modificar cantidades y ver el subtotal de su compra en tiempo real.
- **Proceso de Compra:** Un flujo intuitivo que convierte el carrito en un pedido formal, registrándolo en el sistema con el estado "iniciada".

### 3. Panel de Administración (`/admin`)

Área privada y protegida para la gestión integral de la tienda.

- **Dashboard:** Vista principal con estadísticas y accesos directos a las funciones clave.
- **Gestión de Productos:** CRUD completo (Crear, Leer, Actualizar, Eliminar) para los productos del catálogo.
- **Gestión de Órdenes:** Visualización de todas las compras de los clientes. El administrador puede actualizar el estado de cada compra (`aceptada`, `enviada`, `entregada`, `cancelada`).
- **Gestión de Usuarios:** Administración de los roles y estado de las cuentas de usuario.

## ✨ Características Destacadas

- **Arquitectura MVC Pura:** Código organizado, mantenible y escalable sin el uso de frameworks.
- **Sistema de Roles:** Diferenciación clara entre `Cliente` y `Administrador`, cada uno con sus propios permisos y vistas.
- **Seguridad:**
  - Contraseñas hasheadas en la base de datos.
  - Protección contra acceso no autorizado a rutas y directorios (`.htaccess`).
  - Uso de variables de entorno para datos sensibles (próximamente).
- **Base de Datos Relacional:** Esquema bien definido con integridad referencial para gestionar productos, usuarios, roles y compras.
- **Diseño Moderno:** Interfaz de usuario atractiva y coherente gracias a una paleta de colores definida.

## ⚙️ Stack Tecnológico

- **Backend:** PHP 8.1+
- **Base de Datos:** MySQL 8.0+
- **Servidor Web:** Apache con `mod_rewrite` habilitado.
- **Frontend:** HTML5, CSS3, JavaScript.
- **Dependencias:** Composer para autoloading de clases.

## 🔧 Instalación

1.  **Clonar el Repositorio:**

    ```bash
    git clone <URL_DEL_REPOSITORIO> amarena-store
    cd amarena-store
    ```

2.  **Instalar Dependencias:**
    Asegúrate de tener Composer instalado y ejecuta:

    ```bash
    composer install
    ```

3.  **Crear la Base de Datos:**

    - Crea una base de datos en MySQL (ej. `amarena_store`).
    - Importa el esquema y los datos iniciales usando el archivo `public/scripts/create-database.sql`:

    ```bash
    mysql -u tu_usuario -p amarena_store < public/scripts/create-database.sql
    ```

4.  **Configurar las Credenciales:**

    - Renombra o copia `config/database.php.example` a `config/database.php`.
    - Edita `config/database.php` con tus credenciales de acceso a la base de datos.
    - **(Opcional pero recomendado)** Configura las variables de entorno para el envío de correo en `config/mail.php`.

5.  **Configurar el Servidor Web:**
    - **Opción A (Recomendada): VirtualHost de Apache**
      Apunta el `DocumentRoot` de tu VirtualHost al directorio `public/` del proyecto. Esto proporciona la máxima seguridad.
    - **Opción B: Servidor de Desarrollo de PHP**
      Para un entorno de desarrollo rápido, ejecuta el siguiente comando desde la raíz del proyecto:
      ```bash
      php -S localhost:8000 -t public
      ```
      Luego, accede a `http://localhost:8000` en tu navegador.

## 🏗️ Arquitectura y Estructura del Proyecto

El proyecto sigue estrictamente el patrón **Modelo-Vista-Controlador (MVC)** para separar la lógica de negocio, la presentación y el control del flujo de la aplicación.

```
amarena-store/
├── app/                 # Código de la aplicación (NO accesible públicamente)
│   ├── Controllers/     # Controladores
│   ├── Models/          # Modelos de datos
│   ├── Views/           # Vistas
│   ├── Services/        # Servicios
│   ├── Middleware/      # Middleware
│   └── Utils/           # Utilidades
├── config/              # Configuración (NO accesible públicamente)
│   ├── config.php
│   ├── database.php
│   └── routes.php
├── public/              # Archivos públicos (punto de entrada - ÚNICO accesible)
│   ├── css/             # Estilos CSS
│   ├── js/              # Scripts JavaScript
│   ├── img/             # Imágenes
│   ├── index.php        # Punto de entrada
│   └── .htaccess
├── vendor/              # Dependencias de Composer
├── .htaccess            # Redirección a public/
├── composer.json
└── database.sql
```

**Nota importante:**

- `config/` y `app/` están en la raíz y NO son accesibles públicamente (protegidos por .htaccess)
- Solo `public/` es accesible desde el navegador
- Los archivos estáticos (`css/`, `js/`, `img/`) deben estar dentro de `public/`

## 🎨 Nueva Paleta de Colores

- **Rosa Medio:** `#D96A7E`
- **Rosa Profundo:** `#BF4163`
- **Rosa Vibrante:** `#F26389`
- **Beige Claro:** `#F2E0D0`
- **Rosa Pastel:** `#F2B6B6`

## 👤 Usuarios por Defecto

**Administrador:**

- Email: `admin@amarenastore.com`
- Password: `admin123`

## 📝 Páginas Disponibles

- `/` - Inicio (con FAQ integrado)
- `/catalog` - Catálogo de productos
- `/about` - Sobre Nosotros
- `/contacto` - Formulario de contacto
- `/carrito` - Carrito de compras
- `/admin` - Panel de administración (requiere login admin)

## 🔐 Autenticación

El sistema soporta dos tipos de usuarios:

- **Cliente:** Puede ver productos, agregar al carrito y realizar compras
- **Admin:** Acceso al panel de administración con funciones adicionales

## 🛠️ Desarrollo

Para desarrollo local, puedes usar el servidor integrado de PHP:

```bash
php -S localhost:8000 -t public
```

Luego accede a: `http://localhost:8000`

## 📄 Licencia

Este proyecto es parte del trabajo final de la materia.
