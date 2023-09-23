<?php


$flash = new \App\core\FlashMessage;
require APPROOT . '/views/init/header.php';
require APPROOT . '/views/init/navbar.php';
$auth->check_loggedin([0, 1, 2]);

?>
<div class="container">
  <?php
  $flash->displayMessages();
  ?>
  <h1>Welcome: <?php echo $username; ?></h1>
</div>
<?php require APPROOT . '/views/init/footer.php'; ?>