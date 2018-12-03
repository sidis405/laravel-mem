<div class="row">
    <div class="col-md-12">
        <ul>
            @foreach($archiveArticles as $record)
                <li>
                    <a href="{{ route('posts.index') }}?month={{ $record->month }}&year={{ $record->year }}">{{ $record->month }} {{ $record->year }} ({{ $record->published }})</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
