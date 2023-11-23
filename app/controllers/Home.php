<?php

use App\core\Controller;
use App\core\Direction;
use App\core\FlashMessage;
use App\core\Dump;
use App\core\HtmlUtils;
use App\models\PostModel;
use App\models\LoginModel;
use App\seed\PostSeed;
use App\services\Auth;
use App\services\Gate;
use App\services\PostService;

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

    $posts = $this->post->getSelect([
      'group' => 'title',
      'order' => 'created_at desc'
    ]);

    if (is_array($posts) || is_object($posts)) {
      foreach ($posts as $post) {
        // Load the user associated with the current post
        $user = $this->user->first(['id' => $post->user_id]);
        // Create an object for each post and add user data as a property
        $post->user = $user;
      }
    }
    $this->view('post/index', ['posts' => $posts]);
  }


  public function show($id = null)
  {
    if ($this->auth->isAuthenticated()) {
      $postService = new PostService($this->post, $this->user);
      $post = $postService->singlePostUser($id);
      $this->view('post/show', ['post' => $post]);
    }
  }

  public function edit($id = null)
  {
    if ($this->auth->isAuthenticated()) {
      $post = $this->post->first(['id' => $id]);
      $this->view('post/edit', ['post' => $post]);
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
          $this->flash->setMessage('Post updated successfully', 'primary');
          $this->redirect('/Home');
          $this->view('post/edit', ['post' => $post, 'errors' => $this->errors]);
        }
      }
    }
  }
  public function create()
  {
    $posts = null;
    // insert
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $validation = $this->post->validate($_POST);
      if ($validation) {
        $this->data['errors'] = $validation;
        $this->errors = $this->data['errors'];
        $posts = $this->post->getSelect([
          'group' => 'title',
          'order' => 'created_at desc'
        ]);
        if (is_array($posts) || is_object($posts)) {
          foreach ($posts as $post) {
            // Load the user associated with the current post
            $user = $this->user->first(['id' => $post->user_id]);
            // Create an object for each post and add user data as a property
            $post->user = $user;
          }
        }
      } else {

        // 
        $title = HtmlUtils::escape($_POST['title']);
        $content = HtmlUtils::escape($_POST['content']);
        // Prepare user data
        $userData = [
          'user_id' => $this->auth->user()->id,
          'title' => $title,
          'content' => $content,
        ];
        $this->post->insert_data($userData);
        $this->flash->setMessage('Posted successfully', 'primary');
        $this->redirect('/Home');
      }
    }
    $this->view('post/index', ['posts' => $posts, 'errors' => $this->errors]);
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
          $this->flash->setMessage('Post not found.',  'danger');
          $this->redirect('/Home');
        }
      } else {
        // User is not authenticated, redirect to the login page or another appropriate page
        $this->redirect('/Login');
      }
    }
  }
}
