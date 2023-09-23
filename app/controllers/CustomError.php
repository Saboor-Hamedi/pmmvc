<?php
namespace App\controllers;
use App\core\Controller;
class CustomError extends Controller{
    public function index(){
        $this->view('error');
    }


}