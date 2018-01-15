@extends('layouts.public')

@section('content')
<div class="jumbotron jumobtron-fluid">
    <div class="container">
        <h1 class="display-4">Atom and RSS</h1>
        <p class="lead">Follow as many feeds as you want with ease</p>
        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Get Started</a>
    </div>
</div>
@endsection
