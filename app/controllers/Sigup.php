<?php

use App\core\Direction;
use App\core\HtmlUtils;
use App\core\Controller;
use App\core\Dump;
use App\core\FlashMessage;
use App\models\SignupModel;

class Sigup extends Controller
{
    use Direction, Dump;
    public function index()
    {
        // Initialize data array
        $data = [];
        $flash = new FlashMessage;
        $users = new SignupModel;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate user input
            $validationErrors = $users->validate($_POST);

            if ($validationErrors) {
                // Validation failed, store errors
                $data['errors'] = $validationErrors;
            } else {
                try {
                    // Sanitize user input
                    $username = HtmlUtils::escape($_POST['username']);
                    $email = HtmlUtils::escape($_POST['email']);
                    $roles = HtmlUtils::escape($_POST['roles']);
                    $password = HtmlUtils::escape($_POST['password']); // Retrieve the plain-text password from the form
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    // Prepare user data
                    $userData = [
                        'username' => $username,
                        'email' => $email,
                        'roles' => $roles,
                        'password' => $hashedPassword
                    ];
                    $userData['email'] = $email;
                    $check = $users->where(['email' => $email]);
                    if (!empty($check)) {
                        $flash->setMessage('Email already exists', 'info');
                        $this->redirect('/Home');
                    } else {
                        // Insert user data into the database
                        $result = $users->insert_data($userData);

                        if ($result >= 0) {
                            $flash->setMessage('Successfully inserted', 'success');
                        } else {
                            $flash->setMessage('Failed to insert', 'info');
                        }
                        $this->redirect('/Home');
                    }
                } catch (Exception $e) {
                    // Handle any exceptions
                    $flash->setMessage('Something went wrong', $e->getMessage() . 'danger');
                }
            }
        }

        $this->view('signup', $data);
    }
}
