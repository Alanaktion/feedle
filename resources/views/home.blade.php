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
                    <svg class="octicon octicon-plus" viewBox="0 0 12 16" version="1.1" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12 9H7v5H5V9H0V7h5V2h2v5h5z"></path>
                    </svg>
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
        <iframe src="about:blank" frameborder="0" class="reader-iframe d-none" name="reader" data-reader></iframe>
    </div>
</div>
@include('blocks.modal-add-feed')
@endsection
