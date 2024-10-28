@extends('layouts.navbar')

@section('content')

<div>
    <h3>Edit Photos</h3>

    <div>
        @if (session('error'))
            <div>
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div>
                {{ session('success') }}
            </div>
        @endif

        @if ($post->music)
            <p>Music:</p>
            <form action="/deletemusic/{{ $post->id }}" method="post">
                @csrf
                @method('delete')
                <button>X</button>
            </form>
            <audio controls>
                <source src="{{ asset('storage/uploads/music/' . $post->music) }}" type="audio/mpeg">
            </audio>
        @else
            <form action="/addmusic/{{ $post->id }}" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="music">Music:</label>
                    <input type="file" name="music" id="music" accept="audio/*">
                </div>
                <button type="submit">Add Music</button>
            </form>
        @endif

        @if (count($post->photos) > 0)
            <p>Photos:</p>
            @foreach ($post->photos as $photo)
                <form action="/deletephoto/{{ $photo->id }}" method="post" style="display: inline-block;">
                    @csrf
                    @method('delete')
                    <button>X</button>
                </form>
                <img src="{{ asset('storage/uploads/photos/' . $photo->photo_path) }}" alt="Photo">
            @endforeach

            <form action="/addphotos/{{ $post->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="photos">Add Photos:</label>
                    <input type="file" name="photos[]" multiple>
                </div>
                <button type="submit">Add Photos</button>
            </form>
        @endif

        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" value="{{ $post->title }}" required>
            </div>
            <div>
                <label for="description">Description:</label>
                <textarea name="description" id="description">{{ old('description', $post->description) }}</textarea>
            </div>
            <button type="submit">Edit</button>
        </form>

    </div>
</div>

@endsection
