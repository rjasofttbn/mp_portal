
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NanoSoft | Reset Password</title>
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
      <p class="login-box-msg">User Name</p>

      <form action="{{route('check.name')}}" method="get">
        @csrf
        <div class="form-group @error('email') has-error @enderror">
            <div class="input-group mb-3">
              <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="" value="{{$name}}">
              <div class="input-group-append input-group-text">
                  <span class="fas fa-envelope"></span>
              </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                </span>
                @enderror
                {!! Session::has('msg') ? Session::get("msg") : '' !!}
            </div>
        </div>
       
        <div class="row">
          <div class="col-8">
            
          </div>          
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-info btn-block">Continue</button>
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
        <a href="{{route('login')}}">Login Page</a>
      </p>      
    </div>
  </div>
</div>
</body>
</html>



                                {{-- <div class="form-group col-sm-6">
                                    <label>User Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" autocomplete="off" value="">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div> --}}
                                
