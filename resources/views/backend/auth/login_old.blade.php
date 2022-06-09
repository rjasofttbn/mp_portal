
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MP PORTAL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('public/backend/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/backend/plugins/toastr/toastr.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('public/backend/css/adminlte.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
      <script src="{{asset('public/backend/plugins/jquery/jquery.min.js')}}"></script>

    {{-- <script src="{{asset('public/backend/plugins/jquery/jquery.min.js')}}"></script> --}}
  </head>
  <body class="hold-transition login-page">
   <div class="login-box">
  <div class="login-logo">
    <a href="#"><b>MP</b> PORTAL </a>

  </div>
  <div class="card">
    <div class="card-body login-card-body">
      {{-- @dd(Session::get('info')) --}}
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="{{route('login')}}" method="post">
        @csrf
        <div class="form-group @error('email') has-error @enderror">
            <div class="input-group mb-3">
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{old('email')}}">
              <div class="input-group-append input-group-text">
                  <span class="fas fa-envelope"></span>
              </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group @error('password') has-error @enderror">
            <div class="input-group mb-3">
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
              <div class="input-group-append input-group-text">
                  <span class="fas fa-lock"></span>
              </div>
              @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-info btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->
      {{-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> --}}
      <!-- /.social-auth-links -->
      <p class="mb-1">
        <a href="{{route('reset.password')}}">I forgot my password</a>
      </p>

      <div class="row mobile-app mt-4">
        <div class="col-6">
          <a href="{{asset('public/mobile-app/MPportalAndroid.apk')}}"><img  style="width:100%"
            src="{{asset('public/images/google-play.png')}}" alt=""></a>
        </div>
        <div class="col-6">
          <a href="#"><img style="width: 100%"
            src="{{asset('public/images/app-store.png')}}" alt=""></a>
        </div>
      </div>
    </div>
  </div>
</div>
@if (session()->has('info'))                      {{-- Toastr info Notification --}}
      <script type="text/javascript">
          $(function () {
             toastr.info('{{session()->get("info")}}');
          });
      </script>
  @endif

<script src="{{asset('public/backend/plugins/toastr/toastr.min.js')}}"></script>
<!--Tostr Msg script-->
<script>
$(function()
{
  toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }

});

</script>

</body>
</html>


