<div class="col-lg-6">
    <h3 class="text-center text-danger"><b>Edit Photos</b> </h3>
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

                @if($post->music)
            {{-- Jika musik ada, tampilkan tombol hapus dan audio player --}}
            <form action="/deletemusic/{{ $post->music }}" method="post">
                @csrf
                @method('delete')
                <button class="btn text-danger">Hapus Musik</button>
            </form>

            {{-- Tampilkan audio player untuk musik yang ada --}}
            <audio controls>
                <source src="/music/{{ $post->music }}" type="audio/mpeg">
            </audio>

        @else
            {{-- Jika musik tidak ada, tampilkan form untuk menambah musik --}}
            <form action="/addmusic/{{ $post->id }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="music">Tambahkan Musik</label>
                    <input type="file" name="music" id="music" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Unggah Musik</button>
            </form>
        @endif


        @if (count($post->photos)>0)
        <p>Photos:</p>
        @foreach ($post->photos as $photo)
        <form action="/deletephoto/{{ $photo->id }}" method="post">
            <button class="btn text-danger">X</button>
            @csrf
            @method('delete')
            </form>
        <img src="/photos/{{ $photo->photo_path }}" class="img-responsive" style="max-height: 100px; max-width: 100px;" alt="" srcset="">
        @endforeach
        @endif

        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="photos">Photos:</label>
                <input type="file" name="photos[]" id="photos" multiple accept="image/*">
            </div>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" value="{{ $post->title }}" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control">{{ old('description', $post->description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-danger mt-3 ">Edit</button>
            </form>
    <a href="{{ route('posts.show', $post->id) }}">Back</a>

    </div>