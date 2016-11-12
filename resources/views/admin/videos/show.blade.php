@extends($layouts)

{{-- Page title --}}
@section('title')
    {{ $video->title }}
    @parent
@stop

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">{{ $video->title }}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Video Information
                </div>
                <div class="panel-body">
                    <div class="embed-responsive embed-responsive-16by9">
                        @if($video->provider === 'F')
                            <div class="fb-video embed-responsive-item"
                                 data-href="{{ $video->source }}"
                                 data-allowfullscreen="true"
                                 data-autoplay="true"></div>
                        @else
                            <iframe class="embed-responsive-item" src="{{ $video->source }}?autoplay=1"
                                    allowfullscreen></iframe>
                        @endif
                    </div>

                    @if($video->summary != '')
                        <p>{{ $video->summary }}</p>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <tbody>
                            <tr>
                                <th> {{ trans('videos.gallery_ids') }} </th>
                                <td>
                                    @foreach($galleries as $gallery)
                                        <a href="{{ url('/admin/galleries', [$gallery->id]) }}" class="label label-{{ $gallery->display === 'N' ? 'danger' : 'primary'}}" target="_blank">{{ $gallery->name }}</a>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th> {{ trans('videos.tag_ids') }} </th>
                                <td>
                                    @foreach($tags as $tag)
                                        <span class="label label-primary">{{ $tag->name }}</span>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th> {{ trans('common.created_at') }} </th>
                                <td> {{ $video->created_at->toDayDateTimeString() }} </td>
                            </tr>
                            <tr>
                                <th> {{ trans('common.updated_at') }} </th>
                                <td> {{ $video->updated_at->toDayDateTimeString() }} </td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="2" class="text-right">
                                    <a href="{{ url('admin/videos/' . $video->id . '/edit') }}"
                                       class="btn btn-primary btn-xs" title="Edit User"><span
                                                class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                    {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['admin/videos', $video->id],
                                        'style' => 'display:inline'
                                    ]) !!}
                                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-xs',
                                            'title' => 'Delete User',
                                            'onclick'=>'return confirm("Are you sure you want to delete ' . $video->title . '?")'
                                    )) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            </tfoot>
                        </table>
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