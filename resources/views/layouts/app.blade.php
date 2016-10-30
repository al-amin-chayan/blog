<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title') | {{ config('app.name', 'Laravel Blog') }}
    </title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('front-end/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('front-end/css/blog-home.css') }}" rel="stylesheet">

    {{-- Page Specific CSS Files --}}
    @stack('css')
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

</head>
<body>
    @include('layouts.fb-root')
    @include('layouts.nav')
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                @yield('content')
            </div>
            @include('layouts.sidebar')
        </div>
        <!-- /.row -->
        <hr>
        @include('layouts.footer')
    </div>

    <!-- jQuery -->
    <script src="{{ asset('front-end/js/jquery.js') }}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('front-end/js/bootstrap.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
