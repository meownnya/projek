{{-- <div class="col-lg-6">
    <h3 class="text-center text-danger"><b>Edit Photos</b> </h3>
    <div class="form-group">        
        
        @if (session('success'))
        <div>{{ session('success') }}</div>
        @endif

         @if (count($post->photos)>0)
         <p>Photos:</p>
         @foreach ($post->photos as $photo)
         <form action="{{ route('deletephoto', $photo->id) }}" method="post">
             <button class="btn text-danger">X</button>
             @csrf
             @method('delete')
             </form>
         <img src="/photos/{{ $photo->photo_path }}" class="img-responsive" style="max-height: 100px; max-width: 100px;" alt="" srcset="">
         @endforeach
         @endif

         <p><label class="m-2">Photos:</label>
            <input type="file" id="photos" class="form-control m-2" name="photos[]" multiple>
        </p>

    </div>

            <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method("put")
             <input type="text" name="title" class="form-control m-2" placeholder="title" value="{{ $post->title }}">
             <Textarea name="description" cols="20" rows="4" class="form-control m-2" placeholder="description">{{ $post->description }}</Textarea>

            <button type="submit" class="btn btn-danger mt-3 ">Edit</button>
            </form>
       </div>
    </div>

    <a href="{{ route('posts.show', $post->id) }}">Back</a> --}}

<div class="container">
    <h1>Edit Post</h1>

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Judul Post -->
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
        </div>

        <!-- Deskripsi Post -->
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" required>{{ $post->description }}</textarea>
        </div>

        <!-- Opsi Menambahkan Gambar -->

        
        <div class="form-group">
            <label for="photos">Add Photos:</label>
            <input type="file" name="photos[]" id="photos" class="form-control" multiple>
        </div>

        <!-- Opsi Menambahkan/Mengganti Musik -->
        @if(!$post->music)
            <!-- Jika Musik Kosong, Tampilkan Opsi Menambah Musik -->
            <div class="form-group">
                <label for="music">Add Music:</label>
                <input type="file" name="music" id="music" class="form-control" accept="audio/*">
            </div>
        @else
            <!-- Jika Musik Sudah Ada, Tampilkan Opsi Gambar Saja -->
            <div class="form-group">
                <p>Music already exists: {{ $post->music }}</p>
                <a href="{{ route('deletemusic', $post->id) }}" class="btn btn-danger">Delete Music</a>
            </div>
        @endif

        <!-- Tombol Simpan Perubahan -->
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
<a href="{{ route('posts.show', $post->id) }}">Back</a>