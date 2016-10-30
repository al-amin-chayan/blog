@extends('admin.layouts.app')

{{-- Page title --}}
@section('title', 'Edit' . $subject->name )

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit {{ $subject->name }}</h1>
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
                    {!! Form::model($subject, [
                    'method' => 'PATCH',
                    'url' => ['/admin/subjects', $subject->id],
                    'class' => 'form-horizontal'
                    ]) !!}

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