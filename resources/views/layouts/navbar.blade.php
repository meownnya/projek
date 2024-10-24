<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Memories</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> 
</head>
<body>
    <div class="menu">
        <ol>
            <li>
                <a href="{{ route('posts.index')}}" class="{{ request()->is('/') ? 'active' : '' }}">
                    <i class="bi bi-camera icon"></i> MEMORIES
                </a>
            </li>
            
            <li>
                <a href="{{ route('posts.index') }}" class="{{ request()->is('posts') ? 'active' : '' }}">Home</a>
            </li>
            <li>
                <a href="{{ route('folders.index') }}" class="{{ request()->is('folders') ? 'active' : '' }}">Folders</a>
            </li>
            <li>
                <form action="{{ route('search') }}" method="GET">
                    <input type="text" name="query" placeholder="Search..." value="{{ request('query') }}">
                    <button type="submit">Search</button>
                </form>
            </li>
            <li>
                <a href="#" role="button" aria-expanded="false" class="{{ request()->is('create') ? 'active' : '' }}">
                    <i class="bi bi-plus icon"></i> Create
                </a>                
                <ul class="sub-menu">
                    <li><a href="{{ route('posts.create') }}">Memories</a></li>
                    <li><a href="{{ route('folders.create') }}">Folders</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="{{ request()->is('account') ? 'active' : '' }}">Account</a>
            </li>
        </ol>
    </div>
    

    @yield('content')
</body>
</html>
