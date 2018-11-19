@foreach($tags as $tag)
    <span style="font-size: {{ $tag->posts_count * 1.2 }}px"><a href="{{ route('tags.show', $tag) }}">{{ $tag->name }}</a></span>
@endforeach


