<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/template/images/logo2.png">
    <!-- Pignose Calender -->
    <link href="/template/plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="/template/images/favicon.png"> -->

    <!-- Chartist -->
    <link rel="stylesheet" href="/template/plugins/chartist/css/chartist.min.css">
    <!-- <link rel="stylesheet" href="/template/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css"> -->
    <!-- Custom Stylesheet -->
    <link href="/template/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <!-- Page plugins css -->
    <link href="/template/plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="/template/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <!-- Daterange picker plugins css -->
    <link href="/template/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="/template/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="/template/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/template/plugins/jquery-steps/css/jquery.steps.css" rel="stylesheet">
    <link href="/template/css/style.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->

</head>

<body>

<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="loader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
        </svg>
    </div>
</div>
<!--*******************
    Preloader end
********************-->


<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">

    <!--**********************************
        Nav header start
    ***********************************-->
    <div class="nav-header">
        <div class="brand-logo">
            <a href="/">
                <b class="logo-abbr"><img src="/template/images/logo4.png" alt=""> </b>
                <span class="logo-compact"><img src="/template/images/logo4.png" alt=""></span>
                <span class="brand-title">
                    <!-- <h1>SISPEL</h1> -->
                        <img src="/template/images/sispel2.png" alt="">
                    </span>
            </a>
        </div>
    </div>
    <!--**********************************
        Nav header end
    ***********************************-->

    <!--**********************************
        Header start
    ***********************************-->
    <div class="header">
        <div class="header-content clearfix">

            <div class="nav-control">
                <div class="hamburger">
                    <span class="toggle-icon"><i class="icon-menu"></i></span>
                </div>
            </div>

            <div class="header-right">
                <ul class="clearfix">
{{--                    <li class="icons dropdown">--}}
{{--                        <div class="user-img c-pointer position-relative" data-toggle="dropdown">--}}
{{--                            <!-- <span class="activity"></span> -->--}}
{{--                            <img src="/template/images/user/surat.png" height="40" width="40" alt="">--}}



{{--                        </div>--}}

{{--                    </li>--}}
                    <li class="icons dropdown">
                        <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                            <span class="activity active"></span>
                            <img src="/template/images/user/1.png" height="40" width="40" alt="">
                        </div>
                        <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                            <div class="dropdown-content-body">
                                <ul>
                                    <li><a href="/logout"><i class="icon-key"></i> <span>Logout</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </div>
