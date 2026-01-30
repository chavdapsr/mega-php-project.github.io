<?php

namespace App\Core;

class Session
{
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            $config = require __DIR__ . '/../../config/app.php';
            session_set_cookie_params([
                'lifetime' => $config['session']['lifetime'],
                'path' => '/',
                'domain' => '',
                'secure' => $config['session']['secure'],
                'httponly' => $config['session']['httponly'],
                'samesite' => $config['session']['samesite']
            ]);
            session_start();
        }
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

    public static function has($key)
    {
        return isset($_SESSION[$key]);
    }

    public static function remove($key)
    {
        unset($_SESSION[$key]);
    }

    public static function destroy()
    {
        session_destroy();
    }

    public static function flash($key, $value = null)
    {
        if ($value === null) {
            $message = self::get('flash_' . $key);
            self::remove('flash_' . $key);
            return $message;
        }
        self::set('flash_' . $key, $value);
    }
}
