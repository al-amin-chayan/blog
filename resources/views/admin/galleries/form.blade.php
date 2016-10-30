@include('admin.layouts.alert')

<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', trans('galleries.name'), ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', trans('galleries.description'), ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('display') ? 'has-error' : ''}}">
    {!! Form::label('display', trans('galleries.display'), ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-9">
        <label class="radio-inline">
            {{ Form::radio('display', 'Y', true) }} Yes
        </label>
        <label class="radio-inline">
            {{ Form::radio('display', 'N') }} No
        </label>
        {!! $errors->first('display', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('video_ids') ? 'has-error' : ''}}">
    {!! Form::label('video_ids', trans('galleries.video_ids'), ['class' => 'control-label']) !!}
    <div class="clearfix"></div>
        @foreach ($videos as $row)
            <div class="col-md-4">
                <div class="panel panel-{{ $row->display === 'N' ? 'danger' : 'default'}}">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <div class="checkbox">
                                <label>
                                    {{ Form::checkbox('video_ids[]', $row->id, in_array($row->id, $selected_videos), ['class' => 'field']) }}
                                    {{ $row->title }}
                                </label>
                            </div>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="embed-responsive embed-responsive-16by9">
                            @if($row->provider === 'F')
                                <div class="fb-video embed-responsive-item"
                                     data-href="{{ $row->source }}"
                                     data-allowfullscreen="true"></div>
                            @else
                                <iframe class="embed-responsive-item" src="{{ $row->source }}" allowfullscreen></iframe>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {!! $errors->first('video_ids', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-3">
        {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
    </div>
</div>