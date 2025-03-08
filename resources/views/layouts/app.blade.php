<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('assets/CSS/style.css') }}">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    {{-- jquert cdn --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" />
    <title>{{ $title }}</title>

    @yield('style')

</head>

<body>
    <header class="header">
        <!-- Logo -->
        <div class="logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('assets/images/Logo.png') }}" alt="Logo" />
            </a>
        </div>

        <!-- Right Section: Language Selector and Menu Toggle -->

        <div class="right-section">
            <!-- Menu Toggle -->
            <div class="menu-toggle" id="menu-toggle">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
            <!-- Language Selector (Dropdown) -->
            <div class="language-selector">
                <button class="dropdown-btn" id="language-btn">
                    <img id="current-flag" src="{{ asset('assets/images/usa.png') }}" alt="Language Flag" />
                </button>
                <div class="dropdown-content" id="language-menu">
                    <a href="#" data-flag="{{ asset('assets/images/usa.png') }}" data-lang="English">
                        <img src="{{ asset('assets/images/usa.png') }}" alt="English Flag" /> English
                    </a>
                    <a href="#" data-flag="{{ asset('assets/images/italian.png') }}" data-lang="Italian">
                        <img src="{{ asset('assets/images/italian.png') }}" alt="Italian Flag" />
                        Italian
                    </a>
                    <a href="#" data-flag="{{ asset('assets/images/Spanish.png') }}" data-lang="Spanish">
                        <img src="{{ asset('assets/images/Spanish.png') }}" alt="Spanish Flag" />
                        Spanish
                    </a>
                    <a href="#" data-flag="{{ asset('assets/images/French.png') }}" data-lang="French">
                        <img src="{{ asset('assets/images/French.png') }}" alt="French Flag" />
                        French
                    </a>
                    <a href="#" data-flag="{{ asset('assets/images/German.png') }}" data-lang="German">
                        <img src="{{ asset('assets/images/German.png') }}" alt="German Flag" />
                        German
                    </a>
                </div>
            </div>
        </div>
        <!-- Menu (Initially hidden) -->
        <nav id="menu" class="menu">
            <ul>
                <li><a href="./homepage.html">Home</a></li>
                <li><a href="./fees.html">Fees</a></li>
                <li><a href="./faq.html">FAQ</a></li>
                <li><a href="./contact-us.html">Contact</a></li>
            </ul>
        </nav>
    </header>

    @yield('content')
    <!-- Scroll to Top Button -->
    <button id="scrollToTopBtn" class="scroll-to-top">
        <img src="{{ asset('assets/images/up-arrow.png') }}" alt="Scroll to Top" width="40" height="40">
    </button>

    <!-- /*---------- footer ------------ */ -->
    <footer>
        <div class="footer-menu">
            <a class="footer-copy" href="#">Terms & Conditions</a>
            <ul>
                <li><a href="#">About</a></li>
                <li><a href="contact-us.html">Contact Us</a></li>
                <li><a href="fees.html">Fees</a></li>
            </ul>
            <ul>
                <li><a href="faq.html">FAQ</a></li>
                <li><a href="open_pos.html">Jobs</a></li>
                <li><a href="#">Impressum</a></li>
            </ul>
            <a class="footer-copy">Copyright 2025 by Oasipay</a>
        </div>
        <div class="footer-copy-text">
            <a href="#">Terms & Conditions</a>
            <a>Copyright 2025 by Oasipay</a>
        </div>
    </footer>

    <script src="{{ asset('assets/JS/main.js') }}"></script>
    @yield('script')

</body>

</html>
