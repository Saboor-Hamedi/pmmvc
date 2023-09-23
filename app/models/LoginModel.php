<?php

namespace App\models;

use App\core\Model;
use App\core\Validation;

class LoginModel
{
  use Model;
  protected $table = 'users';
  protected $email;
  protected $password;
  protected $allowColumns = [
    'email',
    'password'
  ];
  public function validate($data)
  {
    $validate = new Validation;

    // Validate the email
    $this->email = $validate->onlyEmail($data['email'], [
      ['required', 'email is required'],
      ['email', 'email is invalid'],
    ]);
    // Validate the password
    $this->password = $validate->onlyPassword($data['password'], [
      ['required', 'password is required']
    ]);
    $errors = [];
    // Check if there are errors for the 'email' field
    if (!empty($this->email)) {
      $errors['email'] = $this->email[0]; // Only the first error
    }
    if (!empty($this->password)) {
      $errors['password'] = $this->password[0];
    }

    return $errors;
  }
}
