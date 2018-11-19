<ul>
    @foreach($categories as $category)
        <li><a href="{{ route('categories.show', $category) }}">{{ $category->name }} ({{ $category->posts_count }})</a></li>
    @endforeach
</ul>
