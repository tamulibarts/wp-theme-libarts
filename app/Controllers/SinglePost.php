<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class SinglePost extends Controller
{
  public function tags()
  {
    return get_the_tags();
  }

  public function categories()
  {
    return get_the_category();
  }
}
