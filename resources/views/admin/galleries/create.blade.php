@extends('admin.layouts.app')

{{-- Page title --}}
@section('title', 'Add Gallery')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add Gallery</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Gallery Add Form
                </div>
                <div class="panel-body">
                    {!! Form::open(['url' => '/admin/galleries', 'class' => 'form-horizontal']) !!}

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