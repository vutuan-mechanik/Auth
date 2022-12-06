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
    <link rel="stylesheet" href="{{asset('/assets/backend/css/theme.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/backend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/backend/css/jquery.toast.min.css')}}">
    @yield('style')
</head>
<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="auth-wrapper">
            <div class="container-fluid h-100">
                <div class="row flex-row h-100 bg-white">
                    <div class="col-xl-8 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                        <div class="lavalite-bg" style="background-image: url('/assets/backend/img/users/login-bg.jpg')">
                            <div class="lavalite-overlay"></div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0">
                        <div class="authentication-form mx-auto">

                            <h3>Đăng ký tài khoản</h3>

                            <form id="createUserForm" action="{{route('submit.register')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input name="name" id="name" type="text" class="form-control" placeholder="Họ tên" required="">
                                    <i class="ik ik-user"></i>
                                    <small class="text-danger error-text name_err"></small>
                                </div>
                                <div class="form-group">
                                    <input name="phone" id="phone" type="text" class="form-control" placeholder="Số điện thoại" required="">
                                    <i class="ik ik-phone"></i>
                                    <small class="text-danger error-text phone_err"></small>
                                </div>
                                <div class="form-group">
                                    <input name="email" id="email" type="text" class="form-control" placeholder="Email" required="">
                                    <i class="ik ik-user"></i>
                                    <small class="text-danger error-text email_err"></small>
                                </div>
                                <div class="form-group">
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Mật khẩu" required="">
                                    <i class="ik ik-lock"></i>
                                    <small class="text-danger error-text password_err"></small>
                                </div>
                                <div class="form-group">
                                    <input id="confirm_password" name="confirm_password" type="password" class="form-control" placeholder="Xác nhận mật khẩu" required="">
                                    <i class="ik ik-eye-off"></i>
                                    <small class="text-danger error-text confirm_password_err"></small>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-left">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="item_checkbox" name="item_checkbox" value="option1">
                                            <span class="custom-control-label">&nbsp;I Accept <a href="#">Terms and Conditions</a></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="sign-btn text-center">
                                    <button type="submit" class="btn btn-theme">Đăng ký</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{asset('/assets/backend/js/popper.min.js')}}"></script>
    <script src="{{asset('/assets/backend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/assets/backend/js/jquery.toast.min.js')}}"></script>
    <script src="{{asset('/assets/backend/js/alerts.js')}}"></script>
    <script>
        $("#createUserForm").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url:$(this).attr('action'),
                method:$(this).attr('method'),
                data:new FormData(this),
                processData:false,
                headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')},
                contentType:false,
                success:function(data){
                    var error = document.querySelectorAll(".error-text");
                    for (var i = 0; i < error.length; i++) {
                        error[i].innerHTML = "";
                    }
                    if(data.error_check==true){
                        showDangerToast(data.msg)
                    }
                    else if(data.error_check==false){
                        showSuccessToast(data.msg)
                        $('#createUserForm')[0].reset();
                    }
                    else{
                        printErrorMsg(data.error);
                    }
                }
            });
        });
        function printErrorMsg (msg) {
            $.each( msg, function( key, value ) {
                $('.'+key+'_err').text(value);
            });
        }
    </script>
</body>
</html>
