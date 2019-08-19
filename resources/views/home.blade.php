@extends('layouts.app')

@section('content')
<app-nav
    app-name="{{ config('app.name', 'Feedle') }}"
    user-name="{{ Auth::user()->name }}"
></app-nav>
<app-reader></app-reader>
@include('blocks.toast-dom')
@endsection

@section('content-old')
@include('blocks.modal-add-feed')
@endsection
