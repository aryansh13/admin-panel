<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Login</title>
    <link href="{{ asset('admin-assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="{{ asset('admin-assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form id="loginForm" class="user" action="/api/login" method="POST">
                                        <div id="errorAlert" class="alert alert-danger d-none"></div>
                                        <div class="form-group">
                                            <input name="username" type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" placeholder="Enter Username...">
                                        </div>
                                        <div class="form-group">
                                            <input name="password" type="password"
                                                class="form-control form-control-user" id="exampleInputPassword"
                                                placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input name="remember" type="checkbox" class="custom-control-input"
                                                    id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block btn-user">Login</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('register') }}">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin-assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/sb-admin-2.min.js') }}"></script>
    <script>
        $('#loginForm').on('submit', function(e) {
            e.preventDefault();

            let formData = $(this).serialize();
            $.ajax({
                url: '/api/login',
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.status === 'success') {
                        // Redirect to dashboard or any other page upon successful login
                        window.location.href = '/dashboard';
                    } else {
                        $('#errorAlert').text(response.message).removeClass('d-none');
                    }
                },
                error: function(xhr) {
                    $('#errorAlert').text('An error occurred').removeClass('d-none');
                }
            });
        });
    </script>
</body>

</html>
