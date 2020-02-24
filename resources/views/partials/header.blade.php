<header>
  <div class="header-content row no-gutters">
    <a class="content-skip" href="#main">
      <span>Skip to main content</span>
    </a>
    <div id="logo-container">
      <span class="sr-only">{{ get_bloginfo('name', 'display') }}</span>
      <div class="tamulogo">
        <a href="https://www.tamu.edu" target="_new"><img src="{{ get_template_directory_uri() }}/assets/images/TAMU_BLOCK.svg" desc="Texas A&M University" /></a>
      </div>
      <div class="unitlogo">
        <div class="major"><a href="https://www.tamu.edu" target="_new">Texas A&M University</a></div>
        <div class="minor"><a href="{{ get_home_url() }}">College of Liberal Arts</a></div>
      </div>
    </div>
    <nav aria-label="Main Menu" id="main-menu">
      <a role="button" tabindex="0" id="main-menu-toggle" class="menu-icon" aria-expanded="false" aria-controls="main-menu"><i class="fas fa-bars"></i></a>
        {!! Header::megaMenuWalker() !!}
    </nav>
    <div class="header-icons">
      @if ( have_rows('header_social_media_icons', 'option') )
      <nav aria-label="Links to social media profiles" id="social-media-icons">
      @while ( have_rows('header_social_media_icons', 'option') )
        @php the_row() @endphp
        <a href="{{ the_sub_field('link') }}" target="_new"><i class="{{ the_sub_field('type') }}"></i></a>
      @endwhile
      </nav>
      @endif
      <nav aria-label="Link to the site search field" class="search-nav">
        <a role="button" tabindex="0" class="toggle-button" id="search-toggle" aria-controls="#search-container" aria-expanded="false" aria-pressed="false"><i class="fas fa-search"></i></a>
      </nav>
    </div>
    <div id="search-container">
      <form role="search" method="get" class="search-form" action="{{ get_home_url() }}">
        <input type="text" placeholder="Search" tabindex="-1" value="" name="s">
        <button type="submit"><i class="fa fa-angle-double-right" id="newsletterSubmitIcon"></i></button>
      </form>
    </div>
  </div>
</header>


