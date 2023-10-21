<?php

namespace App\models;

use App\core\HtmlUtils;
use App\core\Model;
use App\core\VarDump;
use App\core\Validation;

/**
 * Summary of HomeModel
 */
class HomeModel
{
  use Model, VarDump;

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
  /**
   * @return mixed
   */
  public function getFillable()
  {
    return $this->fillable;
  }

  /**
   * @param mixed $fillable 
   * @return self
   */
  public function setFillable($fillable): self
  {
    $this->fillable = $fillable;
    return $this;
  }
}
