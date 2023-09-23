<?php

use App\core\Direction;
use App\models\LogoutModel;

class LogoutController
{
  use Direction;
  public function index()
  {
    $logout = new LogoutModel;
    $logout->logout();
    $this->redirect('/LoginController');
    exit;
  }
}
