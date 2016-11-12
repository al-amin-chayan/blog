@extends($layouts)

{{-- Page title --}}
@section('title', 'Edit' . $gallery->name )

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit {{ $gallery->name }}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Gallery Edit Form
                </div>
                <div class="panel-body">
                    {!! Form::model($gallery, [
                        'method' => 'PATCH',
                        'url' => ['/admin/galleries', $gallery->id],
                        'class' => 'form-horizontal'
                    ]) !!}

                    @include('admin.galleries.form')

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