<?php
/**
 * Configuración de rutas
 * Agregadas rutas para gestión de stock
 */

return [
    // Públicas
    'GET' => [
        '/' => 'HomeController@index',
        '/home' => 'HomeController@index',
        '/catalog' => 'ProductController@index',
        '/producto/{id}' => 'ProductController@show',
        '/about' => 'AboutController@index',
        '/contact' => 'ContactController@index',
        '/cart' => 'CartController@index',
        '/carrito' => 'CartController@index',
        '/checkout' => 'CheckoutController@index', // Agregada ruta de checkout
        '/mis-ordenes' => 'OrderController@myOrders',
        '/orden/{id}' => 'OrderController@show',
        '/admin' => 'AdminController@index',
        '/admin/productos' => 'AdminController@products',
        '/admin/ordenes' => 'AdminOrderController@index',
        '/admin/ordenes/{id}' => 'AdminOrderController@show',
        '/admin/productos/nuevo' => 'AdminController@createProductForm',
        '/admin/productos/editar/{id}' => 'AdminController@editProductForm',
        '/admin/productos/eliminar/{id}' => 'AdminController@deleteProduct',
        '/pago/exitoso' => 'PaymentController@success',
        '/pago/fallido' => 'PaymentController@failure',
        '/pago/pendiente' => 'PaymentController@pending',
        '/pdf/descargar-comprobante/{id}' => 'PdfController@downloadReceipt',
    ],
    
    // Autenticación y acciones
    'POST' => [
        '/login' => 'AuthController@login',
        '/register' => 'AuthController@register',
        '/logout' => 'AuthController@logout',
        '/contact/enviar' => 'ContactController@send',
        '/cart/agregar' => 'CartController@add',
        '/carrito/agregar' => 'CartController@add',
        '/cart/actualizar' => 'CartController@update',
        '/carrito/actualizar' => 'CartController@update',
        '/cart/eliminar' => 'CartController@remove',
        '/carrito/eliminar' => 'CartController@remove',
        '/cart/vaciar' => 'CartController@clear',
        '/carrito/vaciar' => 'CartController@clear',
        '/admin/productos/crear' => 'AdminController@storeProduct',
        '/admin/productos/actualizar/{id}' => 'AdminController@updateProduct',
        '/admin/verificar-stock' => 'AdminController@checkStock',
        '/admin/actualizar-stock' => 'AdminController@updateStock',
        '/admin/productos-stock-bajo' => 'AdminController@lowStockProducts',
        '/orden/crear' => 'OrderController@create',
        '/orden/cancelar' => 'OrderController@cancel',
        '/admin/orden/cambiar-estado' => 'AdminOrderController@changeStatus',
        '/admin/ordenes/estadisticas' => 'AdminOrderController@stats',
        '/pago/iniciar' => 'PaymentController@initiate',
        '/pago/webhook' => 'PaymentController@webhook',
    ],
];
