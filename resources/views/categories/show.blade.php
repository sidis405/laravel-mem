@extends('layouts.app')

@section('content')

<h2>Latest Post on category "{{ $category->name }}" ({{ $posts->total() }})</h2>

{{ $posts->links() }}

@foreach($posts as $post)
    @include('posts._post', ['full' => false])
@endforeach

{{ $posts->links() }}

@endsection
