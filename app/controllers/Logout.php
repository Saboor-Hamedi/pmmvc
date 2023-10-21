<?php

use App\core\Direction;
use App\models\LogoutModel;

class Logout
{
  use Direction;
  public function index()
  {
    $logout = new LogoutModel;
    $logout->logout();
    $this->redirect('/Login');
    exit;
  }
}
