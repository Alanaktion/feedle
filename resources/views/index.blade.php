@extends('layouts.public')

@section('content')
<div class="bg-gray-200 py-5 lg:py-6">
    <div class="container">
        <h1>Atom and RSS</h1>
        <p class="lead">Follow all your feeds, from anywhere.</p>
        <a href="{{ route('register') }}" class="btn btn-primary btn-lg lg:mt-3">Get Started</a>
    </div>
</div>
@endsection
