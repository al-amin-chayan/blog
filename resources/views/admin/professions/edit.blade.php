@extends($layouts)

{{-- Page title --}}
@section('title', 'Edit' . $profession->name )

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit {{ $profession->name }}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit Profession
                </div>
                <div class="panel-body">
                    {!! Form::open([
                    'method' => 'PATCH',
                    'url' => ['/admin/professions', $profession->id],
                    'class' => 'form-horizontal'
                    ]) !!}

                    @include('admin.professions.form')

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