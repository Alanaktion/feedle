@extends('layouts.app')

@section('content')
<app-nav
    app-name="{{ config('app.name', 'Feedle') }}"
    user-name="{{ Auth::user()->name }}"
></app-nav>
<app-reader></app-reader>
@endsection
