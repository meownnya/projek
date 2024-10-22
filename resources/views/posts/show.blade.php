@extends('layouts.app')

@section('content')

<h1>{{ $post->title }}</h1>
<p>{{ $post->description }}</p>

@if ($post->music)
    <audio controls autoplay>
        <source src="{{ asset('storage/uploads/music/' . $post->music) }}" type="audio/mpeg">
    </audio>
@endif

<div class="photo-gallery">
    @foreach ($post->photos as $photo)
        <img src="{{ asset('storage/uploads/photos/' . $photo->photo_path) }}" class="border p-2 m-3" style="width: 200px;" alt="{{ $post->title }}">
    @endforeach
</div>

<p>{{ \Carbon\Carbon::parse($post->from_date)->isoFormat('DD MMMM Y') }}</p>

<div class="actions">
    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">Edit</a>
    <a href="{{ route('posts.index') }}" class="btn btn-sm btn-secondary">Back</a>

    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
    </form>
</div>
@endsection
