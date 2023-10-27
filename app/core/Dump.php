<?php
namespace App\core;
trait Dump
{
    public function dump($var) : void
    {
        echo '<pre>';
         var_dump($var);
        echo '</pre>';
    }
}

