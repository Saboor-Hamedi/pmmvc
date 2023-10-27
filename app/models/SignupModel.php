<?php

namespace App\models;

use App\core\Model;
use App\core\Validation;

class SignupModel
{
    use Model;
    protected $table = 'users';
    protected $username;
    protected $email;
    protected $password;
    protected $roles;
    protected $fillabel = [
        'username',
        'email',
        'created_at',
        'roles',
        'password'
    ];

    // Continue from where you left off in SignupModel class
    public function validate($data)
    {
        $validate = new Validation;


        // Validate the username
        $this->username = $validate->onlyString($data['username'], [
            ['required', 'username is required'],
            ['min', 'username must be at least 5 characters long', 5],
            ['no_numbers', 'username contain no numbers']
        ]);

        // Validate the email
        $this->email = $validate->onlyEmail($data['email'], [
            ['required', 'email is required'],
            ['email', 'email is invalid'],
        ]);

        // Validate the password
        $this->password = $validate->onlyPassword($data['password'], [
            ['required', 'password is required'],
            ['min', 'password must be at least 6 long', 6]
        ]);
        $this->roles = $validate->onlySelectOption($data['roles']);
        $errors = [];

        // Check if there are errors for the 'username' field
        if (!empty(($this->username))) {
            $errors['username'] = $this->username[0]; // Only the first error
        }

        // Check if there are errors for the 'email' field
        if (!empty($this->email)) {
            $errors['email'] = $this->email[0]; // Only the first error
        }

        // check if there are errors for the 'password' field
        if (!empty($this->password)) {
            $errors['password'] = $this->password[0];
        }

        if (!empty($this->roles)) {
            $errors['roles'] = $this->roles;
        }

        return $errors;
    }
}
