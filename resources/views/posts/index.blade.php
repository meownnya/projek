@extends('layouts.navbar')

@section('content')

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="posts-container">
    @if ($posts->count() > 0)
        @foreach ($posts as $post)
            <div class="post-item">
                <a href="{{ route('posts.show', $post->id) }}">
                    <img src="{{ asset('storage/uploads/photos/' . ($post->photos->first()->photo_path ?? 'default.jpg')) }}" 
                         alt="{{ $post->title }}" class="post-image">
                </a>
                <h2 class="post-title">{{ $post->title }}</h2>

                <p class="post-folder">
                    <i class="fas fa-folder"></i> 
                    {{ $post->folders->isNotEmpty() ? $post->folders->first()->title : 'None' }}
                </p>
            </div>
        @endforeach
    @else
        <p>No posts found.</p>
    @endif
</div>

<script>

    const alert = document.querySelector('.alert');

    if (alert) {
        
        setTimeout(() => {
            alert.classList.add('fade-out');
            
            setTimeout(() => {
                alert.remove();
            }, 500); 
        }, 3000); 
    }
</script>
@endsection
