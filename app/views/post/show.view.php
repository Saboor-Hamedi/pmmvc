<?php

use App\core\Assets;
use App\core\FlashMessage;
use Carbon\Carbon;

$flash = new FlashMessage;
require APPROOT . '/views/init/header.php';
require APPROOT . '/views/init/navbar.php';
$auth->loggedIn([0, 1, 2]);
?>
<div class="blog-container">
    <?php if (is_object($post) and $post !== null) : ?>
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
                <?php
                $carbon = new Carbon();
                echo $carbon->format('l jS, Y', $post->created_at);
                ?>
              </small>
            </div>
          </div>
        </div>
            <div class="blog-card">
                <h2 class="blog-post-title">
                    <?php echo ucfirst($post->title); ?>
                </h2>
                <p>
                    <?php echo ucfirst($post->content) ?>
                </p>

            </div>
        </div>
    <?php else : ?>
        <div class="alert alert-info">No posts found</div>
    <?php endif; ?>
</div>
<?php require APPROOT . '/views/init/footer.php'; ?>