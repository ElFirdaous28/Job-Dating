<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Core\Security;
use App\Core\Validator;

use App\Models\User;

class AuthController extends Controller
{

    public function registerPage()
    {
        $this->view('Auth/register');
    }

    // methode to handle register
    public function handleRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['csrf_token']) && Security::validateCSRFToken($_POST['csrf_token'])) {
            $full_name = $_POST['full_name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $full_name = $_POST['full_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $rules = [
                'full_name' => 'required|min:3|max:50',
                'email' => 'required|email',
                'password' => 'required|min:8'
            ];

            $data = [
                'full_name' => $full_name,
                'email' => $email,
                'password' => $password
            ];

            $errors = Validator::validate($data, $rules);
            if (!empty($errors)) {
                Session::set("errors", $errors);
                header("Location: /register");
            } else {
                if (User::where('email', $email)->exists()) {
                    Session::set('errors', ['email' => 'This email is already registered!']);
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                    exit;
                }

                $role = (User::count() === 0) ? 'admin' : 'student';
                $user = User::create([
                    'full_name' => $full_name,
                    'email' => $email,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'role' => $role
                ]);

                Auth::setLoginSessions($user);
                Auth::userRedirect($user->role);
            }
        } else {
            header('Location: /register');
            exit;
        }
    }

    public function loginPage()
    {
        $this->view('Auth/login');
    }

    // methode to handle login
    public function handleLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['csrf_token']) && Security::validateCSRFToken($_POST['csrf_token'])) {
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $rules = [
                'email' => 'required|email',
                'password' => 'required|min:8'
            ];

            $data = [
                'email' => $email,
                'password' => $password
            ];

            $errors = Validator::validate($data, $rules);
            if (!empty($errors)) {
                Session::set("errors", $errors);
                header("Location: /login");
            } else {
                $user = Auth::login($email, $password);
                if ($user) {
                    Auth::setLoginSessions($user);
                    Auth::userRedirect($user->role);
                }
            }
        }
    }

    public function logout()
    {
        Auth::logout();
    }
}
