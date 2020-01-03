<?php

namespace App;

/**
 * Theme customizer
 */
add_action('customize_register', function (\WP_Customize_Manager $wp_customize) {
    // Add postMessage support
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->selective_refresh->add_partial('blogname', [
        'selector' => '.brand',
        'render_callback' => function () {
            bloginfo('name');
        }
    ]);
});

/**
 * Customizer JS
 */
add_action('customize_preview_init', function () {
    wp_enqueue_script('sage/customizer.js', asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
});


add_action( 'admin_enqueue_scripts', function() {
    wp_enqueue_style( 'libarts-admin-scripts', asset_path('admin.css'), array('font-awesome-pro') );
    wp_enqueue_style( 'font-awesome-pro', "https://pro.fontawesome.com/releases/v5.10.2/css/all.css" );

} );



add_action( 'acf/init', function() {
    if( function_exists('acf_add_options_page') ) {
        acf_add_options_page();
    }

    if( function_exists('acf_add_local_field_group') ):

        acf_add_local_field_group(array(
            'key' => 'group_5dfbcde4bd3f5',
            'title' => 'Site Options',
            'fields' => array(
                array(
                    'key' => 'field_5dfbcdf006d41',
                    'label' => 'Header Social Media Icons',
                    'name' => 'header_social_media_icons',
                    'type' => 'repeater',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'collapsed' => '',
                    'min' => 0,
                    'max' => 6,
                    'layout' => 'table',
                    'button_label' => '',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_5dfbce1f06d42',
                            'label' => 'Link',
                            'name' => 'link',
                            'type' => 'url',
                            'instructions' => 'Provide a link to the social media page/profile.',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'placeholder' => '',
                        ),
                        array(
                            'key' => 'field_5dfbce4a06d43',
                            'label' => 'Type',
                            'name' => 'type',
                            'type' => 'select',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'choices' => array(
                                'fab fa-twitter' => 'Twitter',
                                'fab fa-facebook-f' => 'Facebook',
                                'fab fa-instagram' => 'Instagram',
                                'fab fa-youtube-square' => 'YouTube',
                                'fab fa-vimeo' => 'Vimeo',
                                'fab fa-flickr' => 'Flickr'
                            ),
                            'default_value' => array(
                            ),
                            'allow_null' => 0,
                            'multiple' => 0,
                            'ui' => 0,
                            'return_format' => 'value',
                            'ajax' => 0,
                            'placeholder' => '',
                        ),
                    ),
                ),
                array(
                    'key' => 'field_5dfbdd6b0196a',
                    'label' => 'Contact Us Menu Panel',
                    'name' => 'contact_us_menu_panel',
                    'type' => 'post_object',
                    'instructions' => 'Select the Menu Panel to show when Contact Us is clicked in the footer.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'post_type' => array(
                        0 => 'menu_panel',
                    ),
                    'taxonomy' => '',
                    'allow_null' => 0,
                    'multiple' => 0,
                    'return_format' => 'object',
                    'ui' => 1,
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'options_page',
                        'operator' => '==',
                        'value' => 'acf-options',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
            'active' => true,
            'description' => '',
        ));
        
    endif;

    if( function_exists( 'acf_add_options_page' ) ):
        
    endif;
});
