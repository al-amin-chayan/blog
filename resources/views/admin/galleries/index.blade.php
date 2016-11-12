@extends($layouts)

{{-- Page title --}}
@section('title', 'Gallery List')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Gallery
                <a href="{{ url('/admin/galleries/create') }}" class="btn btn-primary btn-xs" title="Add New Gallery"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
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
                                <th> {{ trans('galleries.description') }} </th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $x=1; @endphp
                            @foreach($galleries as $item)
                                <tr class="{{ $x%2 == 0 ? 'even' : 'odd' }} gradeA">
                                    <td>{{ $x++ }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        <a href="{{ url('/admin/galleries/' . $item->id) }}" class="btn btn-success btn-xs" title="View Gallery"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                        <a href="{{ url('/admin/galleries/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs"
                                           title="Edit Gallery"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/admin/galleries', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Gallery" />', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-xs',
                                            'title' => 'Delete Gallery',
                                            'onclick'=>'return confirm("Are you sure you want to delete ' . $item->name . '?")'
                                        )) !!}
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