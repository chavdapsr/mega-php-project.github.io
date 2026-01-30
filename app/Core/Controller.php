<?php

namespace App\Core;

class Controller
{
    protected $db;
    protected $router;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->router = new Router();
    }

    protected function view($view, $data = [])
    {
        // Ensure CSRF token is available in all views
        if (!isset($data['csrf_token'])) {
            $data['csrf_token'] = $this->generateCsrfToken();
        }
        
        extract($data);
        $viewFile = __DIR__ . '/../../views/' . $view . '.php';
        
        if (!file_exists($viewFile)) {
            die("View not found: {$view}");
        }
        
        require $viewFile;
    }

    protected function json($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function redirect($url)
    {
        header("Location: {$url}");
        exit;
    }

    protected function validateCsrf()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['csrf_token'] ?? '';
            if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {
                die("CSRF token validation failed");
            }
        }
    }

    protected function generateCsrfToken()
    {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
}
