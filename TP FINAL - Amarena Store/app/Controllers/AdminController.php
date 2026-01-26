<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Utils\Session;
use App\Utils\Auth;

class AdminController extends BaseController
{
    public function __construct()
    {
        // Proteger todas las rutas de este controlador
        Auth::requireAdmin();
    }

    public function index()
    {
        // Muestra la vista del panel principal del administrador.
        $this->view('admin.dashboard', [
            'title' => 'Dashboard - Admin',
            'pageCss' => 'admin'
        ]);
    }

    public function products()
    {
        // Obtenemos todos los productos desde el modelo.
        $productModel = new Product();
        $allProducts = $productModel->getAll();

        // Muestra la vista para gestionar productos.
        $this->view('admin.products', [
            'title' => 'Gestionar Productos - Admin',
            'pageCss' => 'admin',
            'products' => $allProducts
        ]);
    }

    public function orders()
    {
        // Muestra la vista para gestionar órdenes.
        $this->view('admin.orders', [
            'title' => 'Gestionar Órdenes - Admin',
            'pageCss' => 'admin'
        ]);
    }

    public function createProductForm()
    {
        // Obtenemos todas las categorías para el menú desplegable del formulario.
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        // Mostramos la vista del formulario.
        $this->view('admin.product_form', [
            'title' => 'Agregar Producto - Admin',
            'pageCss' => 'admin-forms',
            'categories' => $categories
        ]);
    }

    public function storeProduct()
    {
        // 1. Recolectar y validar los datos del formulario
        $nombre = trim($_POST['pronombre'] ?? '');
        $detalle = trim($_POST['prodetalle'] ?? '');
        $precio = filter_var($_POST['proprecio'] ?? 0, FILTER_VALIDATE_FLOAT);
        $stock = filter_var($_POST['procantstock'] ?? 0, FILTER_VALIDATE_INT);
        $categoriaId = filter_var($_POST['idcategoria'] ?? null, FILTER_VALIDATE_INT);
        $imagen = $_FILES['proimagen'] ?? null;

        if (empty($nombre) || empty($detalle) || $precio === false || $precio <= 0 || $stock === false || $stock < 0 || empty($categoriaId)) {
            Session::flash('error', 'Todos los campos son obligatorios y deben tener valores válidos.');
            $this->redirect('/admin/productos/nuevo');
            return;
        }

        // 2. Manejar la subida de la imagen
        $nombreImagen = 'default.jpg'; // Valor por defecto
        if ($imagen && $imagen['error'] === UPLOAD_ERR_OK) {
            // Directorio de subida
            $uploadDir = PUBLIC_PATH . '/uploads/products/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Generar un nombre de archivo único
            $extension = pathinfo($imagen['name'], PATHINFO_EXTENSION);
            $nombreImagen = uniqid('product_', true) . '.' . $extension;
            
            // Mover el archivo
            if (!move_uploaded_file($imagen['tmp_name'], $uploadDir . $nombreImagen)) {
                Session::flash('error', 'Hubo un error al subir la imagen.');
                $this->redirect('/admin/productos/nuevo');
                return;
            }
        }

        // 3. Preparar los datos para el modelo
        $productData = [
            'pronombre' => $nombre,
            'prodetalle' => $detalle,
            'proprecio' => $precio,
            'procantstock' => $stock,
            'idcategoria' => $categoriaId,
            'proimagen' => $nombreImagen
        ];

        // 4. Guardar en la base de datos a través del modelo
        $productModel = new Product();
        $productModel->create($productData);

        Session::flash('success', 'Producto agregado exitosamente.');
        $this->redirect('/admin/productos');
    }

    /**
     * Muestra el formulario para editar un producto existente.
     */
    public function editProductForm($id)
    {
        $productModel = new Product();
        $product = $productModel->findById($id);

        if (!$product) {
            Session::flash('error', 'Producto no encontrado.');
            $this->redirect('/admin/productos');
            return;
        }

        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        // Reutilizamos la misma vista del formulario de creación
        $this->view('admin.product_form', [
            'title' => 'Editar Producto - Admin',
            'pageCss' => 'admin-forms',
            'categories' => $categories,
            'product' => $product // Pasamos el producto a la vista
        ]);
    }

