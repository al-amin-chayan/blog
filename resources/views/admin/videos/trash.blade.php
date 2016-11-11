@extends('admin.layouts.app')

{{-- Page title --}}
@section('title', 'Deleted Video')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Deleted Video</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Video List
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        @include('admin.layouts.alert')
                        <table class="table table-striped table-bordered table-hover" id="dataTables">
                            <thead>
                            <tr>
                                <th>S.No</th>
                                <th> Videos </th>
                                <th> {{ trans('videos.title') }} </th>
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
                            @foreach($videos as $item)
                                {{-- */$x++;/* --}}
                                <tr class="{{ $x%2 == 0 ? 'even' : 'odd'}} gradeA">
                                    <td>{{ $x }}</td>
                                    <td>
                                        <div class="embed-responsive embed-responsive-16by9">
                                            @if($item->provider === 'F')
                                                <div class="fb-video embed-responsive-item"
                                                     data-href="{{ $item->source }}"
                                                     data-allowfullscreen="true"></div>
                                            @else
                                                <iframe class="embed-responsive-item" src="{{ $item->source }}" allowfullscreen></iframe>
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->creator->name }}</td>
                                    <td>{{ $item->remover->name }}</td>
                                    <td>{{ $item->created_at->toDayDateTimeString() }}</td>
                                    <td>{{ $item->updated_at->format('M j, Y, g:ia') }}</td>
                                    <td>{{ $item->deleted_at->diffForHumans() }}</td>
                                    <td>
                                        {!! Form::open([
                                            'url' => ['/admin/videos/restore', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<span class="fa fa-undo" aria-hidden="true" title="Restore Tag" />', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-primary btn-xs',
                                                'title' => 'Restore Subject',
                                                'onclick'=>'return confirm("Are you sure you want to Restore ' . $item->title . '?")'
                                        ))!!}
                                        {!! Form::close() !!}

                                        {!! Form::open([
                                            'url' => ['/admin/videos/clean', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-remove" aria-hidden="true" title="Delete Tag" />', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-xs',
                                                'title' => 'Delete Subject',
                                                'onclick'=>'return confirm("Are you sure you want to delete ' . $item->title . '?")'
                                        ))!!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination"> {!! $videos->render() !!} </div>
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