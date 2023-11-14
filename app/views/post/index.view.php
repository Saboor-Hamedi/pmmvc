<?php

use App\config\PostFormatter;
use App\core\Assets;
use App\services\Str;
use Carbon\Carbon;
use App\core\FlashMessage;
use App\services\Gate;
?>
<?php
require APPROOT . '/views/init/header.php';
require APPROOT . '/views/init/navbar.php';
$auth->loggedIn([0, 1, 2]);
?>
<main class="main-container">
  <div class="blog-container">
    <div class="toolbar__wrapper">

      <form action="/Home/create" method="POST">
        <div class="create-post">
          <div class="form-group">
            <input type="text" name="title" id="title" placeholder="Write something">
            <span class="error">
              <?php
              if (!empty($errors['title'][0])) {
                echo $errors['title'];
              }
              ?>
            </span>
          </div>
          <div class="form-group">
            <textarea name="content" id="editor" cols="4" rows="4" placeholder="Write something..."></textarea>
            <span class="error">
              <?php
              if (!empty($errors['content'][0])) {
                echo $errors['content'];
              }
              ?>
            </span>
          </div>
        </div>
        <div class="button-container">
          <button type="submit" class="multiple-submit btn-sm"><i class="fa-solid fa-plus"></i></button>
        </div>
      </form>
    </div>
    <div class="message-inform">
      <?php
      $flash = new FlashMessage();
      $flash->displayMessages()
      ?>
    </div>
    <?php if (is_array($posts) || is_object($posts)) : ?>
      <?php foreach ($posts as $post) : ?>
        <?php if ($post->published === 1) : ?>
          <div class="blog-post">
            <div class="outter-profile">
              <div class="inner-profil">
                <div class="profile">
                  <img src="<?php Assets::assets('assets/profile/profile.png') ?>" alt="">
                </div>
              </div>
              <div class="profile-name">
                <div class="name-profile">
                  <strong>
                    <a href="#"><?php echo ucfirst($post->user->username) ?? 'anonymous'; ?>
                    </a>
                  </strong>
                </div>
                <div class="date-profile">
                  <small>
                    <?php $carbon = new Carbon(); ?>
                    <a href="#">
                      <span class="post-time">
                        <?php echo $carbon->format('l jS, Y', $post->created_at); ?>
                        <span class="published-icon">
                          <?php if ($post->published === 1) : ?>
                            <i class="fa-solid fa-globe"></i>
                          <?php else : ?>
                            <i class="fa-solid fa-user-lock"></i>
                          <?php endif; ?>
                        </span>
                      </span>
                    </a>
                  </small>
                </div>
              </div>
            </div>
            <div class="blog-card">
              <h5 class="blog-post-title">
                <?php echo ucfirst($post->title); ?>
              </h5>
              <p>
                <?php echo PostFormatter::interpretHashtags(Str::limit($post->content, 100, '...')) ?>
                <?php //echo Str::limit(PostFormatter::interpretHashtags($post->content), 100, '...') 
                ?>
                <a href="/Home/show/<?php echo $post->id; ?>">Read More</a>
              </p>
            </div>

            <?php $gate = new Gate($auth); ?>
            <?php if ($gate->allows($post)) : ?>
              <div class="button-container">
                <a href="/Home/edit/<?php echo $post->id; ?>" class="btn btn-primary btn-sm multiple-submit"><i class="fa-solid fa-pen-to-square"></i></a>
                <form action="/Home/delete/<?php echo $post->id; ?>" method="POST" class="m-0 p-0">
                  <button type="submit" class="btn btn-danger btn-sm multiple-submit "><i class="fa-solid fa-folder-minus"></i></i></button>
                </form>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>

    <?php else : ?>
      <div class="message-inform">
        <div class="alert alert-info">No posts found</div>
      </div>
    <?php endif; ?>
  </div>

</main>
<?php require APPROOT . '/views/init/footer.php';    ?>