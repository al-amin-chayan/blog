<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">My Blog</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            @if(count($subjects) > 0)
            @if(!isset($subject_id))
            @php $subject_id = 0 @endphp
            @endif
            <ul class="nav navbar-nav">
                @foreach($subjects as $subject)
                <li{!! $subject_id == $subject->id ? ' class="active"' : '' !!}>
                    <a href="{{ url('/subject/' . $subject->id . '/' . $subject->slug) }}">
                        {{ $subject->name }}
                    </a>
                </li>
                @endforeach
            </ul>
            @endif
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>