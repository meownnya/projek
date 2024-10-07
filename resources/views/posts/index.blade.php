<div class="py-4">
    <h3 class="fw-bold mb-2 pb-2 border-bottom">Memories</h3>
        <a href="{{ route('posts.create') }}" class="btn btn-sm btn-primary mb-2">Add</a>
</div>

@foreach ($posts as $post)
    <div>
        <a href="{{ route('posts.show', $post->id) }}">
            <img src="{{ asset('storage/' .$post->photos->first()->photo_path ) }}" alt="{{ $post->title }}">
        </a>
        <h2>{{ $post->title }}</h2>
    </div>
@endforeach
