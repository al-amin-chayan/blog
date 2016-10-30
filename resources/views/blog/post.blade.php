@extends('layouts.app')

{{-- Page title --}}
@section('title', $title)

@section('content')
    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{ $article->title }}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="{{ url('/user/' . $article->user->id) }}">{{ $article->user->name }}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted on: {{ $article->created_at->format('F d, Y h:A') }}</p>

    <hr>

    <!-- Preview Image -->
    @if( $article->image != '' && file_exists(public_path() . '/uploads/article-image/' . $article->image))
        <img src="{!! url('/uploads/article-image/' . $article->image) !!}" alt="article image" class="img-responsive" >
    @else
        <img class="img-responsive" src="http://placehold.it/900x300" alt="">
    @endif

    <hr>

    <!-- Post Content -->
    <p class="lead">{{ $article->summary }}</p>
    <p>{!! $article->details !!}</p>
    <hr>
    @if(count($article->tags) > 0)
    <strong>Tags:</strong>
    @foreach($article->tags as $tag)
        <a href="{{ url('/post/tag/' . $tag->id . '/' . $tag->slug) }}" class="label label-primary">{{ $tag->name }}</a>
    @endforeach
    @endif
    <hr>

    <!-- Blog Comments -->

    <!-- Comments Form -->
    <div class="well" id="comments">
        <h4>Leave a Comment:</h4>
        @if (Auth::check())
        {!! Form::open([
        'url' => '/article-comment'
        ]) !!}
        {{ Form::hidden('article_id', $article->id) }}
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
    @if(count($article->comments) > 0)
        @foreach($article->comments as $comment)
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
