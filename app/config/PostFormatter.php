<?php

namespace App\config;

class PostFormatter
{
  public static function interpretHashtags($text) {
    // Use a regular expression to find hashtags and wrap them in a span with a class
    $text = preg_replace('/#(\w+)/', '<a href="#">#$1</a>', $text);
    return $text;
}

}
