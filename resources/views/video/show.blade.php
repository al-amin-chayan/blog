@extends('layouts.app')

{{-- Page title --}}
@section('title', $title)

@section('content')
    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{ $video->title }}</h1>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted on: {{ $video->created_at->format('F d, Y h:A') }}</p>

    <hr>

    <div class="embed-responsive embed-responsive-4by3">
        @if($video->provider === 'F')
            <div class="fb-video embed-responsive-item"
                 data-href="{{ $video->source }}"
                 data-allowfullscreen="true"
                 data-autoplay="true"></div>
        @else
            <iframe class="embed-responsive-item" src="{{ $video->source }}?autoplay=0"
                    allowfullscreen></iframe>
        @endif
    </div>

    <hr>

    <!-- Post Content -->
    <p class="lead">{{ $video->summary }}</p>
    <hr>
    @if(count($video->tags) > 0)
    <strong>Tags:</strong>
    @foreach($video->tags as $tag)
        <a href="{{ url('/video/tag/' . $tag->id . '/' . $tag->slug) }}" class="label label-primary">{{ $tag->name }}</a>
    @endforeach
    @endif
    <hr>

    <!-- Blog Comments -->

    <!-- Comments Form -->
    <div class="well" id="comments">
        <h4>Leave a Comment:</h4>
        @if (Auth::check())
        {!! Form::open([
        'url' => '/video-comment'
        ]) !!}
        {{ Form::hidden('video_id', $video->id) }}
            <div class="form-group {{ $errors->has('details') ? 'has-error' : ''}}">
                {!! Form::textarea('details', null, ['class' => 'form-control', 'rows' => '3', 'required' => 'required']) !!}
                {!! $errors->first('details', '<p class="help-block">:message</p>') !!}
            </div>
            {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
        @else
            <a href="{{ url('admin/login') }}" role="button" class="btn btn-primary" target="_blank">Login to comment</a>
        @endif
    </div>

    <hr>
    @include('admin.layouts.alert')
    <!-- Posted Comments -->
    @if(count($video->comments) > 0)
        @foreach($video->comments as $comment)
            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    @if( $comment->user->profile->picture != '' && file_exists(public_path() . '/uploads/profile-picture/' . $comment->user->profile->picture))
                        @php $src = '/uploads/profile-picture/' . $comment->user->profile->picture @endphp
                    @else
                        @php $src = 'http://placehold.it/64x64' @endphp
                    @endif
                    <img class="media-object" src="{!! url($src) !!}" style="width: 64px; height: 64px;" alt="{{ $comment->user->name }}">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{ $comment->user->name }}
                        <small>{{ $comment->created_at->diffForHumans() }}</small>
                    </h4>
                    {{ $comment->details }}
                </div>
            </div>
        @endforeach
    @endif
    
@endsection
