<form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div>
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="{{ $post->title }}" required>
    </div>
    
    <div>
        <label for="description">Description:</label>
        <textarea name="description" id="description">{{ $post->description }}</textarea>
    </div>

    <div>
        <label for="music">Music (optional):</label>
        <input type="file" name="music" id="music" accept="audio/*">
    </div>

    <div>
        <label for="photos">Photos (add more if needed):</label>
        <input type="file" name="photos[]" id="photos" multiple accept="image/*">
    </div>

    <button type="submit">Update Post</button>
</form>
