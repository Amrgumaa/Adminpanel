<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Admin - @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ ('welcome/assets/img/favicons/favicon.ico') }}">
        <!-- head -->
        @include('admin.layouts/includes/head')
        <!-- endhead -->
    </head>
    <body data-sidebar="colored">
        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">

            </header>
            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">
                <!-- sidebar -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->


            <!-- start new work here -->
            @yield('maincontent')
            <!-- end work here -->


            <!-- footer-start -->
            <footer class="footer">
                <!-- footer-here -->
                @include('admin.layouts/includes/footer')
            </footer>
            <!-- footer-end -->
        </div>
        <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->
        <!-- JAVASCRIPT -->
        @include('admin.layouts/includes/foot')
    </body>

</html>
