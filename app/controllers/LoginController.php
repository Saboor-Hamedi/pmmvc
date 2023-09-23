<?php

use App\core\Direction;
use App\core\Controller;
use App\core\HtmlUtils;
use App\core\FlashMessage;
use App\core\VarDump;
use App\models\LoginModel;
use App\services\Auth;

class LoginController extends Controller
{
    use Direction, VarDump;
    public function index()
    {
        $auth = new Auth();
        // Initialize data array
        $data = [];
        $users = new LoginModel;
        $flash = new FlashMessage;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate  input
            $validate = $users->validate($_POST);
            if ($validate) {
                $data['errors'] = $validate;
                $flash->setMessage(implode(', ', $validate), 'danger');
            } else {
                $data = [
                    'email' => HtmlUtils::escape($_POST['email']),
                    'password' => $_POST['password'],
                ];
                // login 
                $login = $users->first([
                    'email' => $data['email'],
                ]);
                if ($login && password_verify($data['password'], $login->password)) {
                    // Authenticate the user using the Auth class
                    $auth->auth($login);
                    $this->redirect('/Home');
                } else {
                    // Display an error message
                    $flash->setMessage('Check your email or password', 'info');
                    // $this->redirect('/LoginController');
                }
            }
        }
        $this->view('login', $data);
    }
}
