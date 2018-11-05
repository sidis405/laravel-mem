@extends('layouts.app')

@section('content')

<h3>Create a new post</h3>

<section>
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf

        @include('posts._form')

        <button type="submit" class="btn btn-success btn-block">Publish</button>
    </form>
</section>

@endsection
