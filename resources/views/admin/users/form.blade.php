@include('admin.layouts.alert')

<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', trans('users.name'), ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('name', isset($user->name) ? $user->name : null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    {!! Form::label('email', trans('users.email'), ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('email', isset($user->email) ? $user->email : null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('profession', trans('users.profession'), ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::select('profession_id', $professions, isset($user->profession_id) ? $user->profession_id : null, ['placeholder' => 'please select ...', 'class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>

<div class="form-group {{ $errors->has('bio') ? 'has-error' : ''}}">
    {!! Form::label('bio', trans('profiles.bio'), ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::textArea('bio', isset($user->profile->bio) ? $user->profile->bio : null, ['class' => 'form-control', 'required' => 'required', 'rows' => '3']) !!}
        {!! $errors->first('bio', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('web') ? 'has-error' : ''}}">
    {!! Form::label('web', trans('profiles.web'), ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('web', isset($user->profile->web) ? $user->profile->web : null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('web', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('facebook') ? 'has-error' : ''}}">
    {!! Form::label('facebook', trans('profiles.facebook'), ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('facebook', isset($user->profile->facebook) ? $user->profile->facebook : null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('facebook', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('twitter') ? 'has-error' : ''}}">
    {!! Form::label('twitter', trans('profiles.twitter'), ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('twitter', isset($user->profile->twitter) ? $user->profile->twitter : null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('twitter', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('github') ? 'has-error' : ''}}">
    {!! Form::label('github', trans('profiles.github'), ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('github', isset($user->profile->github) ? $user->profile->github : null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('github', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-3">
        {!! Form::submit('Save', ['class' => 'btn btn-default']) !!}
    </div>
</div>