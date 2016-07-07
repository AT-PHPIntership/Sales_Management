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
    <link href="bower_resources/gentelella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="bower_resources/gentelella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="bower_resources/gentelella/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="bower_resources/gentelella/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- jVectorMap -->
    <link href="css/maps/jquery-jvectormap-2.0.3.css" rel="stylesheet"/>

    <!-- Custom Theme Style -->
    <link href="bower_resources/gentelella/build/css/custom.min.css" rel="stylesheet">
    @stack('scripts')
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-tags"></i> <span>Sales Mgmt</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="bower_resources/gentelella/production/images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section menu_fixed">
                <h3>MANAGEMENT</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-buysellads"></i> Sales <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.html">New Bill</a></li>
                      <li><a href="index.html">List Bills</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-database"></i> Products <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="">Add Product</a></li>
                      <li><a href="">Products Status</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-folder-open-o"></i> Categoies <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="">New Category</a></li>
                      <li><a href="">List Category</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-arrow-circle-right"></i> Import <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="">Add Receipt</a></li>
                      <li><a href="">List Receipt</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-line-chart"></i> Finance <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="">Daily Statistic</a></li>
                      <li><a href="">Monthly Statistic</a></li>
                      <li><a href="">Quarterly Statistic</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-users"></i> Human Resource <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/adduser">Add New Staff</a></li>
                      <li><a href="index.html">List Staffs</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav class="" role="navigation">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="bower_resources/gentelella/production/images/img.jpg" alt="">John Doe
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;"> Settings</a>
                    </li>
                    <li><a href="javascript:;"> Help <span class="label label-success pull-right">Coming Soon</span></a></li>
                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
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
        <footer>
          <div class="pull-right">
            Sales Managements System by AT-Internships <a href="#">Superman</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="bower_resources/gentelella/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="bower_resources/gentelella/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="bower_resources/gentelella/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="bower_resources/gentelella/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="bower_resources/gentelella/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="bower_resources/gentelella/vendors/bernii/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="bower_resources/gentelella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="bower_resources/gentelella/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="bower_resources/gentelella/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="bower_resources/gentelella/vendors/Flot/jquery.flot.js"></script>
    <script src="bower_resources/gentelella/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="bower_resources/gentelella/vendors/Flot/jquery.flot.time.js"></script>
    <script src="bower_resources/gentelella/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="bower_resources/gentelella/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="js/flot/jquery.flot.orderBars.js"></script>
    <script src="js/flot/date.js"></script>
    <script src="js/flot/jquery.flot.spline.js"></script>
    <script src="js/flot/curvedLines.js"></script>
    <!-- jVectorMap -->
    <script src="js/maps/jquery-jvectormap-2.0.3.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="js/moment/moment.min.js"></script>
    <script src="js/datepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="bower_resources/gentelella/build/js/custom.min.js"></script>

    @stack('end-page-scripts')
  </body>
</html>
