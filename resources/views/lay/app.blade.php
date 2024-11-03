<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memories</title>
    <link rel="stylesheet" href="{{ asset('/css/index.css') }}">

    @stack('styles')
</head>

<body>
        <x-nav />
                
                @yield('content')

            <x-footer />                
            </div>
        </div>
    </div>

    @stack('scripts')
    
    <script src="{{ asset('/js/index.js') }}"></script>
</body>

</html>
