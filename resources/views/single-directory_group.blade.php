@extends('layouts.app')

@section('breadcrumbs')
  @include('partials.breadcrumbs')
@endsection

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.sidebar')
    <div class="content">
    @debug('hierarchy')
      <div class="directory-group">
        @foreach( $profile_groups as $profile_group )
          @include('partials.profile_group')
        @endforeach
      </div>
    </div>
  @endwhile
@endsection
