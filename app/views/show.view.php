<?php

use App\core\FlashMessage;
use Carbon\Carbon;

$flash = new FlashMessage;
require APPROOT . '/views/init/header.php';
require APPROOT . '/views/init/navbar.php';
$auth->loggedIn([0, 1, 2]);
?>
<main class="container">
    <div class="card-body">
        <?php if (is_object($post) and $post !== null) : ?>
            <article class="blog-post">
                <h2 class="blog-post-title" style="text-align: left;">
                    <?php echo ucfirst($post->title); ?>
                </h2>

                <small>
                    <?php
                    $carbon = new Carbon();
                    echo $carbon->format('l jS, Y', $post->created_at);
                    ?>
                </small>
                <strong>
                    <a href="#"><?php echo ucfirst('Hello') ?? 'anonymous'; ?>
                    </a>
                </strong>
                <p>
                    <?php echo ucfirst($post->content) ?>
                </p>

            </article>
        <?php else : ?>
            <div class="alert alert-info">No posts found</div>
        <?php endif; ?>
    </div>
</main>
<?php require APPROOT . '/views/init/footer.php'; ?>