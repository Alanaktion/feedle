@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-3">{{ $exception->getMessage() ?: '500 Internal Server Error' }}</h1>
        <p class="lead">An error has occurred while generating this page. Try reloading the page or going back and trying again.</p>
    </div>
</div>
@endsection
