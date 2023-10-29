<?php

namespace App\core;

use Exception;

class MainApp
{
  
    private $load_controller_url;
    private $controller;
    private $method;

    public function __construct()
    {
        $this->controller = 'Home';
        $this->method = 'index';
    }
    public static function splitURL()
    {
        $home_url = $_GET['url'] ?? 'Home';
        $home_url = explode('/', trim($home_url, '/'));
        return $home_url;
    }
    private function loadController()
    {
        $this->load_controller_url = self::splitURL();
        $sanitized_controller = $this->sanitizeInput($this->load_controller_url[0]);
        $file_name = '../app/controllers/' . ucfirst($sanitized_controller) . '.php';

        if (file_exists($file_name)) {
            require $file_name;
            $this->controller = ucfirst($sanitized_controller);
            unset($this->load_controller_url[0]);
        } else {
            //require '../controllers/Error.php'; // Change to your error class
            $this->controller = '\App\controllers\Error';
        }
    }

    private function sanitizeInput($input)
    {
        // Remove HTML tags and unwanted spaces
        $sanitized = trim(strip_tags($input));

        // Apply FILTER_SANITIZE_EMAIL
        $sanitized = filter_var($sanitized, FILTER_SANITIZE_EMAIL);

        // Apply FILTER_FLAG_STRIP_LOW and FILTER_FLAG_STRIP_HIGH
        $sanitized = filter_var($sanitized, FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);

        // Validate alphanumeric, hyphen, and underscore characters
        if (!preg_match('/^[a-zA-Z0-9\-_]+$/', $sanitized)) {
            // Invalid input, handle it accordingly (e.g., log, throw an error, etc.)
            // For now, let's return a default value
            return 'default';
        }

        return $sanitized;
    }


    public function display()
    {
        ob_start();
        $this->loadController();
        $controller = new $this->controller;

        try {
            if (!empty($this->load_controller_url[1])) {
                $method = $this->load_controller_url[1];
                if (method_exists($controller, $method)) {
                    $this->method = $method;
                    unset($this->load_controller_url[1]);
                } else {
                    $this->method = 'index';
                }
            }
            call_user_func_array([$controller, $this->method], $this->load_controller_url);
        } catch (Exception $e) {
            echo 'something wrong on function ' . $this->method;
        }
        ob_end_flush();
    }
}