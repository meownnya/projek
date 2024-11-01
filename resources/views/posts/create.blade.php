@extends('lay.app')

@section('content')

<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="post-form">
    @csrf
    <div class="form-container">
        <div class="upload-section">
            <div class="form-group">
                <label for="music" class="upload-label">
                    <i class="upload-icon fas fa-music"></i> Music
                </label>
                <input type="file" name="music" id="music" accept="audio/*" hidden onchange="previewAudio(event)">
                <label for="music" class="custom-file-upload">
                    <i class="fas fa-upload"></i> Upload Music
                </label>
                <div id="preview-audio" class="preview-audio"></div>
            </div>
            <div class="form-group">
                <label for="photos" class="upload-label">
                    <i class="upload-icon fas fa-image"></i> Photos
                </label>
                <input type="file" name="photos[]" id="photos" multiple accept="image/*" hidden onchange="previewImages(event)">
                <label for="photos" class="custom-file-upload">
                    <i class="fas fa-upload"></i> Upload Photos
                </label>
                <div id="preview-images" class="preview-images"></div>
            </div>
        </div>
        <div class="info-section">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" required class="form-input">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-textarea"></textarea>
            </div>
        </div>
    </div>
    <button type="submit" class="submit-button">Create</button>
</form>
<script>
    function previewAudio(event) {
        const file = event.target.files[0];
        const previewAudio = document.getElementById('preview-audio');
        previewAudio.innerHTML = '';
        if (file) {
            const audio = document.createElement('audio');
            audio.controls = true;
            audio.src = URL.createObjectURL(file);
            previewAudio.appendChild(audio);
        }
    }
    function previewImages(event) {
        const files = event.target.files;
        const previewImages = document.getElementById('preview-images');
        previewImages.innerHTML = '';

        Array.from(files).forEach(file => {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            previewImages.appendChild(img);
        });
    }
</script>
@endsection
