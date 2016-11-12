@extends($layouts)

{{-- Page title --}}
@section('title')
    {{ $gallery->name }}
    @parent
@stop

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{ $gallery->name }}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Gallery Information
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <tbody>
                            <tr>
                                <th> {{ trans('galleries.name') }} </th>
                                <td> {{ $gallery->name }} </td>
                            </tr>
                            <tr>
                                <th> {{ trans('galleries.description') }} </th>
                                <td> {{ $gallery->description }} </td>
                            </tr>
                            <tr>
                                <th> {{ trans('galleries.display') }} </th>
                                <td> {{ $gallery->display === 'N' ? 'No' : 'Yes' }} </td>
                            </tr>
                            <tr>
                                <th> {{ trans('common.created_at') }} </th>
                                <td> {{ $gallery->created_at->toDayDateTimeString() }} </td>
                            </tr>
                            <tr>
                                <th> {{ trans('common.updated_at') }} </th>
                                <td> {{ $gallery->updated_at->diffForHumans() }} </td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="2" class="text-right">
                                    <a href="{{ url('admin/galleries/' . $gallery->id . '/edit') }}"
                                       class="btn btn-primary btn-xs" title="Edit User"><span
                                                class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                    {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['admin/galleries', $gallery->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-xs',
                                            'title' => 'Delete User',
                                            'onclick'=>'return confirm("Are you sure you want to delete ' . $gallery->name . '?")'
                                    )) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>

                    @if(count($videos) > 0)
                        <div class="row">
                            @foreach($videos as $row)
                                <div class="col-md-4">
                                    <div class="panel panel-{{ $row->display === 'N' ? 'danger' : 'default'}}">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">{{ $row->title }}</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="embed-responsive embed-responsive-16by9">
                                                @if($row->provider === 'F')
                                                    <div class="fb-video embed-responsive-item"
                                                         data-href="{{ $row->source }}"
                                                         data-allowfullscreen="true"></div>
                                                @else
                                                    <iframe class="embed-responsive-item" src="{{ $row->source }}"
                                                            allowfullscreen></iframe>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection