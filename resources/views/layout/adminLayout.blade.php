<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attendance Management</title>

    <link
        href={{asset('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap')}} rel="stylesheet">

    <!-- inject:css-->

    <link rel="stylesheet" href={{asset('assets/vendor_assets/css/bootstrap/bootstrap.css')}}>

    <link rel="stylesheet" href={{asset('assets/vendor_assets/css/daterangepicker.css')}}>

    <link rel="stylesheet" href={{asset('assets/vendor_assets/css/fontawesome.css')}}>

    <link rel="stylesheet" href={{asset('assets/vendor_assets/css/footable.standalone.min.css')}}>

    <link rel="stylesheet" href={{asset('assets/vendor_assets/css/fullcalendar@5.2.0.css')}}>

    <link rel="stylesheet" href={{asset('assets/vendor_assets/css/jquery-jvectormap-2.0.5.css')}}>

    <link rel="stylesheet" href={{asset('assets/vendor_assets/css/jquery.mCustomScrollbar.min.css')}}>

    <link rel="stylesheet" href={{asset('assets/vendor_assets/css/leaflet.css')}}>

    <link rel="stylesheet" href={{asset('assets/vendor_assets/css/line-awesome.min.css')}}>

    <link rel="stylesheet" href={{asset('assets/vendor_assets/css/magnific-popup.css')}}>

    <link rel="stylesheet" href={{asset('assets/vendor_assets/css/MarkerCluster.css')}}>

    <link rel="stylesheet" href={{asset('assets/vendor_assets/css/MarkerCluster.Default.css')}}>

    <link rel="stylesheet" href={{asset('assets/vendor_assets/css/select2.min.css')}}>

    <link rel="stylesheet" href={{asset('assets/vendor_assets/css/slick.css')}}>

    <link rel="stylesheet" href={{asset('assets/vendor_assets/css/star-rating-svg.css')}}>

    <link rel="stylesheet" href={{asset('assets/vendor_assets/css/trumbowyg.min.css')}}>

    <link rel="stylesheet" href={{asset('assets/vendor_assets/css/wickedpicker.min.css')}}>

    <link rel="stylesheet" href={{asset('assets/css/style.css')}}>

    <!-- Search Filter

    <!-- Icons font CSS-->
    <link href="{{asset('search/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet"
          media="all">
    <link href="{{asset('search/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link
        href="{{asset('search/https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i')}}"
        rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="{{asset('search/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('search/vendor/datepicker/daterangepicker.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('search/css/main.css')}}" rel="stylesheet" media="all">


    <!-- endinject -->

    <link rel="icon" type="image/png" sizes="16x16" href={{asset('img/favicon.png')}}>
</head>

<body class="layout-light side-menu overlayScroll">
{{--<div class="mobile-search">--}}
{{--    <form class="search-form">--}}
{{--        <span data-feather="search"></span>--}}
{{--        <input class="form-control mr-sm-2 box-shadow-none" type="text" placeholder="Search...">--}}
{{--    </form>--}}
{{--</div>--}}

