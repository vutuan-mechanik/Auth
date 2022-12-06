<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1.0,user-scalable=0">
    <meta name="description" content="">
    <meta name="author" content="Blockchain Vietnam">
    <meta property="og:type" content="article"/>
    <meta property="og:title" content=" "/>
    <meta property="og:description" content=""/>
    <meta property="og:image" content=""/>
    <title>VietHoan</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('/assets/backend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/backend/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/backend/css/iconkit.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/backend/css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('/assets/backend/css/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/backend/css/theme.min.css')}}">

    @yield('style')
</head>
<body>
    <div class="wrapper">

            @include('backend.master.header')
            <div class="page-wrap">
                @include('backend.master.sidebar_menu')
                <div class="main-content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
                @include('backend.master.sidebar_right')
                @include('backend.master.chatmenu')
                @include('backend.master.footer')
            </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{asset('/assets/backend/js/popper.min.js')}}"></script>
    <script src="{{asset('/assets/backend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/assets/backend/js/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('/assets/backend/js/screenfull.js')}}"></script>
    <script src="{{asset('/assets/backend/js/moment.js')}}"></script>
    <script src="{{asset('/assets/backend/js/d3.min.js')}}"></script>
    <script src="{{asset('/assets/backend/js/c3.min.js')}}"></script>
    <script src="{{asset('/assets/backend/js/charts.js')}}"></script>
    <script src="{{asset('/assets/backend/js/theme.min.js')}}"></script>
    <script>
        $( document ).ready(function(){
            const stringPathName = window.location.pathname;
            const myarr = stringPathName.split("/");
            $(".sub-"+myarr[1]).addClass("open active");
            const activeMenuItem = $('.menu-item[href="' + localStorage.getItem('active-menu-item') + '"]').first();
            setActiveLink(activeMenuItem);
        })
        $('.menu-item').click(function (e) {
            localStorage.setItem('active-menu-item', $(this).attr('href'));
        });
        function setActiveLink($el) {
            $el.addClass('active');
            $el.click();
        }

    </script>
    @yield('script')
</body>
</html>
