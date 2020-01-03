<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class Search extends Controller
{
  public function breadcrumbs()
    {
      $breadcrumbs = array();

      $breadcrumbs[] = (object) array(
          'title' => 'Search',
          'link' => null
      );

      $breadcrumbs[] = (object) array(
        'title' => get_search_query(),
        'link' => null
    );

      return $breadcrumbs;
    }
}
