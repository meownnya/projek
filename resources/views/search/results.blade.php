@extends('layouts.navbar')

@section('content')
    <h1>Search Results for "{{ $query }}"</h1>

    <!-- Tampilkan hasil pencarian folders -->
    <h2>Folders</h2>
    @if ($folders->count() > 0)
        @foreach ($folders as $folder)
            <a href="{{ route('folders.show', ['folder' => $folder->id]) }}">
                <img src="{{ asset('/storage/uploads/photos/' . $folder->posts->first()->photos->first()->photo_path) }}" 
                     alt="{{ $folder->title }}">
                <h3>{{ $folder->title }}</h3>
            </a>
        @endforeach
    @else
        <p>No folders found.</p>
    @endif

    <!-- Tampilkan hasil pencarian posts -->
    <h2>Posts</h2>
    @if ($posts->count() > 0)
        @foreach ($posts as $post)
            <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                <img src="{{ asset('/storage/uploads/photos/' . $post->photos->first()->photo_path) }}" 
                     alt="{{ $post->title }}">
                <h3>{{ $post->title }}</h3>
            </a>
        @endforeach
    @else
        <p>No posts found.</p>
    @endif
@endsection
