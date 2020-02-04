<?php

namespace App\Controllers\Partials;

trait Breadcrumbs
{
    public function breadcrumbs()
    {
      $post = get_post();
      $parent_ids = get_post_ancestors( $post );
      $breadcrumbs = array();

      if( !empty( $parent_ids ) ):
        foreach( get_posts( array( 'post_type' => 'page', 'post__in' => $parent_ids ) ) as $p) {
          $breadcrumbs[] = (object) array(
            'post_id' => $p->ID,
            'title' => $p->post_title,
            'link' => get_page_link( $p )
          );
          error_log( $p->post_title );
        }
      endif;

      $breadcrumbs = array_reverse($breadcrumbs);

      $breadcrumbs[] = (object) array(
        'title' => get_the_title(),
        'link' => get_post_permalink(),
        'current' => true
      );

      return $breadcrumbs;
    }
}