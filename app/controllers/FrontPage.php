<?php 
use App\core\Controller;
use App\core\Dump;
use App\models\FrontModel;
use App\models\LoginModel;
use App\models\PostModel;
use App\services\PostService;

class FrontPage extends Controller{
  protected $front;
  protected $user;
  protected $post;
  use Dump;
  public function __construct()
  {
    $this->user = new LoginModel();
    $this->post = new PostModel();
    $this->front = new FrontModel();
  }
  public function index(){
    // call post with user
    $postWithUser = new PostService($this->post, $this->user);
     
    $posts = $postWithUser->postWithUser();
    // $posts = $this->front->getSelect([
    //   'group' => 'title',
    //   'order' => 'created_at desc'
    // ]);
   
    $this->view('Front',['posts' => $posts]);
  }
}