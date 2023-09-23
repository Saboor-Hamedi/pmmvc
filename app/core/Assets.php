<?php

namespace App\core;

class Assets
{
    // todo This class is for loading the assets, like css, js, images. 
    // todo When you develope custom mvc, its hard to load the directories, in that case we need to load the whole url, 
    // todo this where the Assets class comes handy. 
    // todo You can even modify this class, and make for every single of them a stand alone function 
    public static function assets($path)
    {
        if (!empty($path)) {
            // Get the current URL scheme (http or https)
            $scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';

            // Get the current domain and port
            $host = $_SERVER['HTTP_HOST'];

            // Get the current directory
            $directory = trim(dirname($_SERVER['PHP_SELF']), '/');

            // Generate the base URL dynamically
            $baseUrl = "$scheme://$host";
            if ($directory !== '') {
                $baseUrl .= "/$directory";
            }

            // Output the base URL, followed by the path to the asset file
            echo $baseUrl . '/' . trim($path, '/');
        } else {
            return '';
        }
    }
    // public static function required($init)
    // {
    //     require_once __DIR__ . '../../../public/init/' . $init . '.php';
    // }
    public static function required($init)
    {
        $documentRoot = $_SERVER['DOCUMENT_ROOT'];
        $absolutePath = $documentRoot . '/init/' . $init . '.php';

        require_once $absolutePath;
    }
}
