<?php

namespace App\services;

use App\core\Direction;

class Auth
{
  use Direction;

 

  public function login($user_id)
  {
    $_SESSION['user_id'] = $user_id; // Store the entire user object
  }

  public function isAuthenticated()
  {
    return isset($_SESSION['user_id']);
  }

  public function user()
  {
    return $this->isAuthenticated() ? $_SESSION['user_id'] : null;
  }
 
  public function hasRole($allowedRoles)
  {
    $user = $this->user();

    // Ensure $allowedRoles is an array
    if (!is_array($allowedRoles)) {
      $allowedRoles = [$allowedRoles];
    }

    if ($user) {
      $userRoles = (array)$user->roles; // Convert user roles to an array if it's not already

      // Check if there is an intersection between user roles and allowed roles
      if (count(array_intersect($userRoles, $allowedRoles)) > 0) {
        return true; // The user has at least one of the allowed roles
      }
    }

    return false; // User does not have any of the allowed roles or is not authenticated
  }


  public function loggedIn($allowedRoles = [], $redirectUrl = '/Home')
  {
    if (!$this->isAuthenticated()) {
      $this->redirect('/Login'); // Redirect to the login page if not authenticated
      exit;
    }

    if (!empty($allowedRoles) && !$this->hasRole($allowedRoles)) {
      $this->redirect($redirectUrl); // Redirect to the specified page if roles don't match
      exit;
    }
  }

  public function loggedOut($redirectUrl = '/Home')
  {
    if ($this->isAuthenticated()) {
      $this->redirect($redirectUrl); // Redirect to the specified page if logged in
      exit;
    }
  }
}
