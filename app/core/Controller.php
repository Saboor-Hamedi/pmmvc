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

        $filename = '../app/views/' . $name . '.view.php';
        if (file_exists($filename)) {
            require  $filename;
        } else {
            require  '../views/error.view.php';
        }
    }
}
