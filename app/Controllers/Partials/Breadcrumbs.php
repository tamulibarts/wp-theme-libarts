<?php

namespace App\Controllers\Partials;

trait Breadcrumbs
{
    public function breadcrumbs()
    {
      $post = get_post();
      $parent_ids = get_post_ancestors( $post );
      $breadcrumbs = array();
      $parents = array();

      if( !empty( $parent_ids ) ):
      foreach( get_posts( array( 'post_type' => 'page', 'post__in' => $parent_ids, 'orderby' => 'post__in' ) ) as $p) {
        $parents[] = $p;
        $breadcrumbs[] = (object) array(
          'title' => $p->post_title,
          'link' => get_page_link( $p )
        );
      }
      endif;

      $breadcrumbs[] = (object) array(
        'title' => get_the_title(),
        'link' => get_post_permalink(),
        'current' => true
      );

      return $breadcrumbs;
    }
}