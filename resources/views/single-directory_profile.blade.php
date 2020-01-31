@extends('layouts.app')

@section('breadcrumbs')
  @include('partials.breadcrumbs')
@endsection

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.page-header')
    @include('partials.sidebar')
    <div class="content">
      <article class="directory-profile">
        <div class="row">
          @if($profile->image())
          <div class="col-4">
            {!!  wp_get_attachment_image( $profile->image()['ID'], 'large', "", ["class" => "img-fluid rounded mx-auto d-block"] ) !!}
          </div>
          @endif

          <div class="col">
            @if($profile->title())
            <div class="profile-title">{{ $profile->title() }}</div>
            @endif

            @if($profile->rank())
            <div class="profile-title">{{ $profile->rank() }}</div>
            @endif

            <dl id="profile-demo">
              @if($profile->areas())
              <dt>Areas of Speciality</dt>
              <dd>
                <ul class="label-list">
                  @foreach ($profile->areas() as $area)
                  <li class='label label-block'>
                  {!! $area['label'] !!}
                  </li>
                  @endforeach
                </ul>
              </dd>
              @endif

            <?php if( isset($orgs) && !empty($orgs) ): ?>
              <dt>Memberships</dt>
              <dd>
              <?php
                $str = '<ul class="label-list">';
                foreach($orgs as $org):
                  $str .= "<li class='label'>";
                  $str .= (isset($org['url']) && !empty($org['url'])) ? '<a href="' . $org['url'] . '">' . $org['name'] . '</a>' : $org['name'];
                  $str .= '</li>';
                endforeach;
                echo $str;
                echo '</ul></dd>';
            endif; ?>

              <dt>Contact</dt>
              <dd>
                <ul>
                  @if($profile->phone())<li><i class="fa fa-phone"></i> {{ $profile->phone() }}</li>@endif
                  @if($profile->email())<li><i class="fa fa-envelope-o"></i> {{ $profile->email() }}</li>@endif
                  @if($profile->location())<li><i class="fa fa-building-o"></i> {{ $profile->location() }}</li>@endif
                </ul>
              </dd>

              <?php
                $pf_content = "";

                if( $profile->vita() ) {
                  $pf_content .= "<li class='label'>" . wp_get_attachment_link( $profile->vita()['ID'], '', false, true, 'CV') . "</li>";
                }

                if( $profile->prof_links() ) {
                  foreach($profile->prof_links() as $link) {
                    if( !empty( $link['url'] ) )
                      $pf_content .= "<li class='label'><a href=\"" . $link['url'] . "\" target='_blank'>" . $link['title'] . "</a></li>";
                  }
                }



                $pf_content = rtrim($pf_content, ', ');

                if( !empty( $pf_content ) ) {
                  echo "<dt>Professional Links</dt>";
                  echo "<dd><ul class='label-list'>" . $pf_content . "</ul></dd>";
                }

                if( $profile->personal_url() && get_field( 'settings_allow_personal_website', 'options' ) ) {
                  echo "<a href=\"" . $profile->personal_url() . "\" target='_blank'>Personal Website</a>";
                }

                while( have_rows( 'settings_profile_extra_fields', 'options' ) ): the_row();
                  $content_key = 'profile_extra_field_' . sanitize_key( get_sub_field( 'uid' ) ) . '_value';
                  $value = get_field( $content_key );
                  if( $value ) {
                    echo "<dt>" . get_sub_field( 'label' ) . "</dt>";
                    echo "<dd>$value</dd>";
                  }
                endwhile;

              ?>
            </dl>
          </div>
        </div>

      <?php while( have_rows( 'profile_content_section', 'options' ) ): the_row(); $content_key = 'profile_content_section_' . sanitize_key(get_sub_field( 'uid' )) . '_content'; ?>
        <?php if( get_field( $content_key ) ): ?>
          <div class="row">
            <div class="col">
              <h3><?php the_sub_field( 'section_title' ); ?></h3>
              <?php the_field( $content_key); ?>
            </div>
          </div>
        <?php endif; ?>
      <?php endwhile; ?>

      <?php while( have_rows( 'profile_custom_content') ): the_row() ?>
        <?php if( get_sub_field( 'content' ) ): ?>
          <div class="row">
            <div class="col">
              <h3><?php the_sub_field( 'title' ); ?></h3>
              <?php the_sub_field( 'content' ); ?>
            </div>
          </div>
        <?php endif; ?>
      <?php endwhile; ?>
      </article>
    </div>
  @endwhile
@endsection