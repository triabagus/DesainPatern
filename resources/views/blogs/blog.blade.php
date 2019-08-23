@foreach($blogs as $blog)
    <a href="/blog/{{ $blog->id }}">{{ $blog->title }}</a></br>
@endforeach