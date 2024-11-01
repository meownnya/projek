@extends('lay.app')

@section('content')
<a href="{{ route('folders.index')}}" class="back-button">
    <i class="bi bi-arrow-left"></i>
</a>

<h1>{{ $folder->title }}</h1>

@if ($folder->description)
    <p>{{ $folder->description }}</p>
@endif

@if ($folder->posts->count() > 0)
    <div>
        @foreach ($folder->posts as $post)
            <div>
                <a href="#">
                    @if ($post->photos->first())
                        <a href="{{ route('posts.show', $post->id) }}">
                            <img src="{{ asset('/storage/uploads/photos/' . $post->photos->first()->photo_path) }}" 
                                 alt="{{ $post->title }}">
                        </a>
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
