<section class="post-meta">
  <div class="share-set">
    <span>Share:</span>
    <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode( get_the_permalink() ) }}" target="_blank" rel="noopener" aria-label="Share this story on Facebook">
    Facebook
    </a>

    <a href="https://twitter.com/intent/tweet/?text={{ urlencode( get_the_title() ) }}&amp;url={{ urlencode( get_the_permalink() ) }}" target="_blank" rel="noopener" aria-label="Share this story on Twitter">
    Twitter
    </a>

    <a href="mailto:?subject={{ urlencode( get_the_title() ) }}&amp;body={{ urlencode( get_the_permalink() ) }}" target="_self" rel="noopener" aria-label="Share this story via email">
    Email
    </a>
  </div>

  @if( $categories )
  <div class="tag-set">
    <span>Categories:</span>
    <ul>
      @foreach( $categories as $category)
        <li><a href="{{ get_term_link($category) }}">{{ $category->name }}</a></li>
      @endforeach
    </ul>
  </div>
  @endif

  @if( $tags )
  <div class="tag-set">
    <span>Tags:</span>
    <ul>
      @foreach( $tags as $tag)
        <li><a href="{{ get_term_link($tag) }}">{{ $tag->name }}</a></li>
      @endforeach
    </ul>
  </div>
  @endif
</section>