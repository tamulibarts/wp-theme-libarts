<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class SingleDirectory_profile extends Controller
{
  protected $profile;

  public function profile() {
    global $post;
    $profile = new \LA\Directory\ProfileCPT( $post );
    $this->profile = $profile;
    return $this->profile;
  }

  

  private function area_label( $area ) {
    if( isset($area['url']) && !empty($area['url']) ) {
      return '<a href="' . $area['url'] . '" data-uid="' . $area['uid'] . '">' . $area['name'] . '</a>';
    } else {
      return $area['name'];
    }
  }

  public function breadcrumbs()
  {
    $breadcrumbs = array();

    $breadcrumbs[] = (object) array(
        'title' => 'Directory',
        'link' => null
    );

    $breadcrumbs[] = (object) array(
      'title' => \get_the_title(),
      'link' => null
    );

    return $breadcrumbs;
  }
}
