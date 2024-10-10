<div class="py-4">
    <h3 class="fw-bold mb-2 pb-2 border-bottom">Memories</h3>
        <a href="{{ route('posts.create') }}" class="btn btn-sm btn-primary mb-2">Add</a>

        @if (session('success'))
        <div>{{ session('success') }}</div>
        @endif
</div>

@foreach ($post as $item)
    <div>
        <a href="{{ route('posts.show', $item->id) }}">
            <img src="{{ asset('storage/photos/' .$item->photo_path) }}" alt="{{ $item->title }}">
        </a>
        <h2>{{ $item->title }}</h2>
    </div>
@endforeach
