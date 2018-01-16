@extends('layouts.app')

@section('content')
<div class="reader">
    <div class="reader-list">
        <nav class="navbar navbar-expand navbar-dark">
            <span class="navbar-text">
                My Feeds
            </span>
            <div class="ml-auto">
                <button class="btn btn-secondary" title="Add Feed" data-toggle="tooltip">
                    <span class="sr-only">Add Feed</span>
                    <span aria-hidden="true">+</span>
                </button>
            </div>
        </nav>

        {{-- List of recent posts here --}}
    </div>
    <div class="reader-content">
        {{-- Post content --}}
        <p class="text-muted text-center mt-5">
            Select a post on the left to start reading.
        </p>
    </div>
</div>
@endsection
