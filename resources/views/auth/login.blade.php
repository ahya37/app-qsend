<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="chat ap">
    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons Icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}">

    <!-- Page Title Here -->
    <title>Qsend</title>

    <link href="{{asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <img src="{{asset('assets/images/qsend.png')}}" width="250px" alt="">
                                    </div>
                                    <h4 class="text-center mb-4">Sign in your account</h4>
                                    <form action="{{route('loginstore')}}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Email</strong></label>
                                            <input type="email" name="email" class="form-control" value="hello@example.com">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" name="password" class="form-control" value="Password">
                                        </div>
                                       
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Sign Me In</button>
                                        </div>
                                    </form>
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
    <!-- Required vendors -->
    <script src="{{asset('assets/vendor/global/global.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('assets/js/custom.min.js')}}"></script>
    <script src="{{asset('assets/js/deznav-init.js')}}"></script>

</body>

</html>
