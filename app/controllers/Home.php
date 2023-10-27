<?php

use App\core\Controller;
use App\core\Direction;
use App\core\FlashMessage;
use App\core\Dump;
use App\models\PostModel;
use App\models\LoginModel;
use App\seed\PostSeed;
use App\services\Auth;
use App\services\Gate;

/**
 * Summary of Home
 */
class Home extends Controller
{
  /**
   * Summary of index
   * @return void
   */
  use Dump, Direction;
  protected $post;
  protected $auth;
  protected $sqids;
  protected $flash;
  protected $data = [];
  protected $errors = [];
  protected $gate;
  protected $user;
  public function __construct()
  {
    $seed = new PostSeed();
    // $seed->run();
    $this->user = new LoginModel();
    $this->post = new PostModel();
    $this->auth = new Auth();
    $this->gate = new Gate($this->auth);
    $this->flash = new FlashMessage();
    $this->auth->loggedIn();
    // fetch data based on user logged in 
  }
  public function index()
  {
    $posts = $this->post->getSelect();

    foreach ($posts as $post) {
      // Load the user associated with the current post
      $user = $this->user->first(['id' => $post->user_id]);
      // Create an object for each post and add user data as a property
      $post->user = $user;
    }

    $this->view('home', ['posts' => $posts]);
  }


  public function show($id = null)
  {
    if ($this->auth->isAuthenticated()) {
      $post = $this->post->first(['id' => $id]);
      $this->view('show', ['post' => $post]);
    }
  }

  public function edit($id = null)
  {
    // Find the post by its original ID
    if ($this->auth->isAuthenticated()) {
      $post = $this->post->first(['id' => $id]);
      $this->view('update_post', ['post' => $post]);
    }
  }

  public function update($id)
  {
    $post = $this->post->first(['id' => $id]);
    if (!($post)) {
      $this->redirect('error');
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $validation = $this->post->validate($_POST);
      if ($validation) {
        $this->data['errors'] = $validation;
        $this->errors = $this->data['errors'];
      } else {
        // check if user is logged in 
        if ($this->auth->isAuthenticated()) {
          $this->post->update_data($id, $_POST);
          $this->flash->setMessage('Post updated successfully');
          $this->redirect('/Home');
          $this->view('update_post', ['post' => $post, 'errors' => $this->errors]);
        }
      }
    }
  }
  public function delete($id = null)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Check if the user is authenticated and authorized to delete the post
      if ($this->auth->isAuthenticated()) {
        $post = $this->post->first(['id' => $id]);
        if ($post) {
          // Check if the post belongs to the current user

          $this->post->delete_data($id);
          $this->flash->setMessage('Post deleted successfully.');
          $this->redirect('/Home');
        } else {
          // The post with the given ID does not exist
          $this->flash->setMessage('Post not found.');
          $this->redirect('/Home');
        }
      } else {
        // User is not authenticated, redirect to the login page or another appropriate page
        $this->redirect('/Login');
      }
    }
  }
}
