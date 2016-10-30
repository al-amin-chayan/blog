@extends('admin.layouts.app')

{{-- Page title --}}
@section('title', 'Create Subject')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Create Subject</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Subject Form
                </div>
                <div class="panel-body">
                    {!! Form::open(['url' => '/admin/subjects', 'class' => 'form-horizontal']) !!}

                    @include('admin.subjects.form')

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