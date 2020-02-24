<?php

namespace App\Controllers\Partials;

trait SidebarMenu
{
    public function has_sidebar() {
      return get_field( 'menu_style' ) == 'none' ? false:true;
    }

    public function sidebar_content($post = null, $context = null)
    {

      if(!$post) $post = get_post();
      if(!$context) $context = $post;

      $content = '';

      $style = get_field( 'menu_style', $post );

      if($style == 'inherit' )
        list($style, $context)  = $this->inherited_menu_style($post);

      switch( $style ) {
        case "custom":
          $content = wp_nav_menu( array(
            'menu' => get_field('menu_selection', $context),
            'echo' => false
          ) );
          break;
        case "auto":
          $tree = $this->build_page_tree($post);
          $content = $this->generate_menu_markup($tree, $post);
          break;
        default: // case: "inherit"
          if($post->post_parent > 0) {
            $parent = get_post($post->post_parent);
            $content = $this->sidebar_content( $parent, $post );
          }
      }
      return $content;
    }

    private function inherited_menu_style($post = null) {
      if(!$post) $post = get_post();
      $style = get_field( 'menu_style', $post );

      // Solid value, let's use it
      if($style != 'inherit')
        return array( $style, $post) ;

      // We're reached the top of the tree
      if($post->post_parent == 0) 
        return array( 'auto', $post );

      // Delegate up
      return $this->inherited_menu_style($post->post_parent);
    }

    private function build_page_tree($post = null) {
      if(!$post) $post = get_post();
      
      $children = get_posts( array(
        'post_parent' => $post->ID,
        'post_type' => 'page',
        'meta_query' => array(
          'relation' => 'OR',
            [
              'key' => '_la_unlisted',
              'compare' => 'NOT EXISTS'
            ],
            [
              'key' => '_la_unlisted',
              'compare' => '!=',
              'value' => 1
            ]
        ),
        'orderby' => 'menu_order',
        'posts_per_page' => -1
      ));
      $children = array_reverse($children);
      // error_log("Children: " . print_r($children, true));
      
      $parent_id = wp_get_post_parent_id($post);

      $siblings = get_pages( array(
        'parent' => $parent_id
      ) );
      

      $tree = array();
      // if($parent_id == 0) {
      //   // Special case for the top of the menu
      //   $siblings = 
      // }
      if(empty($children) && empty($siblings)) {
        $tree = $this->build_page_tree(get_post($parent_id));
      } else {
        // inject siblings
        foreach($siblings as $page) {
          $tree[] = array(
            'post' => $page,
            'children' => ( $page->ID == $post->ID ) ? $children : array()
          );
        }
      }
      return $tree;
    }

    private function generate_menu_markup($tree, $post = null) {
      if(!$post) $post = get_post();
      // error_log(var_dump($post));
      $content  = '<ul class="menu" id="page-nav-menu">';

      foreach($tree as $level) {
        // error_log( print_r($level['post'], true));
        $classes = array('menu-item');
        if($level['post']->ID == $post->ID) $classes[] = 'current-menu-item';
        if(!empty( $level['children'] )) array_push($classes,'menu-item-has-children', 'menu-sub-menu-parent-page');
        $content .= '<li class="' . join($classes, ' ') . '">';
        $content .= '  <a href="' . get_permalink($level['post']) .'">' . $level['post']->post_title . '</a>';
        if(!empty( $level['children'] )) {
          $content .= '<ul class="sub-menu">';
          foreach($level['children'] as $child) {
            // error_log(var_dump($child));
            $classes = array('menu-item');
            if($child->ID == $post->ID) $classes[] = 'current-menu-item';
            $content .= '<li class="' . join($classes, ' ') . '">';
            $content .= '  <a href="' . get_permalink($child) . '">' . $child->post_title . '</a>';
            $content .= '</li>';
          }
          $content .= '</ul>';
        }
        $content .= '</li>';
      }

      $content .= '</ul>';
      
      return $content;
    }
}