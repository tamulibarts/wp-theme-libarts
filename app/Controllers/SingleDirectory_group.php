<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class SingleDirectory_group extends Controller
{
  public function profile_groups()
  {
    $profile_groups = array();

    if( class_exists( '\LA\Directory\GroupCPT' ) ):
      $grouping = new \LA\Directory\GroupCPT( $post );
      $profile_groups = [ [ 'profiles' => $grouping->profiles(), 'grouping' => $grouping ] ];
      
      while( have_rows( 'grouping_embedded_groupings' ) ): the_row();
        $id = get_sub_field('grouping_embedded_groupings_grouping_id');
        if($id) {
          $g = new \LA\Directory\GroupCPT( $id );
          if( $g ) {
            if( get_field( 'grouping_embedded_groupings_arragements' ) == 'combine' ) {
              $profile_groups = [[ 'profiles' => array_merge( $profile_groups[0]['profiles'], $g->profiles() ), 'grouping' => $grouping ]];
            } else {
              $title = get_sub_field('hide_title') ? null : get_sub_field('display_name');
              $profile_groups[] = [
                'title' => $title,
                'profiles' => $g->profiles(),
                'grouping' => $g
              ];
            }
          }
        }
      endwhile;
    endif;
    // $areas = get_field('profile_areas', 'options');
    return $profile_groups;
    
    
  }
}
