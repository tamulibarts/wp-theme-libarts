<article @php post_class() @endphp>
  @if(!is_front_page())
  <header>
    <h2 class="entry-title"><a href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h2>
    @include('partials/entry-meta')
  </header>
  @endif
  
  <aside class="sidebar">
    @include('partials.sidebar')
  </aside>
  <div class="entry-summary">
    @php the_excerpt() @endphp
  </div>
</article>
