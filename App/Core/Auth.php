<?php

namespace App\Core;

use App\Core\View;
use App\Models\User;
use App\Core\Session;

class Auth
{
    public static function login($email, $password)
    {
        $user = User::where('email', $email)->first();

        if ($user) {
            if (password_verify($password, $user->password)) {
                return $user;
            } else {
                Session::set('errors', ['password','Wrong password!']);
            }
        } else {
            Session::set('errors', ['email','This email does not exist!']);
        }
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public static function setLoginSessions($user)
    {
        Session::set('user_logged_in_id', $user->id);
        Session::set('user_logged_in_name', $user->full_name);
        Session::set('user_logged_in_email', $user->email);
        Session::set('user_logged_in_role', $user->role ?? 'user');
    }

    public static function userRedirect($role)
    {
        if ($role === 'admin') {
            header('Location: /admin/home');
        } else {
            header('Location: /student/home');
        }
        exit;
    }

    public static function logout()
    {
        session_destroy();
        header("Location: /login");
    }
}
