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
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
            <div class="container-fluid">
            <a class="navbar-brand" href="#">MEMORIES</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('posts.index') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('folders.index') }}">Folders</a>
                </li>

                <li class="search">
                    <a>
                       <!-- Form Pencarian -->
                    <form action="{{ route('search') }}" method="GET" class="mb-4">
                        <input type="text" name="query" placeholder="Search..." value="{{ request('query') }}">
                        <button type="submit" class="btn btn-sm btn-primary">Search</button>
                    </form>

                </a>
                    
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Create
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{ route('posts.create') }}">Memories</a></li>
                      <li><a class="dropdown-item" href="{{ route('folders.create') }}">Folders</a></li>
                    </ul>
                  </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Account</a>
                </li>

                </ul>
            </div>
            </div>
        </nav>

        <div class="container">
            @yield('content')
            </div>
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    
            @stack('scripts')
    
        </body>
        </html>