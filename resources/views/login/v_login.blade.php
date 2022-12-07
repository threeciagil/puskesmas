<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Sistem Pelayanan Pasien</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/template/images/logo2.png">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
    <link href="/template/css/style.css" rel="stylesheet">

</head>

<body class="h-100">

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

<div class="login-form-bg h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="col-xl-6">
                <div class="form-input-content">
                    <div class="card login-form mb-0">
                        <div class="card-body pt-5">
                            <div class="text-center">
                                <h4>Sistem Pelayanan Pasien</h4>
                            </div>
                            <br>
                            @if (Session::has('error'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                            <form enctype="multipart/form-data"  method="POST" action="/login" role="form" class="mt-5 mb-5 login-input" >
                                @csrf <!-- {{ csrf_field() }} -->
                                <div class="form-group">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required autofocuse>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required autofocuse>
                                </div>
                                <button type="submit" class="btn login-form__btn submit w-100">Login</button>

                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="#">Forgot Password</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--**********************************
    Scripts
***********************************-->
<script src="/template/plugins/common/common.min.js"></script>
<script src="/template/js/custom.min.js"></script>
<script src="/template/js/settings.js"></script>
<script src="/template/js/gleek.js"></script>
<script src="/template/js/styleSwitcher.js"></script>
</body>

</html>
