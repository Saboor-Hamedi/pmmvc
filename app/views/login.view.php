<?php

use App\core\FlashMessage;
use App\core\HtmlUtils;

$flash = new FlashMessage;
require APPROOT . '/views/init/header.php';
require APPROOT . '/views/init/navbar.php';
$auth->loggedOut();
?>

<main class="login-container">
  <div class="center-container">
    <?php
    $flash->displayMessages();
    ?>

    <form action="" method="POST">
      <div class="form-group ">
        <input type="text" class="form-control" name="email" id="email" value="<?php HtmlUtils::getInputValue('email'); ?>" placeholder="Email Address">
        <span class="error">
          <?php
          if (!empty($errors['email'])) {
            echo $errors['email'];
          }
          ?>
        </span>
      </div>

      <div class="form-group">
        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        <span class="error">
          <?php
          if (!empty($errors['password'])) {
            echo $errors['password'];
          }
          ?>
        </span>
      </div>

      <div class="form-floating">
        <button type="submit" name="login-btn" class="btn btn-primary w-100 py-2" id="login-btn">
          Login
        </button>
      </div>
    </form>
  </div>
</main>
<?php require APPROOT . '/views/init/footer.php'; ?>