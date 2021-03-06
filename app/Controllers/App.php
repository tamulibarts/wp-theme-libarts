<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class App extends Controller
{
    public function siteName()
    {
        return get_bloginfo('name');
    }

    public static function title()
    {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }
            return __('Latest Posts', 'sage');
        }
        if (is_archive()) {
            return get_the_archive_title();
        }
        if (is_search()) {
            return sprintf(__('Search Results for %s', 'sage'), get_search_query());
        }
        if (is_404()) {
            return __('Not Found', 'sage');
        }
        return get_the_title();
    }

    public static function megaMenuWalker() {
        return new \LA\Menus\MegaMenuWalker();
    }

    public function homeurl() {
        return get_home_url();
    }

    public function contact_us_panel_content() {
        $the_post = get_field('contact_us_menu_panel', 'option');
        if($the_post) {
            $post = $the_post;
            setup_postdata( $post );
            return get_the_content();
        }
        return "";
    }

    use Partials\Breadcrumbs;
}
