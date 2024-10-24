@extends('layouts.navbar')

@section('content')

<h3>
    <a href="{{ route('posts.create') }}">Create Post</a>
</h3>

<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
    </div>
    
    <div>
        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea>
    </div>

    <div>
        <label for="music">Music:</label>
        <input type="file" name="music" id="music" accept="audio/*">
    </div>

    <div>
        <label for="photos">Photos:</label>
        <input type="file" name="photos[]" id="photos" multiple accept="image/*" required>
    </div>

    <button type="submit">Create</button>
</form>

@endsection
