@extends('layouts.navbar')

@section('content')

<script>
    let currentSlide = 0;

    function moveSlide(direction) {
        const track = document.querySelector('.slider-track');
        const totalSlides = track.children.length;

        if (totalSlides > 1) {
            currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
            track.style.transform = `translateX(-${currentSlide * 100}%)`;
        }
    }
</script>

<a href="{{ url()->previous() }}" class="back-button">❮</a>

<div class="post-wrapper">

    <div class="slider-container">
        <div class="slider-track" style="transform: translateX(0);">
            @foreach ($post->photos as $photo)
                <div class="slider-item">
                    <img src="{{ asset('storage/uploads/photos/' . $photo->photo_path) }}" alt="{{ $post->title }}">
                </div>
            @endforeach
        </div>

        @if (count($post->photos) > 1)
            <div class="slider-nav">
                <button class="prev" onclick="moveSlide(-1)">❮</button>
                <button class="next" onclick="moveSlide(1)">❯</button>
            </div>
        @endif

        <div class="music-container">
            <audio controls {{ $post->music ? '' : 'class=disabled' }}>
                <source src="{{ $post->music ? asset('storage/uploads/music/' . $post->music) : '#' }}" type="audio/mpeg">
            </audio>
        </div>
        <p class="date">{{ \Carbon\Carbon::parse($post->from_date)->isoFormat('DD MMMM Y') }}</p>
    </div>

    <div class="post-info">
        <h1 class="post-titles">{{ $post->title }}</h1>
        <p class="post-description">{{ $post->description ?: 'No description' }}</p>
    </div>
</div>

<a href="{{ route('posts.edit', $post->id) }}">Edit</a>

<form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="delete-button">🗑️</button>
</form>

@endsection
