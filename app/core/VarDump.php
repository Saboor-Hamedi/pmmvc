<?php
namespace App\core;
trait VarDump
{
    public function dump($var)
    {
        echo '<pre>';
         var_dump($var);
        echo '</pre>';
    }
}

