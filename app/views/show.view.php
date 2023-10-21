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
    <?php if (is_object($showPost) and $showPost !== null) : ?>
        <article class="blog-post">
            <h2 class="blog-post-title" style="text-align: left;">
                <?php echo ucfirst($showPost->title); ?>
            </h2>

            <small>
                <?php
                $carbon = new Carbon();
                echo $carbon->format('l jS, Y', $showPost->created_at);
                ?>
            </small>
            <strong><a href="#"><?php echo ucfirst($username) ?? 'anonymous '; ?></a></strong>
            <p>
                <?php echo ucfirst($showPost->content) ?>
            </p>
            <div class="button-container">
                <a href="/Home/edit/<?php echo $showPost->id; ?>" class="btn btn-primary multiple-submit">Edit</a>
                <form action="/Home/delete/<?php echo $showPost->id; ?>" method="POST">
                    <button type="submit" class="btn btn-danger multiple-submit">Delete</button>
                </form>
            </div>


        </article>
    <?php else : ?>
        <div class="alert alert-info">No posts found</div>
    <?php endif; ?>
    </div>
</main>
<?php require APPROOT . '/views/init/footer.php';?>