<?php 
namespace App\models;
use App\core\Model;

class FrontModel  {
use Model;

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


}