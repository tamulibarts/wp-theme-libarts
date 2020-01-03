<section class="byline">
  <div>By {!! get_the_author() !!}</div>
  <div class="post-date">{{ date('F j, Y', strtotime($post->post_date)) }}</div>
</section>