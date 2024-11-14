@extends('lay.app') 

@section('content')

<div class="post-card">

    <div class="left-section">
        <div class="slider-container">
            <div class="slider-track" id="sliderTrack">
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
        </div>

        <div class="media-info">
            <div class="custom-audio">
                <button onclick="toggleAudio()" id="audioButton" class="{{ $post->music ? '' : 'dimmed' }}">
                    <i class="bi bi-play-fill"></i>
                </button>
            </div>
            <p class="date">{{ \Carbon\Carbon::parse($post->from_date)->isoFormat('DD MMMM Y') }}</p>
        </div>
        <audio id="audioPlayer" src="{{ $post->music ? asset('storage/uploads/music/' . $post->music) : '#' }}"></audio>
    </div>

    <div class="right-section">
        <div class="card-content">
            <h1 class="post-title">{{ $post->title }}</h1>
            <hr class="divider">
            <p class="post-description">{{ $post->description ?: 'No description' }}</p>
        </div>
    </div>

    <div class="action-buttons">
        <a href="{{ route('posts.edit', $post->id) }}">
            <button class="edit-button"><i class="bi bi-pencil"></i></button>
        </a>
        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-button">
                <i class="bi bi-trash"></i>
            </button>
        </form>
    </div>
</div>

@endsection
