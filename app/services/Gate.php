<?php 
namespace App\services;
// this class checks if the posts belongs to the current user or not
class Gate{
  protected $auth;
  public function __construct($auth){
    $this->auth = $auth;

  }
  public function allows($post){
    if(!$this->auth->isAuthenticated()){
        return false;
        // $this->auth->isAuthenticated() && $this->auth->user()->id === $post->user_id;
      }
      return $this->auth->user()->id === $post->user_id;
    // return $post === null ? false : $post->user_id === $this->auth->user()->id;
}

}