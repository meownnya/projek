@extends('layouts.app')

@section('content')
<a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>


    <h3 class="text-center text-danger">
        <a href="{{ route('posts.create') }}" class="btn btn-sm btn-primary mb-2">Create Post</a>
    </h3>

<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" class="form-control" required>
    </div>
    
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea name="description" id="description" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label for="music">Music:</label>
        <input type="file" name="music" id="music" class="form-control-file" accept="audio/*">
    </div>

    <div class="form-group">
        <label for="photos">Photos:</label>
        <input type="file" name="photos[]" id="photos" class="form-control-file" multiple accept="image/*" required>
    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>

@endsection
