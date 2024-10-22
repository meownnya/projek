@extends('layouts.app')

@section('content')

    <form action="{{ route('folders.store') }}" method="POST">
        @csrf
        <label for="folder-title">Folder Title:</label>
        <input type="text" name="title" id="folder-title" required><br>

        <label for="folder-description">Description (optional):</label>
        <textarea name="description" id="folder-description"></textarea><br>

        <!-- Tampilkan semua postingan dengan checkbox untuk memilih -->
        <div class="posts-grid">
            @foreach ($posts as $post)
                <div class="post-item">
                    <label>
                        <input type="checkbox" name="post_ids[]" value="{{ $post->id }}">
                        <img src="{{ asset('/storage/uploads/photos/' . $post->photos->first()->photo_path) }}" 
                             class="border p-2 m-3" 
                             style="width: 200px;" 
                             alt="{{ $post->title }}">
                    </label>
                    <h2>{{ $post->title }}</h2>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-sm btn-success">Create Folder</button>
        <a href="{{ route('folders.index') }}" class="btn btn-sm btn-danger">Cancel</a>
    </form>
@endsection
