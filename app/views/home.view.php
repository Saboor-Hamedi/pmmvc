<?php

use App\services\Str;
use Carbon\Carbon;
use App\core\FlashMessage;
use App\services\Gate;

require APPROOT . '/views/init/header.php';
require APPROOT . '/views/init/navbar.php';
$auth->loggedIn([0, 1, 2]);
?>
<div class="container">
  <?php
  $flash = new FlashMessage();
  $flash->displayMessages()
  ?>
  <?php if (is_array($posts) || is_object($posts)) : ?>
    <?php foreach ($posts as $post) : ?>
      <div class="blog-post">
        <div class="blog-card">
          <h2 class="blog-post-title">
            <?php echo ucfirst($post->title); ?>
          </h2>
          <small>
            <?php
            $carbon = new Carbon();
            echo $carbon->format('l jS, Y', $post->created_at);
            ?>
          </small>
          <strong>
            <a href="#"><?php echo ucfirst($post->user->username) ?? 'anonymous'; ?>
          </a>
        </strong>
          <p>
            <?php echo Str::limit(ucfirst($post->content), 100, '...') ?>
            <a href="/Home/show/<?php echo $post->id; ?>">Read More</a>
          </p>
          <?php $gate = new Gate($auth); ?>
          <?php if ($gate->allows($post)) : ?>
            <div class="button-container">
              <a href="/Home/edit/<?php echo $post->id; ?>" class="btn btn-primary btn-sm multiple-submit">Edit</a>
              <form action="/Home/delete/<?php echo $post->id; ?>" method="POST" class="m-0 p-0">
                <button type="submit" class="btn btn-danger btn-sm multiple-submit ">Delete</button>
              </form>
            </div>
          <?php endif; ?>
        </div>

      </div>
    <?php endforeach; ?>
  <?php else : ?>
    <div class="alert alert-info">No posts found</div>
  <?php endif; ?>
</div>

<?php require APPROOT . '/views/init/footer.php';    ?>