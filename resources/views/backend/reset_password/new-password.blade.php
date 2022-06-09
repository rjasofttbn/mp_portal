
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NanoSoft | Log in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('public/backend/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('public/backend/css/adminlte.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    
    {{-- <script src="{{asset('public/backend/plugins/jquery/jquery.min.js')}}"></script> --}}
  </head>
  <body class="hold-transition login-page">
   <div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Nano</b>Soft </a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <!-- <p class="login-box-msg">Enter your new password.</p> -->

      <form action="{{route('store.new.password')}}" method="post">
        @csrf
        <div class="form-group @error('new_password') has-error @enderror">
          <center><label>New Password</label></center>
            <div class="input-group mb-3">

              <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" placeholder="New Password" value="{{old('new_password')}}">
              <div class="input-group-append input-group-text">
                  <span class="fas fa-key"></span>
              </div>
                @error('new_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group @error('confirm_password') has-error @enderror">
          <center><label>Confirm Password</label></center>
            <div class="input-group mb-3">
              <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="Confirm Password">
              <div class="input-group-append input-group-text">
                  <span class="fas fa-lock"></span>
              </div>
              @error('confirm_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row">
          <div class="col-8">
            <!-- <div class="icheck-primary">
              <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label for="remember">
                Remember Me
              </label>
            </div> -->
          </div>          
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-info btn-block">Confirm</button>
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
        <!-- <a href="{{route('reset.password')}}">I forgot my password</a> -->
      </p>      
    </div>
  </div>
</div>
</body>
</html>


