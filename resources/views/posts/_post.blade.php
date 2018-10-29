<div class="card">
    <div class="card-header">
        <h3><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h3>
        <small>by {{ $post->user->name }} on {{ $post->created_at->format('d/m/Y H:i') }}</small>
    </div>
    <div class="card-body">
        {{ $post->preview }}

        @if($full)
            {!! nl2br($post->body) !!}
        @endif
    </div>
    <div class="card-footer">
        <small>posted on {{ $post->category->name }}</small>
        <small>tags: {{ $post->tags->pluck('name')->implode(', ') }}</small>
    </div>
</div>
<br>
