<?php

use App\services\Str;
use Carbon\Carbon;
use App\core\FlashMessage;

require APPROOT . '/views/init/header.php';
require APPROOT . '/views/init/navbar.php';
$auth->loggedIn([0, 1, 2]);
?>

<main class="container">
  <div class="card-body">

 
  <!-- cards -->
  <?php
  $flash = new FlashMessage();
  $flash->displayMessages()
  ?>
  <?php if (is_array($posts) || is_object($posts)) : ?>
    <?php foreach ($posts as $post) : ?>
      <div class="blog-post">
        <h2 class="blog-post-title">
          <?php echo ucfirst($post->title); ?>
        </h2>
        <small>
          <?php
          $carbon = new Carbon();
          echo $carbon->format('l jS, Y', $post->created_at);
          ?>
        </small>
        <strong><a href="#"><?php echo ucfirst($username) ?? 'anonymous '; ?></a></strong>
        <p>
          <?php echo Str::limit(ucfirst($post->content), 100, '...') ?>
          <a href="/Home/show/<?php echo $post->id; ?>">Read More</a>
        </p>
      </div>
    <?php endforeach; ?>
  <?php else : ?>
    <div class="alert alert-info">No posts found</div>
  <?php endif; ?>
  <!-- cards end -->
  </div>
</main>

<?php require APPROOT . '/views/init/footer.php';    ?>