<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler multiple-submit" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <?php

      use App\core\Assets;

      if ($auth->isAuthenticated()) : ?>
        <li class="nav-item active">
          <a class="nav-link" href="/Home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/Sigup">Sign up</a>
        </li>
    </ul>
    
    <ul class="navbar-nav ">
    <li class="nav-item dropdown ">
        <img class="navbar-nav image-profile-dropdown" src="<?php Assets::assets('assets/profile/profile.png'); ?>" class="dropdown-toggle" data-toggle="dropdown" data-dismiss="dropdown">
        <ul class="dropdown-menu dropdown-menu-right p-3 mt-2 ">
          <li><a href="#">Dropdown item 2</a></li>
          <li><a href="#">Dropdown item 3</a></li>
          <li>
            <form action="/Logout" method="post" class="m-0 p-0">
              <button type="submit" name="logout" class="logout-btn">
                <i type="submit" class="fa-solid fa-arrow-right-from-bracket">
                </i>
              </button>
            </form>
          </li>

        </ul>
      </li>
    </ul>
  <?php endif; ?>
  <?php if (!$auth->isAuthenticated()) : ?>
    <li class="nav-item">
      <a class="nav-link" href="/FrontPage">Home</a>
    </li>
  <?php endif; ?>
  </div>
</nav>