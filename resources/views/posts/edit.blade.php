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

        @if (count($post->photos)>0)
        <p>Images:</p>
        @foreach ($post->photos as $photo)
        <form action="/deletephoto/{{ $photo->id }}" method="post">
            <button class="btn text-danger">X</button>
            @csrf
            @method('delete')
            </form>
        <img src="/photos/{{ $photo->photo_path }}" class="img-responsive" style="max-height: 100px; max-width: 100px;" alt="" srcset="">
        @endforeach
        @endif

    </div>