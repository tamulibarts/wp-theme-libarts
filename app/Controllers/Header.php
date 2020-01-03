<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class Header extends Controller
{
    public static function megaMenuWalker() {
        // return new \LA\Menus\MegaMenuWalker();
        $output = '<ul>';
        $menu_name = wp_get_nav_menu_name( 'primary_navigation' );
        $menu = wp_get_nav_menu_object( $menu_name );
        $menu_items = wp_get_nav_menu_items($menu->term_id);

        $megamenus = array();

        foreach( $menu_items as $menu_item ) {

            switch($menu_item->object) {
                case "custom":
                    $output .= '<li class="top-menu-item">';
                    $output .= '  <a class="menu-item-title" href="' . $menu_item->url . '">';
                    $output .= '    <span>' . $menu_item->title . '</span>';
                    $output .= '  </a>';
                    $output .= '</li>';
                break;

                case "menu_panel":
                    $q = new \WP_Query([
                        'post_status' => 'publish',
                        'p' => $menu_item->object_id,
                        'post_type' => 'menu_panel'
                    ]);
                    if( $q->have_posts() ) {
                        while( $q->have_posts() ) {
                            $q->the_post();
        
                            ob_start();
                              the_title();
                            $title = \ob_get_clean();
        
                            ob_start();
                              the_content();
                            $content = \ob_get_clean();
                        }
                        wp_reset_postdata();
        
                        $menu_item_id = "menu-item-".$menu_item->object_id;
                        $panel_id = "menu-panel-".$menu_item->object_id;
                    
                        $output .= '<li class="top-menu-item has-megamenu" id="' . $menu_item_id . '">';
                        $output .= '  <a data-menu-group="main-menu-megamenus" aria-haspopup="true" aria-label="Button to reveal and navigate to the ' . $title . ' menu" role="button"  tabindex="0" class="menu-item-title" aria-expanded="false" aria-controls="' . $panel_id . '" data-menu-target="' . $panel_id . '">';
                        $output .= '    <span>' . $title . '</span>';
                        $output .= '  </a>';
                        // $output .= '  <div data-parent-menu-item="#' . $menu_item_id . '" tabindex="0" class="menu-panel" id="' . $panel_id . '" aria-label="The ' . $title . ' menu">';
                        // $output .= '    <div class="menu-panel-content">';
                        // $output .= '      ' . $content;
                        // $output .= '    </div>';
                        // $output .= '  </div>';
                        $output .= '</li>';
        
                        $megamenus[$panel_id] = $content;
                    }
                break;

                default:
            }
        }

        $output .= '</ul>';

        $output .= '<div id="main-menu-megamenus" class="megamenu-container">';
        foreach( $megamenus as $panel_id=>$content ) {
            $output .= '  <div class="menu-panel" id="' . $panel_id . '" aria-label="The ' . $title . ' menu" tabindex="0">';
            $output .= '    <div class="menu-panel-content">';
            $output .= '      ' . $content;
            $output .= '    </div>';
            $output .= '  </div>';
        }
        $output .= '</div>';

        return $output;
    }
}
