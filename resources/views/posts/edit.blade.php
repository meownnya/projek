        @if (session('success'))
        <div>{{ session('success') }}</div>
        @endif
        
        <div class="col-lg-3">
        <p>Music:</p>
        <form action="{{ route('deletemusic', $post->id) }}" method="post">
        <button class="btn text-danger">X</button>
        @csrf
        @method('delete')
        </form>
        <audio controls>
        <source src="/music/{{ $post->music }}" class="img-responsive" style="max-height: 100px; max-width: 100px;" alt="" srcset="">
        </audio>
        <br>
        <p><label class="m-2">Music</label>
            <input type="file" id="music" class="form-control m-2" name="music" accept="audio/*">
        </p>



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


    <div class="col-lg-6">
        <h3 class="text-center text-danger"><b>Edit Post</b> </h3>
        <div class="form-group">
            <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method("put")
             <input type="text" name="title" class="form-control m-2" placeholder="title" value="{{ $post->title }}">
             <Textarea name="description" cols="20" rows="4" class="form-control m-2" placeholder="description">{{ $post->description }}</Textarea>

            <button type="submit" class="btn btn-danger mt-3 ">Edit</button>
            </form>
       </div>
    </div>

    <a href="{{ route('posts.show', $post->id) }}">Back</a>
