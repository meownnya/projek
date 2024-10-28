<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Memories</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navig.css') }}">

</head>
<body>
    <div class="menu">
        <div class="hamburger" id="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <ol>
            <li>
                <a href="{{ route('posts.index')}}" class="{{ request()->is('/') ? 'active' : '' }}">
                    <i class="bi bi-box2-heart-fill"></i>
                </a>
            </li>
            <li>
                <a href="{{ route('posts.index') }}" class="{{ request()->is('posts') ? 'active' : '' }}">Memories</a>
            </li>
            <li>
                <a href="{{ route('folders.index') }}" class="{{ request()->is('folders') ? 'active' : '' }}">Folders</a>
            </li>
            <li>
                <form action="{{ route('search') }}" method="GET">
                    <i class="bi bi-search icon"></i>
                    <input type="text" name="query" placeholder="Search..." value="{{ request('query') }}">
                    <button type="submit">Search</button>
                </form>
            </li>
            <li class="dropdown">
                <a href="#" class="{{ request()->is('create') ? 'active' : '' }}" id="create-toggle">
                    <i class="bi bi-plus icon"></i> Create
                </a>
                <ul class="sub-menu" id="create-menu">
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

    <script>
        document.getElementById('hamburger').addEventListener('click', function() {
            document.querySelector('.menu').classList.toggle('active');
        });
    </script>
</body>
</html>
