<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login & Signup Form</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <style>
      body {
        background: url("{{ asset('/images/LogoMemories.png') }}") center center /
        cover no-repeat;
      }
    </style>
</head>
<body>
    <section class="wrapper">
        <div class="form signup">
            <header>Signup</header>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <input type="text" name="name" placeholder="Full name" required />
                <input type="email" name="email" placeholder="Email address" required />
                <input type="password" name="password" placeholder="Password" required />
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required />
                <input type="submit" value="Signup" />
            </form>
        </div>

        <div class="form login">
            <header>Login</header>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <input type="email" name="email" placeholder="Email address" required />
                <input type="password" name="password" placeholder="Password" required />
                <input type="submit" value="Login" />
            </form>
        </div>
    </section>

    <script src="{{ asset('js/login.js') }}"> </script>
</body>
</html>
