<?php

use App\core\FlashMessage;

$flash = new FlashMessage;
require APPROOT . '/views/init/header.php';
require APPROOT . '/views/init/navbar.php';
$auth->check_loggedin([0, 1, 2]);
?>


<?php require APPROOT . '/views/init/footer.php';    ?>