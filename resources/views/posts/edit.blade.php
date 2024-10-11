<form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div>
        {{-- <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="{{ $post->title }}" required>
         --}}
        <label for="title" class="form-label">Title:</label>
            <input type="text" name="title" id="title" value="{{ $post->title }}" class="form-control  @error('title') is-invalid @enderror" /> 

                @error('title')
                    <div class="invalid-feedback d-blok">{{ $message }}</div>
                @enderror
    </div>
    
    <div>
        {{-- <label for="description">Description:</label>
        <textarea name="description" id="description">{{ $post->description }}</textarea> --}}
        <label for="description" class="form-label">Description:</label>
            <textarea name="description" id="description"  class="form-control @error('description') is-invalid @enderror">{{ $post->description}}</textarea>
                @error('description')
                    <div class="invalid-feedback d-blok">{{ $message }}</div>
                @enderror
    </div>

    <div>
        <label for="music">Music:</label>
        <input type="file" name="music" id="music" accept="audio/*">
        <audio src="{{ asset('storage/music/' . $post->music) }}" controls></audio>
    </div>

    <div>
        <label for="photos">Photos:</label>
                <input type="file" name="photos[]" id="photos" multiple accept="image/*">
                @foreach ($post->photos as $photo)
                    <img src="{{ asset('storage/photos/' . $photo->photo_path) }}" class="border p-2 m-3" style="width: 200px;" alt="{{ $post->title }}" />
                @endforeach
    </div>

    <button type="submit">Edit</button>
    <a href="{{ route('posts.show', $post->id) }}">Back</a>
</form>
