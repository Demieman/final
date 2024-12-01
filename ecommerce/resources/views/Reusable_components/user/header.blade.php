<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Header Example</title>
    <style>
        /* ======= Header Styles ======= */
        #header {
            position: fixed;
            top: 0;
            width: 100%;
            font-family: 'Balsamiq Sans', cursive;
            background: #ffffff; /* White background */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            z-index: 1000; /* Ensure it stays above other content */
        }

        .container {
            display: flex;
            align-items: center; /* Center items vertically */
            padding: 15px; /* Padding around the container */
        }

        #Gainaloe_Logo {
            margin-left: -75px; /* Adjust logo position */
        }

        .logo img {
            max-height: 60px; /* Set a max height for the logo */
        }

        .input-group {
            width: 100%; /* Full width for the search input */
        }

        .form-control {
            border: 1px solid #ced4da; /* Light border */
            border-radius: 0; /* Remove border radius */
            padding: 10px; /* Padding inside the input */
        }

        .red-border {
            border: 2px solid #dc3545; /* Red border for focus */
        }

        .input-group-append {
            cursor: pointer; /* Pointer cursor for the search icon */
        }

        #SearchIcon:hover {
            color: #dc3545; /* Change color on hover */
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
            color: #343a40; /* Dark text color */
            text-decoration: none; /* Remove underline */
            font-size: 16px; /* Font size for links */
            transition: color 0.3s; /* Smooth color transition */
        }

        .nav-menu a:hover {
            color: #dc3545; /* Change color on hover */
        }

        .drop-down > ul {
            display: none; /* Hide dropdown by default */
            position: absolute; /* Position dropdown */
            background: #ffffff; /* Match background */
            margin-top: 10px; /* Space below the dropdown */
            padding: 10px 0; /* Padding for dropdown items */
            border: 1px solid #ced4da; /* Light border for dropdown */
            border-radius: 4px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        .drop-down:hover > ul {
            display: block; /* Show dropdown on hover */
        }

        .drop-down li {
            padding: 5px 20px; /* Padding for dropdown items */
        }

        .drop-down a {
            color: #343a40; /* Dark text for dropdown */
        }

        .drop-down a:hover {
            background: #f8f9fa; /* Light background on hover for dropdown */
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
                background: #ffffff; /* Match header background */
            }

            .nav-menu.active {
                display: flex; /* Show menu when active */
            }

            .nav-menu li {
                margin: 10px 0; /* Space between vertical menu items */
            }
        }
    </style>
</head>
<body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function (){
    $('#SearchIcon').click(function (e)
    {
        var searchstring = $('.searchstring').val();
        if (searchstring == '') {
            window.location.replace("/");
        } else {
            window.location.replace("/Shop/" + searchstring);
        }
    });
});
</script>

<!-- ======= Header ======= -->
<header id="header" class="z-depth-1">
    <div class="container d-flex">
        <div id="Gainaloe_Logo" class="logo mr-auto">
            <a href="/"><img src="{{ asset('assets/img/Logo.webp') }}" alt="" class="img-fluid"></a>
        </div>
        <div class="col-md-4">
            <div class="input-group md-form form-sm">
                <input class="form-control my-0 py-1 red-border searchstring" list="plists" name="plist" id="plist" type="text" placeholder="Search" aria-label="Search">
                <datalist id="plists">
                    @php
                       $Products = App\Models\Products::where('status', '=', '1')->get();
                    @endphp
                    @foreach($Products as $item)
                        <option value="{{$item->url}}">{{$item->name}}</option>
                    @endforeach
                </datalist>
                <div class="input-group-append" id="SearchIcon">
                    <span class="input-group-text lighten-3" id="basic-text1"><i class="fas fa-search text-grey" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
        <p class="mobile-nav-toggle"><i class="fas fa-bars"></i></p>
        <nav class="nav-menu d-none d-lg-block contentfont">
            <ul style="margin-top:5px;">
                <li class="active"><a href="/">Home</a></li>
                <li><a href="/#About">About</a></li>
                <li><a href="/#Products">Products</a></li>
                <li><a href="/#Team">Team</a></li>
                <li><a href="{{ url('Help') }}"><i class="fas fa-headset"></i> Help</a></li>

                @if (Route::has('login'))
                    @auth
                    <li class="drop-down"><a href="#"><i class="far fa-user-circle"></i> My Account <i class="fas fa-angle-down"></i></a>
                        <ul>
                            <li><a href="{{ url('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                            <li><a href="{{ url('profile') }}"><i class="fas fa-user"></i> Profile</a></li>
                            <li><a href="{{ url('Orders') }}"><i class="fas fa-table"></i> Orders</a></li>
                            <li><a href="{{ url('Payments') }}"><i class="fas fa-receipt"></i> Transactions</a></li>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-in-alt"></i> {{ __('Logout') }}</a>
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

                <li><a href="{{ url('cart') }}" style="margin-left:15px;">
                    <i class="fas fa-shopping-cart fa-2x"></i>
                    <span class="basket-item-count" style="margin-left:-4px;">
                        <span class="badge badge-pill red">{{ count((array) session('cart')) }}</span>
                    </span></a>
                </li>
            </ul>
        </nav><!-- .nav-menu -->
    </div>
</header><!-- End Header -->

<br><br><br>

</body>
</html>
