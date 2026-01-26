<?php

namespace App\Controllers;

use App\Models\User;
use App\Utils\Session;
use App\Utils\Email;

class AuthController extends BaseController
{
    /**
     * Login seguro con password_verify
     * Ahora usa password_verify() en lugar de comparar en texto plano
     */
    public function login()
    {
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        
        // 1. Validamos que los campos no estén vacíos.
        if (empty($email) || empty($password)) {
            Session::flash('login_error', 'Email y contraseña son requeridos.');
            $this->redirect('/?login_error=1');
        } else {
            // 2. Intentamos autenticar usando el método seguro del modelo User
            $userModel = new User();
            $user = $userModel->authenticate($email, $password);

            if ($user) {
                // 3. Si las credenciales son correctas, iniciamos la sesión.
                Session::set('user_id', $user['idusuario']);
                Session::set('user_name', $user['usnombre']);
                Session::set('user_email', $user['usmail']);
                
                $role = $userModel->getRole($user['idusuario']);
                Session::set('user_role', $role);
                
                Session::flash('success', 'Ha ingresado correctamente');
                
                // Si el usuario es administrador, lo redirigimos a su panel. Si no, a la página de inicio.
                if ($role === 'Administrador') {
                    $this->redirect('/admin');
                } else {
                    $this->redirect('/');
                }
            } else {
                // 4. Si las credenciales son incorrectas, mostramos un error.
                Session::flash('login_error', 'Credenciales incorrectas.');
                $this->redirect('/?login_error=1');
            }
        }
    }

    /**
     * Registro de nuevo usuario
     * Ahora envía email de bienvenida
     */
    public function register()
    {
        $name = trim($_POST['nombre'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $passwordConfirm = trim($_POST['password_confirm'] ?? '');
        
        // 1. Validaciones
        if (empty($name) || empty($email) || empty($password)) {
            Session::flash('register_error', 'Todos los campos son requeridos.');
            $this->redirect('/?register=1');
            return;
        }
        
        if ($password !== $passwordConfirm) {
            Session::flash('register_error', 'Las contraseñas no coinciden.');
            $this->redirect('/?register=1');
            return;
        }
        
        if (strlen($password) < 8) {
            Session::flash('register_error', 'La contraseña debe tener al menos 8 caracteres.');
            $this->redirect('/?register=1');
            return;
        }
        
        // 2. Crear el usuario
        $userModel = new User();
        $userId = $userModel->create([
            'usnombre' => $name,
            'email' => $email,
            'password' => $password
        ]);
        
        if ($userId) {
            // 3. Asignar rol de Cliente por defecto
            $userModel->assignRole($userId, 2); // 2 = Cliente
            
            $emailer = new Email();
            $emailer->sendWelcomeEmail($email, $name);
            
            Session::flash('success', 'Usuario registrado exitosamente. Revisa tu correo y ahora puedes iniciar sesión.');
            $this->redirect('/?login=1');
        } else {
            Session::flash('register_error', 'Error al registrar el usuario. El email ya está en uso.');
            $this->redirect('/?register=1');
        }
    }

    /**
     * Logout
     */
    public function logout()
    {
        Session::destroy();
        Session::flash('success', 'Ha cerrado sesión correctamente');
        $this->redirect('/');
    }
}
