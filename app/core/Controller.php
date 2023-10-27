<?php

namespace App\core;

class Controller
{
    public function view($name, $data = [])
    {
        if (is_array($data) && !empty($data)) {
            extract($data);
        } elseif (is_object($data)) {
            $data = get_object_vars($data);
            extract($data);
        }
    
        $filename = __DIR__ . '/../views/' . $name . '.view.php';
    
        if (!file_exists($filename)) {
            $filename = $name . '.view.php';
        }
    
        if (file_exists($filename)) {
            require $filename;
        } else {
            require_once __DIR__ . '/../views/error.view.php';
        }
    }
    
}
