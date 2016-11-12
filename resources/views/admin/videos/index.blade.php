@extends($layouts)

{{-- Page title --}}
@section('title', 'Video List')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Video
                <a href="{{ url('/admin/videos/create') }}" class="btn btn-primary btn-xs" title="Add New Video"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
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
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $x=1; @endphp
                            @foreach($videos as $item)
                                <tr class="{{ $x%2 == 0 ? 'even' : 'odd'}} gradeA">
                                    <td>{{ $x++ }}</td>
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
                                    <td>
                                        <a href="{{ url('/admin/videos/' . $item->id) }}" class="btn btn-success btn-xs" title="View Video"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                        <a href="{{ url('/admin/videos/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs"
                                           title="Edit Video"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/admin/videos', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Video" />', array(
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-xs',
                                                'title' => 'Delete Video',
                                                'onclick'=>'return confirm("Are you sure you want to delete ' . $item->title . '?")'
                                        )) !!}
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