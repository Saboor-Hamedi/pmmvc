<?php

use App\core\Controller;

/**
 * Summary of Home
 */
class Home extends Controller
{
    /**
     * Summary of index
     * @return void
     */
    public function index()
    {
        $this->view('home');
    }
}
