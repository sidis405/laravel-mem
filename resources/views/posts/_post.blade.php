<div class="card">
    <div class="card-header">
        <h3>
            <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
            @auth | <a href="{{ route('posts.edit', $post) }}">[Edit]</a> @endauth
        </h3>
        <small>by {{ $post->user->name }} on {{ $post->created_at->format('d/m/Y H:i') }}</small>
    </div>
    <div class="card-body">
        {{ $post->preview }}

        @if($full)
            {!! nl2br($post->body) !!}
        @endif
    </div>
    <div class="card-footer">
        <small>posted on <a href="{{ route('categories.show', $post->category) }}">{{ $post->category->name }}</a></small>
        <small>tags: {!! $post->tags->pluck('link')->implode(', ') !!}</small>
    </div>
</div>
<br>
