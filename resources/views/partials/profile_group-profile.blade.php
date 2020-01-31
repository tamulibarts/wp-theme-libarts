<article class="person">
    <div class="img">
    
        <img src="{{ esc_url($profile->image()['url']) }}" alt="{{ esc_attr( $profile->image()['alt'] ) }}" />
    </div>
    <div class="info">
        <h3>{{ $profile->full_name( $profile_name_format ) }}</h3>
        @if($profile->title())<span class="title">{{ $profile->title() }}</span>@endif
        @if($profile->phone())<span class="phone">{{ $profile->phone() }}</span>@endif
        @if($profile->email())<span class="email"><a href="mailto:{{ $profile->email() }}">{{ $profile->email() }}</a></span>@endif
    </div>
</article>