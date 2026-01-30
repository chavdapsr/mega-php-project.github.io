<?php

namespace App\Core;

class Auth
{
    public static function user()
    {
        return Session::get('user');
    }

    public static function id()
    {
        $user = self::user();
        return $user['id'] ?? null;
    }

    public static function check()
    {
        return Session::has('user');
    }

    public static function login($user)
    {
        Session::set('user', $user);
    }

    public static function logout()
    {
        Session::remove('user');
    }

    public static function requireAuth()
    {
        if (!self::check()) {
            Session::flash('error', 'Please login to access this page');
            header('Location: /login');
            exit;
        }
    }
}
