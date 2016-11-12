@extends($layouts)

{{-- Page title --}}
@section('title', 'Article List')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Articles
            <a href="{{ url('/admin/articles/create') }}" class="btn btn-primary btn-xs" title="Add New Article"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
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
                                <th> {{ trans('articles.sub_title') }} </th>
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
                                <td>{{ $item->sub_title }}</td>
                                <td>
                                    <a href="{{ url('/admin/articles/' . $item->id) }}" class="btn btn-success btn-xs" title="View Article"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                    <a href="{{ url('/admin/articles/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Article"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                    {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['/admin/articles', $item->id],
                                    'style' => 'display:inline'
                                    ]) !!}
                                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Article" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Article',
                                    'onclick'=>'return confirm("Confirm delete?")'
                                    ));!!}
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
