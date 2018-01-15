@extends('layouts.app')

@section('content')
<div class="reader">
    <div class="reader-list">
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
