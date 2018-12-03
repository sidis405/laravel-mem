@extends('layouts.app')

@section('content')

<h3>Edit this post</h3>

<section>
    <form method="POST" action="{{ route('posts.update', $post) }}"  enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        @include('posts._form')

        <button type="submit" class="btn btn-warning btn-block">Update</button>
    </form>
</section>

<hr>

<section>
    <form method="POST" action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('Are you sure?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</section>

@endsection
