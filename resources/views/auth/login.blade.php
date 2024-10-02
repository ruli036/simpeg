<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="196x196" href="{{asset('img/logo.png')}}">

    <title>{{LEMBAGA}}</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row d-flex align-items-center">
                            <div class="col-lg-5 text-center d-none d-lg-block">
                                <img class="img-fluid" src="{{asset('img/logo.png')}}" width="80%">
                            </div>
                            <div class="col-lg-7">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-gray-900 mb-2">Sekolah Al-Azhar Cairo Banda Aceh</h4>
                                        <h5 class="text-gray-900 mb-4">Sistem Informasi Kepegawaian</h5>
                                    </div>
                                    @if (session('info'))
                                    <div class="alert alert-info alert-block">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        {{ session('info') }}
                                    </div>
                                    @endif
                                    @if (session('warning'))
                                    <div class="alert alert-warning alert-block">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        {{ session('warning') }}
                                    </div>
                                    @endif
                                    @if (session('danger'))
                                    <div class="alert alert-danger alert-block">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        {{ session('danger') }}
                                    </div>
                                    @endif
                                    <form id="login" class="user" method="POST" action="{{route('login')}}">
                                        @csrf
                                        <div class="form-group">
                                            <input id="nik" type="text" onkeydown="disableAlphabets(event)" class="form-control form-control-user @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" required autofocus placeholder="Nomor NIK">
                                            @error('nik')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input id="password" type="password" onkeydown="disableSymbols(event)" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password" required>

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">

                                                <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="custom-control-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>

                                        <button id="go" type="submit" class="btn btn-primary btn-user btn-block">
                                            {{ __('Login') }}
                                        </button>
                                        <hr>
                                        <a class="nav-link d-flex justify-content-end" style="font-size: 12px" href="{{ route('forgetPasswordForm') }}">{{ __('Forgot Password!') }}</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
    <script src="{{asset('js/loadingoverlay/loadingoverlay.min.js')}}"></script>
    <script>

        $(document).ready(function () {
            $("button#go").click(function (e) {
                e.preventDefault();
                document.getElementById("login").submit();
                $.LoadingOverlay("show");
            });
        });
        function disableSymbols(event) {
            var prohibitedKeys = ["+", "?", "=", "/", "<", ">", "[", "]"];

            if (prohibitedKeys.includes(event.key)) {
                event.preventDefault();
            }
        }
        function disableAlphabets(event) {
            var charCode = event.which || event.keyCode;
            var prohibitedKeys = ["+", "?", "=", "/", "<", ">", "[", "]"];
            if ((charCode >= 65 && charCode <= 90) || (charCode >= 97 && charCode <= 122)) {
                event.preventDefault();
            }

            if (prohibitedKeys.includes(event.key)) {
                event.preventDefault();
            }
        }
    </script>
</body>

</html>