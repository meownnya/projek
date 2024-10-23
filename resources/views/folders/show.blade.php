@extends('layouts.app')

@section('content')
<a href="{{ route('folders.index')}}">Back</a>
    <h1>{{ $folder->title }}</h1>

    <!-- Deskripsi Folder -->
    @if ($folder->description)
        <p>{{ $folder->description }}</p>
    @else
        
    @endif

    <!-- Daftar Postingan yang Ada di Folder -->

    @if ($folder->posts->count() > 0)
        <div class="post-grid">
            @foreach ($folder->posts as $post)
                <div class="post-item">
                    <a href="#">
                        @if ($post->photos->first())
                        <a href="{{ route('posts.show', $post->id) }}">
                            <img src="{{ asset('/storage/uploads/photos/' . $post->photos->first()->photo_path) }}" 
                                 alt="{{ $post->title }}"
                                 style="width: 150px;">
                        @else
                            <p>No photo available for this post.</p>
                        @endif
                    </a>
                    <h3>{{ $post->title }}</h3>
                </div>
            @endforeach
        </div>
    @else
        <p>No posts in this folder.</p>
    @endif

@endsection