    /**
     * Procesa la actualización de un producto existente.
     */
    public function updateProduct($id)
    {
        // 1. Recolectar y validar datos
        $nombre = trim($_POST['pronombre'] ?? '');
        $detalle = trim($_POST['prodetalle'] ?? '');
        $precio = filter_var($_POST['proprecio'] ?? 0, FILTER_VALIDATE_FLOAT);
        $stock = filter_var($_POST['procantstock'] ?? 0, FILTER_VALIDATE_INT);
        $categoriaId = filter_var($_POST['idcategoria'] ?? null, FILTER_VALIDATE_INT);
        $imagen = $_FILES['proimagen'] ?? null;

        if (empty($nombre) || empty($detalle) || $precio === false || $precio <= 0 || $stock === false || $stock < 0 || empty($categoriaId)) {
            Session::flash('error', 'Todos los campos son obligatorios.');
            $this->redirect('/admin/productos/editar/' . $id);
            return;
        }

        $productModel = new Product();
        $currentProduct = $productModel->findById($id);

        // 2. Manejar la subida de la imagen (si se proporciona una nueva)
        $nombreImagen = $currentProduct['proimagen']; // Mantener la imagen actual por defecto

        if ($imagen && $imagen['error'] === UPLOAD_ERR_OK) {
            // Directorio de subida
            $uploadDir = PUBLIC_PATH . '/uploads/products/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Generar un nombre de archivo único
            $extension = pathinfo($imagen['name'], PATHINFO_EXTENSION);
            $nombreImagen = uniqid('product_', true) . '.' . $extension;
            
            // Mover el nuevo archivo
            if (!move_uploaded_file($imagen['tmp_name'], $uploadDir . $nombreImagen)) {
                Session::flash('error', 'Hubo un error al subir la nueva imagen.');
                $this->redirect('/admin/productos/editar/' . $id);
                return;
            }
        }

        // 3. Preparar datos para el modelo, incluyendo la imagen
        $productData = [
            'pronombre' => $nombre,
            'prodetalle' => $detalle,
            'proprecio' => $precio,
            'procantstock' => $stock,
            'idcategoria' => $categoriaId,
            'proimagen' => $nombreImagen, // Usar la imagen nueva o la existente
        ];

        // 4. Actualizar en la base de datos
        $productModel->update($id, $productData);

        Session::flash('success', 'Producto actualizado exitosamente.');
        $this->redirect('/admin/productos');
    }

    /**
     * Elimina un producto.
     */
    public function deleteProduct($id)
    {
        $productModel = new Product();
        $product = $productModel->findById($id);

        if (!$product) {
            Session::flash('error', 'Producto no encontrado.');
            $this->redirect('/admin/productos');
            return;
        }

        $productModel->delete($id);

        Session::flash('success', 'Producto eliminado exitosamente.');
        $this->redirect('/admin/productos');
    }

    /**
     * Nuevo método: Obtiene el stock actual de un producto
     * Endpoint AJAX para verificar disponibilidad
     */
    public function checkStock()
    {
        $productId = intval($_POST['product_id'] ?? 0);
        $quantity = intval($_POST['quantity'] ?? 1);

        if (!$productId || $quantity < 1) {
            $this->json(['success' => false, 'message' => 'Parámetros inválidos'], 400);
            return;
        }

        $productModel = new Product();
        $product = $productModel->findById($productId);

        if (!$product) {
            $this->json(['success' => false, 'message' => 'Producto no encontrado'], 404);
            return;
        }

        $hasStock = $product['procantstock'] >= $quantity;

        $this->json([
            'success' => true,
            'product_id' => $productId,
            'current_stock' => $product['procantstock'],
            'requested_quantity' => $quantity,
            'has_stock' => $hasStock,
            'message' => $hasStock ? 
                'Stock disponible' : 
                'Stock insuficiente. Disponibles: ' . $product['procantstock']
        ]);
    }

    /**
     * Nuevo método: Actualiza el stock manualmente desde admin
     * Endpoint AJAX para ajustar stock
     */
    public function updateStock()
    {
        Auth::requireAdmin();

        try {
            $productId = intval($_POST['product_id'] ?? 0);
            $newStock = intval($_POST['new_stock'] ?? 0);
            $reason = trim($_POST['reason'] ?? 'Ajuste manual'); // restock, loss, correction, etc.

            if (!$productId || $newStock < 0) {
                $this->json(['success' => false, 'message' => 'Parámetros inválidos'], 400);
                return;
            }

            $productModel = new Product();
            $product = $productModel->findById($productId);

            if (!$product) {
                $this->json(['success' => false, 'message' => 'Producto no encontrado'], 404);
                return;
            }

            $oldStock = $product['procantstock'];

            // Actualizar el stock
            $sql = "UPDATE producto SET procantstock = ? WHERE idproducto = ?";
            $db = \App\Utils\Database::getInstance();
            $db->query($sql, [$newStock, $productId]);

            // Registrar el cambio (opcional: crear tabla de historial de stock)
            error_log("Stock actualizado - Producto: {$productId}, Anterior: {$oldStock}, Nuevo: {$newStock}, Razón: {$reason}");

            $this->json([
                'success' => true,
                'message' => "Stock actualizado: {$oldStock} → {$newStock}",
                'old_stock' => $oldStock,
                'new_stock' => $newStock
            ]);
        } catch (\Exception $e) {
            error_log("Error al actualizar stock: " . $e->getMessage());
            $this->json(['success' => false, 'message' => 'Error interno'], 500);
        }
    }

    /**
     * Nuevo método: Obtiene productos con bajo stock
     * Endpoint para alertas de reorden
     */
    public function lowStockProducts()
    {
        Auth::requireAdmin();

        try {
            $threshold = intval($_GET['threshold'] ?? 5); // Stock mínimo para alertar

            $db = \App\Utils\Database::getInstance();
            $sql = "SELECT p.*, c.catnombre 
                    FROM producto p 
                    LEFT JOIN categoria c ON p.idcategoria = c.idcategoria 
                    WHERE p.procantstock <= ? 
                    ORDER BY p.procantstock ASC";
            
            $products = $db->fetchAll($sql, [$threshold]);

            $this->json([
                'success' => true,
                'threshold' => $threshold,
                'count' => count($products),
                'products' => $products
            ]);
        } catch (\Exception $e) {
            error_log("Error al obtener productos con bajo stock: " . $e->getMessage());
            $this->json(['success' => false, 'message' => 'Error interno'], 500);
        }
    }
}
