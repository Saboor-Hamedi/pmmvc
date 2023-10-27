<?php
namespace App\models;

use App\core\HtmlUtils;
use App\core\Model;
use App\core\Dump;
use App\core\Validation;

/**
 * Summary of PostModel
 */
class PostModel
{
  use Model, Dump;

  /**
   * Summary of table
   * @var string
   */
  protected $title;
  protected $content;
  protected $table = 'posts';
  /**
   * Summary of fillable
   * @var array
   */
  protected $fillable = [
    'id',
    'user_id',
    'title',
    'content',
    'published',
    'created_at'
];


  public function validate($data)
  {
    $validate = new Validation();
    // Validate the title
    $this->title = $validate->onlyString(HtmlUtils::escape($data['title']), [
      ['required', 'title is required']
    ]);
    // Validate the content
    $this->content = $validate->onlyString(HtmlUtils::escape($data['content']), [
      ['required', 'content is required'],
    ]);
    $errors = [];
    // Check if there are errors for the 'username' field
    if (!empty(($this->title))) {
      $errors['title'] = $this->title[0]; // Only the first error
    }
    if (!empty(($this->content))) {
      $errors['content'] = $this->content[0]; // Only the first error
    }
    return $errors;
  }

  
  public function getTableName(){
    return $this->table;
  }
}
