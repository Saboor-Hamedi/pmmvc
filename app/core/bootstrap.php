<?php 
session_start();
use Dotenv\Dotenv;

require_once __DIR__ . '/config.php';
require_once APPROOT .'/../vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__);
// $dotenv->load();
// $app = require_once APPROOT .'/bin/doctrine.php';
DEBUG ? ini_set('display_errors', 1) : ini_set('display_errors', 0);
// ! check the error
use App\core\MainApp;
$load = new MainApp();
$load->display();