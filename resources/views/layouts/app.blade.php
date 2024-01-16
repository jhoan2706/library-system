<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Library Management System</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="#">
                <!-- Your logo (if any) can go here -->
                Library App
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <!-- Navbar items go here -->
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-primary" href="{{ route('register') }}">
                            <strong>Register</strong>
                        </a>
                        <a class="button is-light" href="{{ route('login') }}">
                            Log in
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container" id="app">
        @yield('content')
    </div>
    <!-- Footer -->
    <footer class="footer">
        <div class="content has-text-centered">
            <p>
                Your Library App &copy; {{ now()->year }}
            </p>
        </div>
    </footer>

    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>
