<nav aria-label="Breadcrumbs" class="breadcrumbs">
  <ol>
    <li><a href="{{$homeurl}}">Home</a></li>
    @foreach($breadcrumbs as $breadcrumb)
    <li>
      <a href="{{$breadcrumb->link}}" {{ $breadcrumb->current ?: 'aria-current="true"' }}>{{$breadcrumb->title}}</a>
    </li>
    @endforeach
  </ol>
</nav>
