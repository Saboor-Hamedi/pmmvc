<?php

use App\core\Controller;

class StoreBooksController extends Controller{
    public function index(){
     $this->view('books/store');
    }
}