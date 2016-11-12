@extends($layouts)

{{-- Page title --}}
@section('title', 'Edit' . $video->title )

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit {{ $video->title }}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Video Edit Form
                </div>
                <div class="panel-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        @if($video->provider === 'F')
                            <div class="fb-video embed-responsive-item"
                                 data-href="{{ $video->source }}"
                                 data-allowfullscreen="true"></div>
                        @else
                            <iframe class="embed-responsive-item" src="{{ $video->source }}" allowfullscreen></iframe>
                        @endif
                    </div>

                    {!! Form::model($video, [
                        'method' => 'PATCH',
                        'url' => ['/admin/videos', $video->id],
                         'class' => 'form-horizontal'
                    ]) !!}

                    @include('admin.videos.form')

                    {!! Form::close() !!}
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection