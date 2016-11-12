@extends($layouts)

{{-- Page title --}}
@section('title')
    {{ $article->title }}
    @parent
@stop

@section('content')
<div class="container">

    <h1>Article {{ $article->id }}</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID.</th><td>{{ $article->id }}</td>
                </tr>
                <tr>
                    <th> {{ trans('articles.subject_id') }} </th>
                    <td> {{ $article->subject->name }} </td>
                </tr>
                <tr>
                    <th> {{ trans('articles.title') }} </th>
                    <td> {{ $article->title }} </td>
                </tr>
                <tr>
                    <th> {{ trans('articles.sub_title') }} </th>
                    <td> {{ $article->sub_title }} </td>
                </tr>
                <tr>
                    <th> {{ trans('articles.image') }} </th>
                    <td>
                        @if( $article->image != '' && file_exists(public_path() . '/uploads/article-image/' . $article->image))
                            <img src="{!! url('/uploads/article-image/' . $article->image) !!}" alt="article image" class="img-rounded" width="150px" height="100px">
                        @endif
                    </td>
                </tr>
                <tr>
                    <th> {{ trans('articles.tags') }} </th>
                    <td>
                        @foreach($tags as $tag)
                            <span class="label label-primary">{{ $tag->name }}</span>
                        @endforeach
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">
                        <a href="{{ url('/admin/articles/' . $article->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Article"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['articles', $article->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Article',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ));!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

</div>
@endsection