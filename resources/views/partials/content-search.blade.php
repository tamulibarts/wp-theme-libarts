<article @php post_class() @endphp>
@if(has_post_thumbnail())
  <figure>{!! get_the_post_thumbnail() !!}</figure>
@endif
  <a href="{{ get_permalink() }}"></a>
  <div class="article-body">
    <header>
      <h2>{!! get_the_title() !!}</h2>
      @if( get_post_type() == "post" )
        <time class="posted" datetime="{{ get_post_time('c', true) }}">{{ get_the_date() }}</time>
      @endif
    </header>
    <p class="excerpt">{!! get_the_excerpt() !!}</p>
  </div>

</article>

