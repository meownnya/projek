<div class="py-4">
    <h3 class="fw-bold mb-2 pb-2 border-bottom">Memories</h3>
        <a href="{{ route('posts.create') }}" class="btn btn-sm btn-primary mb-2">Add</a>

        @if (session('success'))
        <div>{{ session('success') }}</div>
        @endif
</div>

@foreach ($posts as $post)
        <a href="{{ route('posts.show', $post->id) }}">
            <img src="/photos/{{ $post->photos->first()->photo_path }}"  class="border p-2 m-3" style="width: 200px;" alt="{{ $post->title }}">
        </a>
        <h2>{{ $post->title }}</h2>
@endforeach
