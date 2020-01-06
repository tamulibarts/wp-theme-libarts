@extends('layouts.app')

@section('breadcrumbs')
  @include('partials.breadcrumbs')
@endsection

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.sidebar')
    <div class="content">
      @include('partials.content-single-'.get_post_type())
    </div>
  @endwhile
@endsection
