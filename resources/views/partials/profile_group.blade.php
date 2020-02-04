@php
  $blocks = parse_blocks('<!-- wp:acf/group { "name": "acf\/group", "data": { "group": 6132, "_group": "group_post" }} /-->');
@endphp

@if( $blocks )
  @foreach( $blocks as $block )
    {!! render_block( $block ) !!}
  @endforeach
@endif
