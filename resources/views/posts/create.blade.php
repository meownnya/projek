@extends('layouts.navbar')

@section('content')

<style>

.form-title {
    text-align: center;
    font-size: 2rem;
    margin-bottom: 1.5rem;
    color: #87cefa;
}

.post-form {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 2rem;
    max-width: 800px;
    margin: 2rem auto;
}

.form-container {
    display: flex;
    justify-content: space-between;
}

.upload-section {
    width: 40%; /* Adjust width for left section */
    padding-right: 1rem;
}

.info-section {
    width: 55%; /* Adjust width for right section */
}

.form-group {
    margin-bottom: 1.5rem;
}

.upload-label {
    display: flex;
    align-items: center;
    margin-bottom: 0.5rem;
}

.upload-icon {
    margin-right: 0.5rem;
    font-size: 1.5rem; /* Adjust icon size */
}

.form-input,
.form-textarea {
    width: 100%;
    padding: 0.8rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
    transition: border-color 0.3s;
}

.form-input:focus,
.form-textarea:focus {
    border-color: #66afe9;
    outline: none;
}

.form-textarea {
    height: 100px;
    resize: none;
}

.submit-button {
    background-color: #007bff; /* Blue color */
    color: white;
    padding: 0.75rem;
    border: none;
    border-radius: 5px;
    font-size: 1.1rem;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s;
}

.submit-button:hover {
    background-color: #0056b3; /* Darker blue on hover */
}

/* Responsive Styles */
@media (max-width: 768px) {
    .post-form {
        padding: 1rem;
    }

    .form-title {
        font-size: 1.5rem;
    }

    .form-container {
        flex-direction: column;
        align-items: flex-start;
    }

    .upload-section,
    .info-section {
        width: 100%; /* Full width on smaller screens */
        padding-right: 0; /* Remove padding */
    }
}

    .custom-file-upload {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background-color: #007bff; /* Blue color */
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 0.5rem;
    text-decoration: none;
    font-size: 1rem;
    transition: background-color 0.3s;
}

.custom-file-upload:hover {
    background-color: #0056b3; /* Darker blue on hover */
}

.upload-icon {
    margin-right: 0.5rem;
    font-size: 1.5rem; /* Adjust icon size */
}

</style>

<h3 class="form-title">Create Post</h3>

<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="post-form">
    @csrf
    <div class="form-container">
        <div class="upload-section">
            <div class="form-group">
                <label for="music" class="upload-label">
                    <i class="upload-icon music-icon fas fa-music"></i> Music:
                </label>
                <input type="file" name="music" id="music" accept="audio/*" class="form-input" hidden>
                <label for="music" class="custom-file-upload">
                    <i class="fas fa-upload"></i>
                </label>
            </div>

            <div class="form-group">
                <label for="photos" class="upload-label">
                    <i class="upload-icon photo-icon fas fa-image"></i> Photos:
                </label>
                <input type="file" name="photos[]" id="photos" multiple accept="image/*" required class="form-input" hidden>
                <label for="photos" class="custom-file-upload">
                    <i class="fas fa-upload"></i>
                </label>
            </div>
        </div>

        <div class="info-section">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" required class="form-input">
            </div>
            
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-textarea"></textarea>
            </div>
        </div>
    </div>

    <button type="submit" class="submit-button">Create</button>
</form>

@endsection
