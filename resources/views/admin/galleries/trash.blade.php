@extends('admin.layouts.app')

{{-- Page title --}}
@section('title', 'Deleted Gallery')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Deleted Gallery</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Gallery List
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        @include('admin.layouts.alert')
                        <table class="table table-striped table-bordered table-hover" id="dataTables">
                            <thead>
                            <tr>
                                <th>S.No</th>
                                <th> {{ trans('galleries.name') }} </th>
                                <th> {{ trans('common.created_by') }} </th>
                                <th> {{ trans('common.deleted_by') }} </th>
                                <th> {{ trans('common.created_at') }} </th>
                                <th> {{ trans('common.updated_at') }} </th>
                                <th> {{ trans('common.deleted_at') }} </th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{-- */$x=0;/* --}}
                            @foreach($galleries as $item)
                                {{-- */$x++;/* --}}
                                <tr class="{{ $x%2 == 0 ? 'even' : 'odd'}} gradeA">
                                    <td>{{ $x }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->creator->name }}</td>
                                    <td>{{ $item->remover->name }}</td>
                                    <td>{{ $item->created_at->toDayDateTimeString() }}</td>
                                    <td>{{ $item->updated_at->format('M j, Y, g:ia') }}</td>
                                    <td>{{ $item->deleted_at->diffForHumans() }}</td>
                                    <td>
                                        {!! Form::open([
                                            'url' => ['/admin/galleries/restore', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<span class="fa fa-undo" aria-hidden="true" title="Restore Tag" />', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-primary btn-xs',
                                                'title' => 'Restore Gallery',
                                                'onclick'=>'return confirm("Are you sure you want to Restore ' . $item->name . '?")'
                                        ))!!}
                                        {!! Form::close() !!}

                                        {!! Form::open([
                                            'url' => ['/admin/galleries/clean', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-remove" aria-hidden="true" title="Delete Tag" />', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-xs',
                                                'title' => 'Delete Gallery',
                                                'onclick'=>'return confirm("Are you sure you want to delete ' . $item->name . '?")'
                                        ))!!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination"> {!! $galleries->render() !!} </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection