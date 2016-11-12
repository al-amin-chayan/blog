@extends($layouts)

{{-- Page title --}}
@section('title', 'Article List')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Deleted Article</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Article List
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    @include('admin.layouts.alert')
                    <table class="table table-striped table-bordered table-hover" id="dataTables">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th> {{ trans('articles.subject_id') }} </th>
                                <th> {{ trans('articles.title') }} </th>
                                <th> {{ trans('articles.user_id') }} </th>
                                <th> {{ trans('common.created_at') }} </th>
                                <th> {{ trans('common.updated_at') }} </th>
                                <th> {{ trans('common.deleted_at') }} </th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $x=1; @endphp
                            @foreach($articles as $item)
                            <tr>
                                <td>{{ $x++ }}</td>
                                <td>{{ $item->subject->name }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->created_at->toDayDateTimeString() }}</td>
                                <td>{{ $item->updated_at->format('M j, Y, g:ia') }}</td>
                                <td>{{ $item->deleted_at->diffForHumans() }}</td>
                                <td>
                                    {!! Form::open([
                                            'url' => ['/admin/articles/restore', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                    {!! Form::button('<span class="fa fa-undo" aria-hidden="true" title="Restore Article" />', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-primary btn-xs',
                                            'title' => 'Restore Article',
                                            'onclick'=>'return confirm("Are you sure you want to Restore ' . $item->title . '?")'
                                    ))!!}
                                    {!! Form::close() !!}

                                    {!! Form::open([
                                        'url' => ['/admin/articles/clean', $item->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                    {!! Form::button('<span class="glyphicon glyphicon-remove" aria-hidden="true" title="Delete Article" />', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-xs',
                                            'title' => 'Delete Article',
                                            'onclick'=>'return confirm("Are you sure you want to delete ' . $item->title . '?")'
                                    ))!!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination"> {!! $articles->render() !!} </div>
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
