@php

$collection = get_posts( array(
  'post_type' => "directory_group",
  'post_status' => "publish",
  'orderby' => 'menu_order',
  'order' => 'asc'
) );

wp_redirect( get_permalink( $collection[0] ) );
exit();

@endphp
