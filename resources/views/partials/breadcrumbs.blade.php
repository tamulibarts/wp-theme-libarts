<nav aria-label="Breadcrumbs" class="breadcrumbs">
  <ol>
    <li><a href="{{$homeurl}}">Home</a></li>
    @foreach($breadcrumbs as $breadcrumb)
    <li>
    @if($breadcrumb->link)
      <a href="{{$breadcrumb->link}}" {{ $breadcrumb->current ?: 'aria-current="true"' }}>{!! $breadcrumb->title !!}</a>
    @else
      {{$breadcrumb->title}}
    @endif
    </li>
    @endforeach
  </ol>
</nav>
