@extends('layouts.app')

@section('content')
<div class="reader">
    <div class="reader-list">
        <div class="d-flex p-3">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="#posts" id="tab-posts"
                        data-toggle="tab" role="tab" aria-controls="posts" aria-selected="true">
                        Posts
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#feeds" id="tab-feeds"
                        data-toggle="tab" role="tab" aria-controls="feeds" aria-selected="false">
                        Feeds
                    </a>
                </li>
            </ul>
            <div class="ml-auto">
                <button type="button" class="btn btn-secondary" title="Add Feed" aria-label="Add Feed"
                    data-hover="tooltip" data-toggle="modal" data-target="#mdl-add-feed">
                    <span aria-hidden="true">+</span>
                </button>
            </div>
        </div>
        <div class="tab-content px-3">
            <div class="tab-pane active" id="posts" role="tabpanel" aria-labelledby="tab-posts">
                @include('blocks.post-list')
            </div>
            <div class="tab-pane" id="feeds" role="tabpanel" aria-labelledby="tab-feeds">
                @include('blocks.feed-list')
            </div>
        </div>
    </div>
    <div class="reader-content">
        {{-- Post content --}}
        <p class="text-muted text-center mt-5" data-reader-placeholder>
            Select a post on the left to start reading.
        </p>
        <iframe src="about:blank" frameborder="0" class="reader-iframe invisible" name="reader" data-reader></iframe>
    </div>
</div>
@include('blocks.modal-add-feed')
@endsection
