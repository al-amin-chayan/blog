@extends($layouts)

{{-- Page title --}}
@section('title', 'Add Video')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Video</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Video Add Form
                </div>
                <div class="panel-body">
                    {!! Form::open(['url' => '/admin/videos', 'class' => 'form-horizontal']) !!}

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