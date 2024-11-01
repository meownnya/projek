<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memories</title>

    @stack('styles')
</head>

<body>
        <x-nav />
                
                @yield('content')

            <x-footer />                
            </div>
        </div>
    </div>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('/js/bootstrap.bundle.min.js')}}"></script> --}}

    @stack('scripts')
    
    {{-- <script src="{{ asset('/js/mazer.js')}}"></script> --}}
</body>

</html>
