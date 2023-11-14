<?php 
use App\core\Controller;
use App\models\FrontModel;

class FrontPage extends Controller{
  protected $front;
  public function __construct()
  {
    $this->front = new FrontModel();
  }
  public function index(){
    $posts = $this->front->getSelect([
      'group' => 'title',
      'order' => 'created_at desc'
    ]);
   
    $this->view('Front',['posts' => $posts]);
  }
}