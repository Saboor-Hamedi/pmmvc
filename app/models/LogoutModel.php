<?php

namespace App\models;

class LogoutModel
{
  public function logout()
  {
    // Start the session
    session_start();

    // Destroy the session to log the user out
    session_destroy();
  }
}
