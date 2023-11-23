<?php require APPROOT . '/views/init/header.php';

use App\config\TimeFormatter;
use App\core\Assets;
use App\services\Str;

?>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
  <h5 class="my-0 mr-md-auto font-weight-normal">Company name</h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="#">Features</a>
    <a class="p-2 text-dark" href="#">Enterprise</a>
    <a class="p-2 text-dark" href="#">Support</a>
    <a class="p-2 text-dark" href="#">Pricing</a>
  </nav>
  <a class="btn btn-outline-primary" href="/Login">Sign up</a>
</div>

<main role="main">

  <section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">Album example</h1>
      <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
      <p>
        <a href="#" class="btn btn-primary my-2">Main call to action</a>
        <a href="#" class="btn btn-secondary my-2">Secondary action</a>
      </p>
    </div>
  </section>

  <div class="album bg-light">
    <div class="front-row">
      <?php if (is_array($posts) || is_object($posts)) : ?>
        <?php foreach ($posts as $post) : ?>
          <div class="front-card-body">
            
            <div class="front-card-image">
              <img class="card-img-top" src="<?php Assets::assets('assets/profile/profile.png') ?>" alt="Card image cap">
            </div>
            <div class="front-card">
              <div class="front-inner-content">
                <div class="author-fron-card"><?php echo $post->user->username; ?></div>
                <?php $format = new TimeFormatter('M j Y');?>
                <div class="font-created_at"><?php echo $format->format($post->created_at);?></div>
                <h5 class="front-card-title"><?php echo $post->title; ?></h5>
                <p class="card-text"><?php echo Str::limit($post->content, 50, '...') ?></p>
              </div>
            </div>
            <div class="front-view-button">
              <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
            </div>
          </div>

        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</main>



<?php require APPROOT . '/views/init/footer.php'; ?>