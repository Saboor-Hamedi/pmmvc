<?php 
namespace App\services;
class Str{
  public static function limit($string, $limit, $suffex= '...'){
    if(mb_strlen($string) <= $limit){
      return $string;
    }
    return rtrim(mb_substr($string, 0, $limit, 'UTF-8')).$suffex;
  }
  
}