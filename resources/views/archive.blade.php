@extends('layouts.app')

@section('breadcrumbs')
  @include('partials.breadcrumbs')
@endsection

@section('content')
  @include('partials.page-header')

  @if (!have_posts())
    <div class="alert alert-warning">
      {{ __('Sorry, no results were found.', 'sage') }}
    </div>
    {!! get_search_form(false) !!}
  @endif

  <div class="archive-list">
  @while(have_posts()) @php the_post() @endphp
    @include('partials.content-search')
  @endwhile
  </div>

  {!! get_the_posts_navigation( array(
    'prev_text' => 'More Results',
    'next_text' => 'Previous Results',
    'screen_reader_text' => 'search results navigation',
    'aria_label' => 'search results'
  )) !!}
@endsection