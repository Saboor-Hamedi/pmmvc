<?php

namespace App\seed;

use App\core\Dump;
use App\core\Model;
use App\models\PostModel;
use App\services\Auth;
use Faker\Factory;

class PostSeed
{
  use Dump, Model;

  public function run()
  {
    $posts = new PostModel();
    $auth = new Auth();
    $faker = Factory::create('en_US');
    $data = [
      "user_id" => $auth->user()->id,
      "title" => $faker->sentence,
      "content" => $faker->paragraph,
      "published" => 1,
    ];
    $count = 2; // Specify the number of times you want to insert the data

    for ($i = 0; $i < $count; $i++) {
      $data["title"] = $faker->sentence;
      $data["content"] = $faker->paragraph;
      $posts->insert_data($data);
    }
  }
}
