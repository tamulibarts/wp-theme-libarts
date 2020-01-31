<div class="directory-group">
  @foreach( $profile_group['profiles'] as $profile )
    @include('partials.profile_group-profile', ['profile' => $profile])


  @endforeach
</div>