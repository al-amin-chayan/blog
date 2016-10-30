@extends('layouts.app')

{{-- Page title --}}
@section('title', $title)

@section('content')
    <h1 class="page-header">
        {{ $title }}
        <small>{{ $sub_title or '' }}</small>
    </h1>
    @foreach($videos as $video)

    <h2>
        <a href="{{ url('/video/' . $video->id) }}">{{ $video->title }}</a>
    </h2>
    <p><span class="glyphicon glyphicon-time"></span> Posted on: {{ $video->created_at->format('F d, Y h:iA') }}</p>
    <hr>
    <div class="embed-responsive embed-responsive-16by9">
        @if($video->provider === 'F')
            <div class="fb-video embed-responsive-item"
                 data-href="{{ $video->source }}"
                 data-allowfullscreen="true"></div>
        @else
            <iframe class="embed-responsive-item" src="{{ $video->source }}" allowfullscreen></iframe>
        @endif
    </div>
    <hr>
    <a class="btn btn-primary" href="{{ url('/video/' . $video->id) }}">Details <span class="glyphicon glyphicon-chevron-right"></span></a>

    <hr>

    @endforeach

    <!-- Pager -->
    <div class="text-center"> {!! $videos->render() !!} </div>
@endsection
