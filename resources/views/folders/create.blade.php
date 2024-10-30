@extends('layouts.navbar')

@section('content')
<div class="container">
    
    <form action="{{ route('folders.store') }}" method="POST" class="folder-form">
        @csrf
        <div class="form-group">
            <label for="folder-title">Folder Title:</label>
            <input type="text" name="title" id="folder-title" required>
        </div>

        <div class="form-group">
            <label for="folder-description">Description:</label>
            <textarea name="description" id="folder-description"></textarea>
        </div>

        <div class="grid-container">
            @foreach ($posts as $post)
                <div class="grid-item">
                    <label>
                        <input type="checkbox" name="post_ids[]" value="{{ $post->id }}" class="checkbox">
                        <div class="image-container">
                            <img src="{{ asset('/storage/uploads/photos/' . $post->photos->first()->photo_path) }}" 
                                 alt="{{ $post->title }}" class="post-image">
                        </div>
                        <h2 class="post-title">{{ $post->title }}</h2>
                    </label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="submit-button">Create Folder</button>
    </form>
</div>

@endsection
