<?php
/**
 * Configuración de Mercado Pago
 */

return [
    // Usa variables de entorno en producción
    'access_token' => getenv('MERCADOPAGO_ACCESS_TOKEN') ?: 'TEST-YOUR-ACCESS-TOKEN-HERE',
    'public_key' => getenv('MERCADOPAGO_PUBLIC_KEY') ?: 'TEST-YOUR-PUBLIC-KEY-HERE',
    'webhook_token' => getenv('MERCADOPAGO_WEBHOOK_TOKEN') ?: 'your-webhook-token',
];
