<?php

use App\core\Controller;
use App\core\Direction;
use App\core\FlashMessage;
use App\core\HtmlUtils;
use App\core\VarDump;
use App\models\HomeModel;
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
  use VarDump;
  use Direction;
  protected $post;
  protected $auth;
  protected $sqids;
  protected $flash;
  protected $data = [];
  protected $errors = [];
  protected $gate;
  public function __construct()
  {
    $this->post = new HomeModel();
    $this->auth = new Auth();
    $this->gate = new Gate($this->auth);
    $this->flash = new FlashMessage();
    $this->auth->loggedIn();
    // fetch data based on user logged in 
  }
  public function index()
  {
    if ($this->auth->isAuthenticated()) {
      $posts = $this->post->where(['user_id' => $this->auth->user()->id]);
      $this->view('home', ['posts' => $posts]);
    } else {
      return;
    }
  }


  public function show($id = null)
  {
    if ($this->auth->isAuthenticated()) {
      $showPost = $this->post->first(['id' => $id]);
      if (!$this->gate->allows($showPost)) {
        $this->flash->setMessage('You are not authorized to edit this post.');
        $this->redirect('/Home'); // Redirect to an appropriate page

      }
      $this->view('show', ['showPost' => $showPost]);
    } else {
      return;
    }
  }

  public function edit($id = null)
  {
    // Find the post by its original ID
    if ($this->auth->isAuthenticated()) {
      $post = $this->post->first(['id' => $id]);
      if (!$this->gate->allows($post)) {
        $this->flash->setMessage('You are not authorized to edit this post.');
        $this->redirect('/Home');
      }
      $this->view('update_post', ['post' => $post]);
    } else {
      return;
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
          // check if post belongs to the current user
          // $post->user_id !== $this->auth->user()->id
          if (!$this->gate->allows($post)) {
            $this->flash->setMessage('You cannot update this post.');
            $this->redirect('/Home');
          } else {
            $this->post->update_data($id, $_POST);
            $this->flash->setMessage('Post updated successfully');
            $this->redirect('/Home');
          }
        }
      }
    }
    $this->view('update_post', ['post' => $post, 'errors' => $this->errors]);
  }
  public function delete($id = null)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Check if the user is authenticated and authorized to delete the post
      if ($this->auth->isAuthenticated()) {
        $post = $this->post->first(['id' => $id]);
        if ($post) {
          // Check if the post belongs to the current user
          if (!$this->gate->allows($post)) {
            $this->flash->setMessage('You cannot delete this post.');
            $this->redirect('/Home');
          } else {
            $this->post->delete_data($id);
            $this->flash->setMessage('Post deleted successfully.');
            $this->redirect('/Home');
          }
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
