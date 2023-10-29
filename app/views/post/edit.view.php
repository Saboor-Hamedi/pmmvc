<?php

use App\core\FlashMessage;

$flash = new FlashMessage;
require APPROOT . '/views/init/header.php';
require APPROOT . '/views/init/navbar.php';
$auth->loggedIn([0, 1, 2]);
$errors = $data['errors'] ?? [0];
?>
<div class="blog-container">
    <div class="form-container">
    <?php if (!empty($post) and is_object($post)) : ?>
        <form action="/Home/update/<?php echo $post->id; ?>" method="POST">
            <div class="inner-form">
            <div class="form-group">
                <input type="hidden" name="id" class="form-control" id="id" value="<?php echo $post->id; ?>" placeholder="Post id">
            </div>
            <div class="form-group">
                <input type="text" name="title" class="form-control" id="title" value="<?php echo $post->title; ?>" placeholder="Edit title">
                <span class="error">
                    <?php
                    if (!empty($errors['title'])) {
                        echo $errors['title'];
                    }
                    ?>
                </span>
            </div>
            <div class="form-group">
                <textarea name="content" class="form-control" id="content" cols="10" rows="5"><?php echo $post->content; ?></textarea>
                <span class="error">
                    <?php
                    if (!empty($errors['content'][0])) {
                        echo $errors['content'];
                    }
                    ?>
                </span>
            </div>
            </div>
            <div class="button-container p-2">
                <button type="submit" class="btn btn-primary btn-sm multiple-submit">Update</button>
            </div>
        </form>
    <?php endif; ?>
    </div>
</div>
<?php require APPROOT . '/views/init/footer.php'; ?>