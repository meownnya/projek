@extends('layouts.navbar')

@section('content')

<form action="{{ route('folders.store') }}" method="POST">
    @csrf
    <label for="folder-title">Folder Title:</label>
    <input type="text" name="title" id="folder-title" required><br>

    <label for="folder-description">Description:</label>
    <textarea name="description" id="folder-description"></textarea><br>

    <!-- Tampilkan semua postingan dengan checkbox untuk memilih -->
    @foreach ($posts as $post)
        <div>
            <label>
                <input type="checkbox" name="post_ids[]" value="{{ $post->id }}">
                <img src="{{ asset('/storage/uploads/photos/' . $post->photos->first()->photo_path) }}" 
                     alt="{{ $post->title }}">
            </label>
            <h2>{{ $post->title }}</h2>
        </div>
    @endforeach

    <button type="submit">Create Folder</button>
</form>
@endsection
