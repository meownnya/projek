@extends('layouts.app')

@section('content')

<div class="col-lg-6">
    <h3 class="text-center text-danger"><b>Edit Photos</b></h3>
    <a href="{{ session()->get('previous_url', url()->previous()) }}" class="btn btn-sm btn-secondary">Back</a>

    
    <div class="form-group">        
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($post->music)
            <p>Music:</p>
            <form action="/deletemusic/{{ $post->id }}" method="post">
                @csrf
                @method('delete')
                <button class="btn text-danger">X</button>
            </form>
            <audio controls>
                <source src="{{ asset('storage/uploads/music/' . $post->music) }}" type="audio/mpeg">
            </audio>
        @else
            <form action="/addmusic/{{ $post->id }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="music">Music:</label>
                    <input type="file" name="music" id="music" accept="audio/*">
                </div>
                <button type="submit" class="btn btn-primary">Add Music</button>
            </form>
        @endif

        @if (count($post->photos) > 0)
            <p>Photos:</p>
            @foreach ($post->photos as $photo)
                <form action="/deletephoto/{{ $photo->id }}" method="post" style="display: inline-block;">
                    @csrf
                    @method('delete')
                    <button class="btn text-danger">X</button>
                </form>
                <img src="{{ asset('storage/uploads/photos/' . $photo->photo_path) }}" class="img-responsive" style="max-height: 100px; max-width: 100px;" alt="Photo">
            @endforeach

            <form action="/addphotos/{{ $post->id }}" method="POST" enctype="multipart/form-data" class="mt-2">
                @csrf
                <div class="form-group">
                    <label for="photos">Add Photos:</label>
                    <input type="file" name="photos[]" multiple>
                </div>
                <button type="submit" class="btn btn-primary">Add Photos</button>
            </form>
        @endif

        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="mt-3">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" value="{{ $post->title }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control">{{ old('description', $post->description) }}</textarea>
            </div>
            <button type="submit" class="btn btn-danger mt-3">Edit</button>
        </form>

    </div>
</div>

@endsection
