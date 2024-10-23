    @extends('layouts.app')

    @section('content')

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <!-- Tampilkan Postingan -->
    @if ($posts->count() > 0)
        @foreach ($posts as $post)
            <a href="{{ route('posts.show', $post->id) }}">
                <img src="{{ asset('/storage/uploads/photos/' . $post->photos->first()->photo_path) }}" 
                     class="border p-2 m-3" 
                     style="width: 200px;" 
                     alt="{{ $post->title }}">
            </a>
            <h2>{{ $post->title }}</h2>
        @endforeach
    @else
        <p>No posts found.</p>
    @endif

@endsection
