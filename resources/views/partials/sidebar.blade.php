@if( @$has_sidebar )
<aside class="sidebar" data-has-sidebar="{!!  $has_sidebar !!}">
  <!-- <button class="toggle collapsed" type="button" data-toggle="collapse" data-target="#sidebar-nav" aria-controls="sidebar-nav" aria-expanded="false" aria-label="Toggle docs navigation">Page Menu</button> -->
  <nav aria="Sidebar Menu" class="" id="sidebar-nav">
    {!! $sidebar_content !!}
  </nav>
</aside>
@endif

