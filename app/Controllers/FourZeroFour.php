<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class FourZeroFour extends Controller
{
  protected $template = '404';
  public function breadcrumbs()
    {
      $breadcrumbs = array();

      $breadcrumbs[] = (object) array(
          'title' => 'Page Not Found (404)',
          'link' => null
      );

      return $breadcrumbs;
    }
}
