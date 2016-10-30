@include('admin.layouts.alert')

<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', trans('videos.title'), ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('summary') ? 'has-error' : ''}}">
    {!! Form::label('summary', trans('videos.summary'), ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::textarea('summary', null, ['class' => 'form-control']) !!}
        {!! $errors->first('summary', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('source') ? 'has-error' : ''}}">
    {!! Form::label('source', trans('videos.source'), ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('source', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('source', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('provider') ? 'has-error' : ''}}">
    {!! Form::label('provider', trans('videos.provider'), ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        <label class="radio-inline">
            {{ Form::radio('provider', 'Y', true) }} Youtube
        </label>
        <label class="radio-inline">
            {{ Form::radio('provider', 'F') }} Facebook
        </label>
        {!! $errors->first('provider', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('display') ? 'has-error' : ''}}">
    {!! Form::label('display', trans('videos.display'), ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        <label class="radio-inline">
            {{ Form::radio('display', 'Y', true) }} Yes
        </label>
        <label class="radio-inline">
            {{ Form::radio('display', 'N') }} No
        </label>
        {!! $errors->first('display', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('gallery_ids') ? 'has-error' : ''}}">
    {!! Form::label('gallery_ids', trans('videos.gallery_ids'), ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        @foreach ($galleries as $id => $name)
            <div class="checkbox">
                <label>
                    {{ Form::checkbox('gallery_ids[]', $id, in_array($id, $selected_galleries), ['class' => 'field']) }}
                    {{ $name }}
                </label>
            </div>
        @endforeach
        {!! $errors->first('gallery_ids', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('tag_ids') ? 'has-error' : ''}}">
    {!! Form::label('tag_ids', trans('videos.tag_ids'), ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        @foreach ($tags as $id => $name)
            <div class="checkbox col-sm-6 col-md-4">
                <label>
                    {{ Form::checkbox('tag_ids[]', $id, in_array($id, $selected_tags), ['class' => 'field']) }}
                    {{ $name }}
                </label>
            </div>
        @endforeach
        {!! $errors->first('tag_ids', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-3">
        {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
    </div>
</div>