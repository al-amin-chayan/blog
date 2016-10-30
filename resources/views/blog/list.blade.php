@extends('layouts.app')

{{-- Page title --}}
@section('title', $title)

@section('content')
    <h1 class="page-header">
        {{ $title }}
        <small>{{ $sub_title or '' }}</small>
    </h1>
    @foreach($articles as $article)

    <!-- First Blog Post -->
    <h2>
        <a href="{{ url('/post/' . $article->id . '/' . $article->slug) }}">{{ $article->title }}</a>
    </h2>
    <p class="lead">
        by <a href="{{ url('/user/' . $article->user->id) }}">{{ $article->user->name }}</a>
    </p>
    <p><span class="glyphicon glyphicon-time"></span> Posted on: {{ $article->created_at->format('F d, Y h:iA') }}</p>
    <hr>

    @if( $article->image != '' && file_exists(public_path() . '/uploads/article-image/' . $article->image))
        <img src="{!! url('/uploads/article-image/' . $article->image) !!}" alt="article image" class="img-responsive" >
        @else
        <img class="img-responsive" src="http://placehold.it/900x300" alt="">
    @endif

    <hr>
    <p>{{ $article->summary }}</p>
    <a class="btn btn-primary" href="{{ url('/post/' . $article->id . '/' . $article->slug) }}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

    <hr>

    @endforeach

    <!-- Pager -->
    <div class="text-center"> {!! $articles->render() !!} </div>
@endsection
