<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler multiple-submit" type="button"  data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <?php if ($auth->isAuthenticated()) : ?>
        <li class="nav-item active">
          <a class="nav-link" href="/Home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/Sigup">Sign up</a>
        </li>
    </ul>
    <div class="nav-item">
      <form action="/Logout" method="post" class="m-0 p-0">
        <button type="submit" name="logout" class="logout-btn">Logout</button>
      </form>
    </div>

  <?php endif; ?>
  <?php if (!$auth->isAuthenticated()) : ?>
    <li class="nav-item">
      <a class="nav-link" href="/Login">Login</a>
    </li>
  <?php endif; ?>
  </div>
</nav>