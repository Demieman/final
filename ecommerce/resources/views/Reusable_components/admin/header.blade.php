<!-- ======= Header ======= -->
<header id="header">
    <div class="container d-flex">
        <div class="logo mr-auto">
            <a href="/"><img src="{{ asset('assets/img/Logo.webp') }}" alt="" class="img-fluid"></a>
        </div>
        <p class="mobile-nav-toggle"><i class="fas fa-bars"></i></p>
        <nav class="nav-menu d-none d-lg-block contentfont">
            <ul style="margin-top:5px">
                <li class="active"><a href="/">Home</a></li>
                <li><a href="/#about">About</a></li>
                <li><a href="/#Startups">Products</a></li>
                <li><a href="/#Startups">Team</a></li>
                <li><a href="/#Startups"><i class="fas fa-headset"></i> Help</a></li>

                @if (Route::has('login'))
                    @auth
                    <li class="drop-down"><a href="#">Dashboard <i class="fas fa-angle-down"></i></a>
                        <ul>
                            <li><a href="{{ url('admin-all-users') }}">Registered Users</a></li>
                            <li><a href="{{ url('admin-Orders') }}">Orders</a></li>
                            <li><a href="{{ url('admin-Transactions') }}">Transaction Details</a></li>
                            <li><a href="{{ url('admin-products') }}">Products</a></li>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                    @if (Route::has('register'))
                    <li><a href="{{ route('register') }}">Register</a></li>
                    @endif
                    @endauth
                @endif

                <li><a href="/#Startups" style="margin-left:15px;"><i class="fas fa-shopping-cart fa-2x"></i></a></li>
            </ul>
        </nav><!-- .nav-menu -->
    </div>
</header><!-- End Header -->

<style>
    /* ======= Header Styles ======= */
    #header {
        background: #343a40; /* Dark background for the header */
        padding: 15px 0; /* Vertical padding */
        position: sticky; /* Sticky positioning */
        top: 0; /* Stick to the top */
        z-index: 1000; /* Ensure it stays above other content */
    }

    .container {
        display: flex;
        justify-content: space-between;
        align-items: center; /* Center items vertically */
    }

    .logo img {
        max-height: 60px; /* Set a max height for the logo */
    }

    .nav-menu {
        display: flex;
        align-items: center; /* Center items vertically */
    }

    .nav-menu ul {
        list-style: none; /* Remove bullet points */
        padding: 0;
        margin: 0; /* Reset default margins */
        display: flex; /* Flexbox for horizontal layout */
    }

    .nav-menu li {
        margin: 0 15px; /* Space between menu items */
    }

    .nav-menu a {
        color: #ffffff; /* White text color */
        text-decoration: none; /* Remove underline */
        font-size: 16px; /* Font size for links */
        transition: color 0.3s; /* Smooth color transition */
    }

    .nav-menu a:hover {
        color: #ffcc00; /* Change color on hover */
    }

    .mobile-nav-toggle {
        display: none; /* Hide mobile toggle by default */
        color: #ffffff;
        font-size: 24px; /* Font size for the toggle icon */
    }

    .drop-down > ul {
        display: none; /* Hide dropdown by default */
        position: absolute; /* Position dropdown */
        background: #343a40; /* Match header background */
        margin-top: 10px; /* Space below the dropdown */
        padding: 10px 0; /* Padding for dropdown items */
        border-radius: 4px; /* Rounded corners */
    }

    .drop-down:hover > ul {
        display: block; /* Show dropdown on hover */
    }

    .drop-down li {
        padding: 5px 20px; /* Padding for dropdown items */
    }

    .drop-down a {
        color: #ffffff; /* White text for dropdown */
    }

    .drop-down a:hover {
        background: #ffcc00; /* Background on hover for dropdown */
        color: #343a40; /* Dark text on hover */
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .mobile-nav-toggle {
            display: block; /* Show mobile toggle on small screens */
        }

        .nav-menu {
            display: none; /* Hide menu by default */
            flex-direction: column; /* Stack menu items vertically */
            position: absolute; /* Position menu */
            top: 60px; /* Position below header */
            left: 0;
            right: 0;
            background: #343a40; /* Match header background */
        }

        .nav-menu.active {
            display: flex; /* Show menu when active */
        }

        .nav-menu li {
            margin: 10px 0; /* Space between vertical menu items */
        }
    }
</style>
