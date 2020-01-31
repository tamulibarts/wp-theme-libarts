@extends('layouts.app')

@section('breadcrumbs')
  @include('partials.breadcrumbs')
@endsection

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.sidebar')
    <div class="content">
      @foreach( $profile_groups as $profile_group )
        @include('partials.profile_group')
      @endforeach
    </div>
  @endwhile
@endsection
