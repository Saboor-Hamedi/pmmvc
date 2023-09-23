<?php 
use App\core\Controller;
use App\models\PostModel;
class PostController extends Controller{
    
    public function index(){
        $user_model = new PostModel;
        $user_model->sortField = 'student_id';
        $user_model->sortOrder= 'ASC';
        $results  = $user_model->selectAll();
        if($results){
            foreach($results as $row){
                echo $row->lastname;
            }
        }
     
        $this->view('post');
    }
}