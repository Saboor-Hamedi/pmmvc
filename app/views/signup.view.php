<?php

use App\core\FlashMessage;
use App\core\HtmlUtils;

$flash = new FlashMessage;
require APPROOT . '/views/init/header.php';
require APPROOT . '/views/init/navbar.php';
$auth->loggedIn([0,1,2]);
?>

<main class="main">
  <div class="login-container">
        <form action="" method="POST">
            <div class="form-group ">
                <input type="text" class="form-control" name="username" id="username" value="<?php HtmlUtils::getInputValue('username'); ?>" placeholder="Username">
                <span class="error">
                    <?php
                    if (!empty($errors['username'])) {
                        echo $errors['username'];
                    }
                    ?>
                </span>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" value="<?php HtmlUtils::getInputValue('email') ?>" placeholder="email@example.com">
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
            <div class="form-group mb-2">
                <select class="custom-select" name="roles" id="roles" value="<?php HtmlUtils::getInputValue('roles') ?>" aria-label="Default select example">
                    <option value="">Select roles</option>
                    <option value="0" <?= (isset($_POST['roles']) && $_POST['roles'] === '0') ? 'selected' : ''; ?>>Admin
                    </option>
                    <option value="1" <?= (isset($_POST['roles']) && $_POST['roles'] === '1') ? 'selected' : ''; ?>>Student
                    </option>
                    <option value="2" <?= (isset($_POST['roles']) && $_POST['roles'] === '2') ? 'selected' : ''; ?>>Teacher
                    </option>
                </select>
                <span class="error">
                    <?php
                    if (!empty($errors['roles'])) {
                        echo $errors['roles'];
                    }
                    ?>
                </span>
            </div>
            <div class="form-floating">
                <button type="submit" name="sign-up-btn" class="w-100 py-2" id="sign-up-btn">
                    Sign in
                </button>
            </div>
        </form>
    </div>
</main>
<?php require APPROOT . '/views/init/footer.php';    ?>