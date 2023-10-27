<?php 
// namespace App\controllers\Products;
use App\core\Controller;

class Product extends Controller {

    public function index(){

        $this->view('products/product');

    }

}
