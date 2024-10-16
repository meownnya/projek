<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Memories</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    {{-- <div class="header">
        <nav class="nav">
            <ul>
                <li class="nav-link">
                    <a href="{{ route('posts.index') }}">Memories</a>
                </li>
                <li class="nav-link">
                    <a href="{{ route('posts.create') }}">Add</a>
                </li>
            </ul>
        </nav>
    </div> --}}
        <h3 class="text-center text-danger">
            <a href="{{ route('posts.index') }}" class="btn btn-sm btn-primary mb-2">Memories</a>
            <a href="{{ route('posts.create') }}" class="btn btn-sm btn-primary mb-2">Add</a>
        </h3>
    
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
    
</body>
</html>