<div class="mobile-author-actions"></div>
<header class="header-top">
    <nav class="navbar navbar-light">
        <div class="navbar-left">
            {{--            <a href="" class="sidebar-toggle">--}}
            {{--                <img class="svg" src={{asset('img/svg/bars.svg')}} alt="img"></a>--}}
            <a class="navbar-brand" href="{{route('home')}}"><img class="dark" src="{{asset('img/logo_dark.png')}}" alt="svg">  Shomvob<img
                    class="light" src={{('img/logo_white.png')}} alt="img"></a>

            <div class="top-menu">

                <div class="strikingDash-top-menu position-relative">
                    <ul>
                        <li class="has-subMenu">
                            <a href="#" class="active">
                                <span data-feather="home" class="nav-icon"></span>
                                <span class="menu-text">{{ Auth::user()->name }}</span>
                                <span class="toggle-icon"></span>
                            </a>
                            <ul class="subMenu">
                                <li>
                                    @if (auth()->check())
                                        @if (auth()->user()->isAdmin())
                                            <a href="{{route('admin.companyA.create')}}" class="">Add</a>
                                        @elseif (auth()->user()->isUserA())
                                            <a href="{{route('admin.companyA.create')}}" class="">Add</a>
                                        @elseif (auth()->user()->isUserB())
                                            <a href="{{route('admin.companyB.create')}}" class="">Add</a>
                                        @endif
                                    @endif
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- ends: navbar-left -->

        <div class="navbar-right">
            <ul class="navbar-right__menu">
                {{--                <li class="nav-search d-none">--}}
                {{--                    <a href="#" class="search-toggle">--}}
                {{--                        <i class="la la-search"></i>--}}
                {{--                        <i class="la la-times"></i>--}}
                {{--                    </a>--}}
                {{--                    <form action="/" class="search-form-topMenu">--}}
                {{--                        <span class="search-icon" data-feather="search"></span>--}}
                {{--                        <input class="form-control mr-sm-2 box-shadow-none" type="text" placeholder="Search...">--}}
                {{--                    </form>--}}
                {{--                </li>--}}

                <li class="nav-support">
                    <div class="dropdown-custom">
                        <a href="javascript:;" class="nav-item-toggle">
                            <span data-feather="users"></span></a>
                        <div class="dropdown-wrapper">
                            <div class="list-group">
                                <span>Company List</span>
                                <ul>
                                    <li>
                                        @if (auth()->check())
                                            @if (auth()->user()->isAdmin())
                                                <a href="{{route('admin.companyA.list')}}">Company A</a>
                                            @elseif (auth()->user()->isUserA())
                                                <a href="{{route('admin.companyA.list')}}">Company A</a>
                                            @endif
                                        @endif
                                    </li>
                                    <li>
                                        @if (auth()->check())
                                            @if (auth()->user()->isAdmin())
                                                <a href="{{route('admin.companyB.list')}}">Company B</a>
                                            @elseif (auth()->user()->isUserB())
                                                <a href="{{route('admin.companyB.list')}}">Company B</a>
                                            @endif
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- ends: .nav-support -->

                <li class="nav-author">
                    <div class="dropdown-custom">
                        <a href="javascript:;" class="nav-item-toggle"><img src={{asset('img/author-nav.jpg')}} alt=""
                                                                            class="rounded-circle"></a>
                        <div class="dropdown-wrapper">
                            <div class="nav-author__info">
                                <div class="author-img">
                                    <img src={{asset('img/author-nav.jpg')}} alt="" class="rounded-circle">
                                </div>
                                <div>
                                    <h6>{{ Auth::user()->name }}</h6>
                                    <span>{{ Auth::user()->email }}</span>
                                </div>
                            </div>
                            <div class="nav-author__options">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        <span data-feather="log-out"></span>{{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </div>
                        <!-- ends: .dropdown-wrapper -->
                    </div>
                </li>
                <!-- ends: .nav-author -->
            </ul>
            <!-- ends: .navbar-right__menu -->
            <div class="navbar-right__mobileAction d-md-none">
                <a href="#" class="btn-search">
                    <span data-feather="search"></span>
                    <span data-feather="x"></span></a>
                <a href="#" class="btn-author-action">
                    <span data-feather="more-vertical"></span></a>
            </div>
        </div>
        <!-- ends: .navbar-right -->
    </nav>
</header>
<main class="main-content">

    {{--    <aside class="sidebar-wrapper">--}}
    {{--        <div class="sidebar sidebar-collapse" id="sidebar">--}}
    {{--            <div class="sidebar__menu-group">--}}
    {{--                <ul class="sidebar_nav">--}}
    {{--                    <li class="menu-title">--}}
    {{--                        <span>Main menu</span>--}}
    {{--                    </li>--}}
    {{--                    <li class="has-child open">--}}
    {{--                        <a href="#" class="active">--}}
    {{--                            <span data-feather="home" class="nav-icon"></span>--}}
    {{--                            <span class="menu-text">{{ Auth::user()->name }}</span>--}}
    {{--                            <span class="toggle-icon"></span>--}}
    {{--                        </a>--}}
    {{--                        <ul class="subMenu">--}}
    {{--                            <li>--}}
    {{--                                @if (auth()->check())--}}
    {{--                                    @if (auth()->user()->isAdmin())--}}
    {{--                                        <a href="{{route('admin.companyA.create')}}" class="">Add Info of Company A</a>--}}
    {{--                                        <a href="{{route('admin.companyB.create')}}" class="">Add Info of Company B</a>--}}
    {{--                                    @endif--}}
    {{--                                @endif--}}
    {{--                            </li>--}}
    {{--                        </ul>--}}
    {{--                    </li>--}}
    {{--                </ul>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </aside>--}}


    @yield('content')

</main>
<div id="overlayer">
        <span class="loader-overlay">
            <div class="atbd-spin-dots spin-lg">
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
            </div>
        </span>
</div>
<div class="overlay-dark-sidebar"></div>
<footer class="footer-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="footer-copyright">
                    <p>2022 @<a href="https://bugfixitbd.com">bugfixitbd.com</a>
                    </p>
                </div>
            </div>

        </div>
    </div>
</footer>

<script src={{asset('http://maps.googleapis.com/maps/api/js?key=AIzaSyDduF2tLXicDEPDMAtC6-NLOekX0A5vlnY')}}></script>
<!-- inject:js-->
<script src={{asset('assets/vendor_assets/js/jquery/jquery-3.5.1.min.js')}}></script>
<script src={{asset('assets/vendor_assets/js/jquery/jquery-ui.js')}}></script>
<script src={{asset('assets/vendor_assets/js/bootstrap/popper.js')}}></script>
<script src={{asset('assets/vendor_assets/js/bootstrap/bootstrap.min.js')}}></script>
<script src={{asset('assets/vendor_assets/js/moment/moment.min.js')}}></script>
<script src={{asset('assets/vendor_assets/js/accordion.js')}}></script>
<script src={{asset('assets/vendor_assets/js/autoComplete.js')}}></script>
<script src={{asset('assets/vendor_assets/js/Chart.min.js')}}></script>
<script src={{asset('assets/vendor_assets/js/charts.js')}}></script>
<script src={{asset('assets/vendor_assets/js/daterangepicker.js')}}></script>
<script src={{asset('assets/vendor_assets/js/drawer.js')}}></script>
<script src={{asset('assets/vendor_assets/js/dynamicBadge.js')}}></script>
<script src={{asset('assets/vendor_assets/js/dynamicCheckbox.js')}}></script>
<script src={{asset('assets/vendor_assets/js/feather.min.js')}}></script>
<script src={{asset('assets/vendor_assets/js/footable.min.js')}}></script>
<script src={{asset('assets/vendor_assets/js/fullcalendar@5.2.0.js')}}></script>
<script src={{asset('assets/vendor_assets/js/google-chart.js')}}></script>
<script src={{asset('assets/vendor_assets/js/jquery-jvectormap-2.0.5.min.js')}}></script>
<script src={{asset('assets/vendor_assets/js/jquery-jvectormap-world-mill-en.js')}}></script>
<script src={{asset('assets/vendor_assets/js/jquery.countdown.min.js')}}></script>
<script src={{asset('assets/vendor_assets/js/jquery.filterizr.min.js')}}></script>
<script src={{asset('assets/vendor_assets/js/jquery.magnific-popup.min.js')}}></script>
<script src={{asset('assets/vendor_assets/js/jquery.mCustomScrollbar.min.js')}}></script>
<script src={{asset('assets/vendor_assets/js/jquery.peity.min.js')}}></script>
<script src={{asset('assets/vendor_assets/js/jquery.star-rating-svg.min.js')}}></script>
<script src={{asset('assets/vendor_assets/js/leaflet.js')}}></script>
<script src={{asset('assets/vendor_assets/js/leaflet.markercluster.js')}}></script>
<script src={{asset('assets/vendor_assets/js/loader.js')}}></script>
<script src={{asset('assets/vendor_assets/js/message.js')}}></script>
<script src={{asset('assets/vendor_assets/js/moment.js')}}></script>
<script src={{asset('assets/vendor_assets/js/muuri.min.js')}}></script>
<script src={{asset('assets/vendor_assets/js/notification.js')}}></script>
<script src={{asset('assets/vendor_assets/js/popover.js')}}></script>
<script src={{asset('assets/vendor_assets/js/select2.full.min.js')}}></script>
<script src={{asset('assets/vendor_assets/js/slick.min.js')}}></script>
<script src={{asset('assets/vendor_assets/js/trumbowyg.min.js')}}></script>
<script src={{asset('assets/vendor_assets/js/wickedpicker.min.js')}}></script>
<script src={{asset('assets/theme_assets/js/drag-drop.js')}}></script>
<script src={{asset('assets/theme_assets/js/footable.js')}}></script>
<script src={{asset('assets/theme_assets/js/full-calendar.js')}}></script>
<script src={{asset('assets/theme_assets/js/googlemap-init.js')}}></script>
<script src={{asset('assets/theme_assets/js/icon-loader.js')}}></script>
<script src={{asset('assets/theme_assets/js/jvectormap-init.js')}}></script>
<script src={{asset('assets/theme_assets/js/leaflet-init.js')}}></script>
<script src={{asset('assets/theme_assets/js/main.js')}}></script>
<!-- endinject-->

{{--<!-- Jquery JS-->--}}
{{--<script src="{{asset('search/vendor/jquery/jquery.min.js')}}"></script>--}}
{{--<!-- Vendor JS-->--}}
{{--<script src="{{asset('search/vendor/select2/select2.min.js')}}"></script>--}}
{{--<script src="{{asset('search/vendor/jquery-validate/jquery.validate.min.js')}}"></script>--}}
{{--<script src="{{asset('search/vendor/bootstrap-wizard/bootstrap.min.js')}}"></script>--}}
{{--<script src="{{asset('search/vendor/bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>--}}
{{--<script src="{{asset('search/vendor/datepicker/moment.min.js')}}"></script>--}}
{{--<script src="{{asset('search/vendor/datepicker/daterangepicker.js')}}"></script>--}}

{{--<!-- Main JS-->--}}
{{--<script src="{{asset('search/js/global.js')}}"></script>--}}

</body>

</html>
