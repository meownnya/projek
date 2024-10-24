@extends('layouts.navbar')

@section('content')
<a href="{{ url()->previous() }}">Back</a>

<h1>{{ $post->title }}</h1>
<p>{{ $post->description }}</p>

@if ($post->music)
    <audio controls autoplay>
        <source src="{{ asset('storage/uploads/music/' . $post->music) }}" type="audio/mpeg">
    </audio>
@endif

<div>
    @foreach ($post->photos as $photo)
        <img src="{{ asset('storage/uploads/photos/' . $photo->photo_path) }}" alt="{{ $post->title }}">
    @endforeach
</div>

<p>{{ \Carbon\Carbon::parse($post->from_date)->isoFormat('DD MMMM Y') }}</p>

<div>
    <a href="{{ route('posts.edit', $post->id) }}">Edit</a>

    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
</div>
@endsection
