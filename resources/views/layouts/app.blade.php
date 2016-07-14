<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('page-title') | Sales Management</title>

    <!-- Bootstrap -->
    <link href="/bower_resources/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/bower_resources/gentelella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="/bower_resources/gentelella/build/css/custom.min.css" rel="stylesheet">
    <!-- Custom css -->
    <link rel="stylesheet" href="/css/custom.css">
    @stack('stylesheet')
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{ route('home') }}" class="site_title"><i class="fa fa-tags"></i> <span>Sales Management</span></a>
            </div>
            <div class="clearfix"></div>
            <!-- menu profile quick info -->
            @include('layouts.partials.profile')
            <!-- /menu profile quick info -->
            <br />
            <!-- sidebar menu -->
            @include('layouts.partials.sidebar')
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        @include('layouts.partials.topnav')
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>@yield('page-header')</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>@yield('section-title')</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      @yield('page-content')
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        @include('layouts.partials.footer')
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="/bower_resources/gentelella/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/bower_resources/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="/bower_resources/gentelella/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="/bower_resources/gentelella/vendors/nprogress/nprogress.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="/bower_resources/gentelella/build/js/custom.min.js"></script>

    @stack('end-page-scripts')
  </body>
</html>
