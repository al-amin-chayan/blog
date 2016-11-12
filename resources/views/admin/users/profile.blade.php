@extends($layouts)

{{-- Page title --}}
@section('title', 'Profile Update')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Profile Update</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Profile Update Form
                </div>
                <div class="panel-body">
                    {!! Form::open([
                        'method' => 'PATCH',
                        'url' => 'admin/update-profile',
                        'class' => 'form-horizontal',
                        'files' => true
                    ]) !!}

                    @include('admin.layouts.alert')

                    @if($user->profile->picture != '' && file_exists(public_path() . '/uploads/profile-picture/' . $user->profile->picture))
                        <div class="img-thumbnail pull-right clearfix">
                            <img src="{!! url('/uploads/profile-picture/' . $user->profile->picture) !!}" alt="profile picture" class="img-rounded img-responsive">
                        </div>
                        <div class="clearfix"></div>
                    @endif
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        {!! Form::label('name', trans('profile.name'), ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::text('name', $user->name, ['class' => 'form-control', 'required' => 'required']) !!}
                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                        {!! Form::label('email', trans('profile.email'), ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::email('email', $user->email, ['class' => 'form-control', 'required' => 'required']) !!}
                            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('new_password_confirmation') ? 'has-error' : ''}}">
                        {!! Form::label('bio', trans('profile.bio'), ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::textarea('bio', $user->profile->bio, ['class' => 'form-control']) !!}
                            {!! $errors->first('bio', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('web') ? 'has-error' : ''}}">
                        {!! Form::label('web', trans('profile.web'), ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::text('web', $user->profile->web, ['class' => 'form-control']) !!}
                            {!! $errors->first('web', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('facebook') ? 'has-error' : ''}}">
                        {!! Form::label('facebook', trans('profile.facebook'), ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::text('facebook', $user->profile->facebook, ['class' => 'form-control']) !!}
                            {!! $errors->first('facebook', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('twitter') ? 'has-error' : ''}}">
                        {!! Form::label('twitter', trans('profile.twitter'), ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::text('twitter', $user->profile->twitter, ['class' => 'form-control']) !!}
                            {!! $errors->first('twitter', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('github') ? 'has-error' : ''}}">
                        {!! Form::label('github', trans('profile.github'), ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::text('github', $user->profile->github, ['class' => 'form-control']) !!}
                            {!! $errors->first('github', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('picture') ? 'has-error' : ''}}">
                        {!! Form::label('picture', trans('profile.picture'), ['class' => 'col-sm-3 control-label']) !!}
                        <div class="col-sm-6">
                            {!! Form::file('picture', ['accept' => 'image/*']) !!}
                            {!! $errors->first('picture', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-3">
                            {!! Form::submit('Save', ['class' => 'btn btn-default']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection