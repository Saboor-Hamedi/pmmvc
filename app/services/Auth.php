<?php

namespace App\services;

use App\core\Direction;

class Auth
{
  use Direction;
  public function auth($user)
  {
    $_SESSION['user_id'] = $user->id;
    $_SESSION['username'] = $user->username;
    $_SESSION['roles'] = $user->roles;
  }

  public function isAuthenticated()
  {
    return isset($_SESSION['user_id']);
  }
  public function getUser()
  {
    if ($this->isAuthenticated()) {
      return [
        'user_id' => $_SESSION['user_id'],
        'username' => $_SESSION['username'],
        'roles' => $_SESSION['roles'],
      ];
    } else {
      return null;
    }
  }
  public function check_loggedin($allowedRoles = [])
  {
    if (isset($_SESSION['user_id'])) {
      // User is logged in, retrieve the user's role from the session
      $roles = $_SESSION['roles'];

      // Check if the user's role is allowed to access the page
      if (in_array($roles, $allowedRoles)) {
        return; // Allow execution to continue
      } else {
        $this->redirect('/Home');
        exit;
      }
    } else {
      $this->redirect('/LoginController');
      exit;
    }
  }

  public  function check_loggedout()
  {
    if (isset($_SESSION['user_id'])) {
      $this->redirect('/Home');
      exit;
    }
  }
}
