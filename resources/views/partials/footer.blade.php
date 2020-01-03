<footer class="center">
  <div class="footer-menus">
    <nav class="footer-nav">
      <ul>
        <li class="has-megamenu">
          <a class="menu-item-title" 
              role="button" tabindex="0"
              data-menu-group="footer-menu-megamenus"
              aria-controls="footer-departments-megamenu" 
              aria-expanded="false" 
              aria-pressed="false">
            <span>Departments</span>
          </a>
        </li>
        <li class="has-megamenu">
          <a class="menu-item-title" 
              role="button" tabindex="0"
              data-menu-group="footer-menu-megamenus"
              aria-controls="footer-centers-megamenu" 
              aria-expanded="false" 
              aria-pressed="false">
            <span>Centers and Institutes</span>
          </a>
        </li>
        <li>
          <a role="button" tabindex="0" aria-controls="contact-megamenu" aria-expended="false" aria-pressed="false">Contact Us</a>
        </li>
      </ul>
    </nav>
    @if ( have_rows('header_social_media_icons', 'option') )
    <nav aria-label="Links to social media profiles" class="footer-social">
    @while ( have_rows('header_social_media_icons', 'option') )
      @php the_row() @endphp
      <a href="{{ the_sub_field('link') }}" target="_new"><i class="{{ the_sub_field('type') }}"></i></a>
    @endwhile
    </nav>
    @endif

    <div id="footer-menu-megamenus" class="megamenu-container">
      <nav class="menu-panel" id="footer-departments-megamenu" aria-label="List of departments in the College of Liberal Arts" tabindex="0">
        <div class="menu-panel-content">
          <ul>
            <li><a href="https://liberalarts.tamu.edu/anthropology" target="_blank">Anthropology</a></li>
            <li><a href="https://liberalarts.tamu.edu/communication" target="_blank">Communication</a></li>
            <li><a href="https://econ.tamu.edu" target="_blank">Economics</a></li>
            <li><a href="https://english.tamu.edu" target="_blank">English</a></li>
            <li><a href="https://hisp.tamu.edu" target="_blank">Hispanic Studies</a></li>
            <li><a href="https://hist.tamu.edu" target="_blank">History</a></li>
            <li><a href="https://liberalarts.tamu.edu/ics" target="_blank">Interdisciplinary Critical Studies</a></li>
            <li><a href="https://ints.tamu.edu" target="_blank">International Studies</a></li>
            <li><a href="https://liberalarts.tamu.edu/performancestudies" target="_blank">Performance Studies</a></li>
            <li><a href="https://philosophy.tamu.edu" target="_blank">Philosophy</a></li>
            <li><a href="https://pols.tamu.edu" target="_blank">Political Science</a></li>
            <li><a href="https://liberalarts.tamu.edu/psychology" target="_blank">Psychological and Brain Sciences</a></li>
            <li><a href="https://liberalarts.tamu.edu/sociology" target="_blank">Sociology</a></li>
          </ul>
        </div>
      </nav>

      <nav class="menu-panel" id="footer-centers-megamenu" aria-label="List of Centers and Institutes in the College of Liberal Arts" tabindex="0">
        <div class="menu-panel-content">
          <ul>
            <li><a href="https://txrdc.tamu.edu" target="_blank">Census Research Data Center</a></li>
            <li><a href="http://nautarch.tamu.edu/cmac/" target="_blank">Center for Maritime Archaeology and Conservation</a></li>
            <li><a href="https://liberalarts.tamu.edu/csfa" target="_blank">Center for the Study of First Americans</a></li>
            <li><a href="https://liberalarts.tamu.edu/glasscock" target="_blank">Glasscock Center for Humanities Research</a></li>
            <li><a href="http://codhr.dh.tamu.edu" target="_blank">Center of Digital Humanities Research</a></li>
            <li><a href="http://ppri.tamu.edu" target="_blank">Public Policy Research Institute</a></li>
            <li><a href="http://resi.tamu.edu" target="_blank">Race and Ethnic Studies Institute</a></li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="logo">
      <span class="sr-only">College of Liberal Arts</span>
      <img src="{{ get_template_directory_uri() }}/assets/images/CLA Logo.svg" desc="College of Liberal Arts" />
    </div>
    <div class="legal">
      <div><i class="far fa-copyright"></i> College of Liberal Arts at Texas A&M University</div>
      <nav>
        <a href="https://tamu.edu" target="_blank">Texas A&M University</a>
        <a href="https://itaccessibility.tamu.edu" target="_blank">Accessibility</a>
        <a href="https://liberalarts.tamu.edu/site-policies">Site Policies</a>
        <a href="http://publishingext.dir.texas.gov/portal/internal/resources/DocumentLibrary/State%20Website%20Linking%20and%20Privacy%20Policy.pdf" target="_blank">Linking Policy</a>
      </nav>
    </div>
  </div>
</footer>