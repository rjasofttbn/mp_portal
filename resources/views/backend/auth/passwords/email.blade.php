@extends('layouts.auth')

@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Project</b> Discussion</a>
  </div>  
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Reset Your Password</p>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
      <form action="{{route('password.email')}}" method="post">
        <div class="form-group @error('email') has-error @enderror">
            <div class="input-group mb-3">
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
              <div class="input-group-append input-group-text">
                  <span class="fas fa-envelope"></span>
              </div>
              @error('email')
              <span class="inavlid-feedback">
                  <strong>{{$message}}</strong>
              </span>
              @enderror
            </div>
        </div>        
        <div class="row">          
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Send Password Reset Link</button>
          </div>          
        </div>
      </form>
      <p class="mb-1">
        <a href="{{route('login')}}">Login</a>
      </p>      
    </div>    
  </div>
</div>
@endsection
