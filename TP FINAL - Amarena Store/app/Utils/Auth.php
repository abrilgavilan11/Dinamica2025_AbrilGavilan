<?php

namespace App\Utils;

use App\Models\Menu;

/**
 * Nuevo archivo: Utilidades de autenticación y autorización
 * Centraliza la lógica de permisos y acceso
 */
class Auth
{
    /**
     * Verifica si el usuario está autenticado
     */
    public static function isAuthenticated(): bool
    {
        return Session::has('user_id');
    }

    /**
     * Obtiene el ID del usuario actual
     */
    public static function getUserId(): ?int
    {
        return Session::get('user_id');
    }

    /**
     * Obtiene el rol del usuario actual
     */
    public static function getUserRole(): ?string
    {
        return Session::get('user_role');
    }

    /**
     * Verifica si el usuario tiene un rol específico
     */
    public static function hasRole(string $role): bool
    {
        return Auth::getUserRole() === $role;
    }

    /**
     * Verifica si el usuario es administrador
     */
    public static function isAdmin(): bool
    {
        return Auth::hasRole('Administrador');
    }

    /**
     * Verifica si el usuario es cliente
     */
    public static function isClient(): bool
    {
        return Auth::hasRole('Cliente');
    }

    /**
     * Redirige si no está autenticado
     */
    public static function requireLogin(): void
    {
        if (!self::isAuthenticated()) {
            Session::flash('error', 'Debes iniciar sesión para acceder a esta página.');
            header('Location: /?login=1');
            exit;
        }
    }

    /**
     * Redirige si no es administrador
     */
    public static function requireAdmin(): void
    {
        self::requireLogin();
        if (!self::isAdmin()) {
            Session::flash('error', 'No tienes permiso para acceder a esta página.');
            header('Location: /');
            exit;
        }
    }

    /**
     * Obtiene el menú dinámico según el rol del usuario
     */
    public static function getMenuByRole(): array
    {
        $role = self::getUserRole();
        
        // Mapear rol a ID
        $roleMap = ['Administrador' => 1, 'Cliente' => 2];
        $roleId = $roleMap[$role] ?? 2;
        
        $menuModel = new Menu();
        return $menuModel->getMenuByRole($roleId);
    }
}
