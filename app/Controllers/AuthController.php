<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Session;
use App\Models\User;

class AuthController extends Controller
{
    private $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new User();
    }

    public function showLogin()
    {
        if (Auth::check()) {
            $this->redirect('/');
        }
        $this->view('auth/login', ['csrf_token' => $this->generateCsrfToken()]);
    }

    public function login()
    {
        $this->validateCsrf();
        
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            Session::flash('error', 'Email and password are required');
            $this->redirect('/login');
        }

        $user = $this->userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            unset($user['password']);
            Auth::login($user);
            Session::flash('success', 'Welcome back!');
            $this->redirect('/');
        } else {
            Session::flash('error', 'Invalid email or password');
            $this->redirect('/login');
        }
    }

    public function showRegister()
    {
        if (Auth::check()) {
            $this->redirect('/');
        }
        $this->view('auth/register', ['csrf_token' => $this->generateCsrfToken()]);
    }

    public function register()
    {
        $this->validateCsrf();
        
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        // Validation
        if (empty($username) || empty($email) || empty($password)) {
            Session::flash('error', 'All fields are required');
            $this->redirect('/register');
        }

        if ($password !== $confirmPassword) {
            Session::flash('error', 'Passwords do not match');
            $this->redirect('/register');
        }

        if (strlen($password) < 6) {
            Session::flash('error', 'Password must be at least 6 characters');
            $this->redirect('/register');
        }

        // Check if user exists
        if ($this->userModel->findByEmail($email)) {
            Session::flash('error', 'Email already registered');
            $this->redirect('/register');
        }

        if ($this->userModel->findByUsername($username)) {
            Session::flash('error', 'Username already taken');
            $this->redirect('/register');
        }

        // Create user
        $userId = $this->userModel->create([
            'username' => $username,
            'email' => $email,
            'password' => $password
        ]);

        $user = $this->userModel->findById($userId);
        Auth::login($user);
        Session::flash('success', 'Registration successful!');
        $this->redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        Session::flash('success', 'You have been logged out');
        $this->redirect('/login');
    }
}
