<?php
session_start();
require_once '../vendor/autoload.php';
require_once '../app/core/Config.php';

// ! check the error
DEBUG ? ini_set('display_errors', 1) : ini_set('display_errors', 0);

use App\core\MainApp;

$load = new MainApp();
$load->display();



?>
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>