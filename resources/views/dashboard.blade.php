@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dashboard</h2>
    <p>Welcome, {{ auth()->user()->name }}!</p>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <a class="btn btn-danger" href="{{ route('logout') }}" 
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
       Logout
    </a>
</div>
@endsection