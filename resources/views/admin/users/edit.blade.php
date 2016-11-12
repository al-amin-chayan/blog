@extends($layouts)

{{-- Page title --}}
@section('title', 'Edit' . $user->name )

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit {{ $user->name }}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit user
                </div>
                <div class="panel-body">
                    {!! Form::open([
                    'method' => 'PATCH',
                    'url' => ['/admin/users', $user->id],
                    'class' => 'form-horizontal'
                    ]) !!}

                    @include('admin.users.form')

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