<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    @include('layouts.head')
    @section('style')
    @show
</head>

<body>
    <!-- Left Panel -->
    @include('layouts.leftPanel')
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        @include('layouts.header')
        <!-- /#header -->
        <!-- Content -->
        @section('content')
            
        @show
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        @include('layouts.footer')
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    @include('layouts.script')

    <!--Local Stuff-->
    @section('local-stuff')
    @show
</body>
</html>
