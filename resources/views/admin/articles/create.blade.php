@extends('admin.layouts.app')

{{-- Page title --}}
@section('title', 'Create New Article')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Create New Article</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Article Form
                </div>
                <div class="panel-body">
                    {!! Form::open([
                    'url' => '/admin/articles',
                    'files' => true
                    ]) !!}

                        @include('admin.articles.form')

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