@include('admin.layouts.alert')
@if(isset($article))
    @if( $article->image != '' && file_exists(public_path() . '/uploads/article-image/' . $article->image))
        <img src="{!! url('/uploads/article-image/' . $article->image) !!}" alt="article image" class="img-responsive">
    @endif
@endif
<div class="form-group {{ $errors->has('subject_id') ? 'has-error' : ''}}">
    {!! Form::label('subject_id', trans('articles.subject_id'), ['class' => 'control-label required']) !!}
    {!! Form::select('subject_id', $subjects, null, ['placeholder' => 'Select One ...', 'class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('subject_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', trans('articles.title'), ['class' => 'control-label required']) !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('sub_title') ? 'has-error' : ''}}">
    {!! Form::label('sub_title', trans('articles.sub_title'), ['class' => 'control-label']) !!}
    {!! Form::text('sub_title', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('sub_title', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('summary') ? 'has-error' : ''}}">
    {!! Form::label('summary', trans('articles.summary'), ['class' => 'control-label required']) !!}
    {!! Form::textarea('summary', null, ['class' => 'form-control', 'rows' => '3', 'required' => 'required']) !!}
    {!! $errors->first('summary', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('details') ? 'has-error' : ''}}">
    {!! Form::label('details', trans('articles.details'), ['class' => 'control-label required']) !!}
    {!! Form::textarea('details', null, ['class' => 'form-control editorDetails', 'id' => 'editorDetails', 'rows' => '10', 'required' => 'required']) !!}
    {!! $errors->first('details', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    {!! Form::label('image', trans('articles.image'), ['class' => 'control-label']) !!}
    {!! Form::file('image', ['accept' => 'image/*']) !!}
    {!! $errors->first('picture', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('display') ? 'has-error' : ''}}">
    {!! Form::label('display', trans('articles.display'), ['class' => 'control-label required']) !!}
    <label class="radio-inline">
        {{ Form::radio('display', 'Y', true) }} Yes
    </label>
    <label class="radio-inline">
        {{ Form::radio('display', 'N') }} No
    </label>
    {!! $errors->first('display', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('tag_ids') ? 'has-error' : ''}}">
    {!! Form::label('tag_ids', trans('articles.tag_ids'), ['class' => 'control-label']) !!}
    <div class="clearfix"></div>
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

<div class="clearfix"></div>
<div class="form-group">
    {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
</div>

@push('scripts')

<script src="//cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('editorDetails', {
    uiColor: '#9AB8F3'
});
</script>
@endpush