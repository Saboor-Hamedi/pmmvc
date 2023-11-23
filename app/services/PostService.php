<?php

namespace App\services;

class PostService
{
  protected $postModel;
  protected $userModel;
  public function __construct($postModel,  $userModel)
  {
    $this->postModel = $postModel;
    $this->userModel = $userModel;
  }
  public function postWithUser()
  {
    $posts = $this->postModel->getSelect();
    foreach ($posts as $post) {
      $user = $this->userModel->first(['id' => $post->user_id]);
      $post->user = $user;
    }
    return $posts;
  }
  public function singlePostUser($id)
  {
    $post = $this->postModel->first(['id' => $id]);

    if ($post) {
      $user = $this->userModel->first(['id' => $post->user_id]);
      $post->user = $user;
    }

    return $post;
  }
}
