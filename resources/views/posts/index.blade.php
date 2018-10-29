@extends('layouts.app')

@section('content')

<h2>Latest Post ({{ $posts->total() }})</h2>

{{ $posts->links() }}

@foreach($posts as $post)
    @include('posts._post', ['full' => false])
@endforeach

{{ $posts->links() }}

@endsection
