@extends('lay.app')

@section('content')
<div class="container">

    <div class="form-container">
        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($post->music)
            <div class="music-section">
                <p>Music:</p>
                <form action="/deletemusic/{{ $post->id }}" method="post" class="delete-music-form">
                    @csrf
                    @method('delete')
                    <button type="submit" class="delete-button">X</button>
                </form>
                <audio controls>
                    <source src="{{ asset('storage/uploads/music/' . $post->music) }}" type="audio/mpeg">
                </audio>
            </div>
        @else
            <form action="/addmusic/{{ $post->id }}" method="post" enctype="multipart/form-data" class="add-music-form">
                @csrf
                <div class="form-group">
                    <label for="music" class="upload-label">
                        <i class="upload-icon fas fa-music"></i> Music
                    </label>
                    <input type="file" name="music" id="music" accept="audio/*" hidden onchange="updateFileName(this)">
                    <label for="music" class="custom-file-upload">
                        <i class="fas fa-upload"></i> Upload File
                    </label>
                    <span id="file-name">No file chosen</span>
                </div>
                <button type="submit" class="submit-button">Add Music</button>
            </form>
        @endif

        @if (count($post->photos) > 0)
            <p>Photos:</p>
            <div class="photo-gallery">
                @foreach ($post->photos as $photo)
                    <div class="photo-item">
                        <form action="/deletephoto/{{ $photo->id }}" method="post" class="delete-photo-form">
                            @csrf
                            @method('delete')
                            <button type="submit" class="delete-button">x</button>
                        </form>
                        <img src="{{ asset('storage/uploads/photos/' . $photo->photo_path) }}" alt="Photo" class="post-image">
                    </div>
                @endforeach
            </div>

            <form action="/addphotos/{{ $post->id }}" method="POST" enctype="multipart/form-data" class="add-photos-form">
                @csrf
                <div class="form-group">
                    <label for="photos" class="upload-label">
                        <i class="upload-icon fas fa-image"></i> Photos
                    </label>
                    <input type="file" name="photos[]" id="photos" multiple accept="image/*" hidden>
                    <label for="photos" class="custom-file-upload">
                        <i class="fas fa-upload"></i> Upload Files
                    </label>
                </div>
                <button type="submit" class="submit-button">Add Photos</button>
            </form>
        @endif

        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="edit-post-form">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ $post->title }}" required class="form-input">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-textarea">{{ old('description', $post->description) }}</textarea>
            </div>
            <button type="submit" class="submit-button">Edit</button>
        </form>
    </div>
</div>

<script>
    function updateFileName(input) {
        const fileName = input.files.length ? input.files[0].name : 'No file chosen';
        document.getElementById('file-name').textContent = fileName;
    }
</script>

@endsection
