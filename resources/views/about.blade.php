@extends('layouts.app')

@section('title', 'About Us')

@section('content')
    <header>
        <h1>About Us</h1>
    </header>

    <section class="about-section">
        <img src="{{ asset('images/jj.png') }}" alt="Your Name" class="profile-image">
        <img src="{{ asset('images/demie.JPG') }}" alt="Your Name" class="profile-image">
        <h2>E-commerce</h2>
        <p>Email: <a href="mailto:demelashasires4@gmail.com">demelashasires4@gmail.com</a></p>
        <p>This is the about page where you can learn more about us.</p>
        <p>We are a team of dedicated individuals committed to providing the best service possible.</p>
    </section>

    <footer>
        <p>&copy; {{ date('Y-m-d') }} wollo university(KIOT). All rights reserved.</p>
    </footer>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        .about-section {
            text-align: center;
            margin: 20px 0;
        }

        .profile-image {
            width: 200px; /* Adjust the size as needed */
            height: auto;
            border-radius: 100% /* Makes the image round */
            margin-bottom: 20px;
        }

        footer {
            text-align: center;
            margin-top: 40px;
            font-size: 0.9em;
            color: #555;
        }
    </style>
@endsection