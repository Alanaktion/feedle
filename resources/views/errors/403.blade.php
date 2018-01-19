@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-3">{{ $exception->getMessage() ?: '403 Not Authorized' }}</h1>
        <p class="lead">You do not have access to this page.</p>
    </div>
</div>
@endsection
