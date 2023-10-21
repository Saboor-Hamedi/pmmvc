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
    }
    return $post->user_id === $this->auth->user()->id;
  }
}