<!DOCTYPE html>
<html>
<head>
  <title>Mp portal || Login</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/allcss">
  <link rel="stylesheet" href="{{asset('public/backend/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/backend/plugins/toastr/toastr.min.css')}}">  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.js"></script>
  <script src="{{asset('public/backend/plugins/toastr/toastr.min.js')}}"></script>
  <style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Numans');
    html,body{
      background-image: url("{{asset('public/background.jpg')}}");
      background-position: center;
      background-repeat: no-repeat;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
      font-family: 'Numans', sans-serif;
      height: 100%;
    }

    .container{
      height: 100%;
      align-content: center;
    }

    .card{
     height: 370px;
     margin-top: auto;
     margin-bottom: auto;
     width: 400px;
     background-color: rgb(11 56 178 / 32%) !important;
     border-radius: 25px;
   }

   .social_icon span{
    font-size: 60px;
    margin-left: 10px;
    color: #FFC312;
  }

  .social_icon span:hover{
    color: white;
    cursor: pointer;
  }

  .card-header h3{
    color: white;
  }

  .social_icon{
    position: absolute;
    right: 20px;
    top: -45px;
  }

  .input-group-prepend span{
    width: 50px;
    background-color: #FFC312;
    color: black;
    border:0 !important;
  }

  input:focus{
    outline: 0 0 0 0  !important;
    box-shadow: 0 0 0 0 !important;

  }

  .remember{
    color: white;
  }

  .remember input
  {
    width: 20px;
    height: 20px;
    margin-left: 15px;
    margin-right: 5px;
  }

  .login_btn{
    color: black;
    background-color: #FFC312;
    width: 100px;
    font-weight: bold;
  }

  .login_btn:hover{
    color: black;
    background-color: white;
  }

  .links{
    color: white;
  }

  .links a{
    margin-left: 4px;
  }

  .navbar-nav {
    flex-direction: column !important;
  }
  .navbar-expand-lg .navbar-toggler {
      display: block !important;
      position: fixed;
      left: 30px;
      top: 20px;
      transition-duration: 1s;
  }
  .navbar-expand-lg .navbar-toggler.open{
    display: block !important;
    left: 275px;
  }
  .navbar-expand-lg .navbar-collapse{
    display: block !important;
  }
  .offcanvas-collapse {
    position: fixed;
    width: 250px;
    top: 15px;
    bottom: 0;
    left:-250px;
    padding-right: 1rem;
    padding-left: 1rem;
    padding-top: 1rem;
    overflow-y: auto;
    visibility: hidden;
    background-color: #1a1335;
    color: #fff;
    font-size: 14px;
    transition-duration: 1s;
  }
  .offcanvas-collapse.open {
    visibility: visible;
    left:0px;
    display: block !important;
    
  }
  .dropdown-menu {
    width: 100%;
    background-color: #0d0b27;
    border-radius: 0;
  }
  .dropdown-item {
    font-size: 14px;
    padding-left: 10px;
    color: #fff;

  }
  .nav-link.dropdown-toggle{
    background: #2e1e4a;
  }
  .dropdown-toggle::after{
    right: 10px;
    position: absolute;
    top: 45%;
  }
</style>
</head>
<body>
  <div class="container-float">
    <div class="col-12" style="height: 15px;background: #f6ee23;margin-bottom: 10px;"></div>
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
      <div class="container-fluid">
        <button class="navbar-toggler p-0 border-0 mt-5" type="button" data-bs-toggle="offcanvas" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse offcanvas-collapse">
          <ul class="navbar-nav me-auto mb-lg-0">

            <li class="nav-item active dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">সিটিজেন</a>
              <ul class="dropdown-menu" aria-labelledby="dropdown01">
                <li><a class="dropdown-item" href="#"><i class="far fa-circle nav-icon"></i> পিটিশন আবেদন নিয়মাবলী</a></li>
                <li><a class="dropdown-item" href="{{route('petitions.index') }}"><i class="far fa-circle nav-icon"></i> পিটিশন আবেদন ফরম</a></li>
                <li><a class="dropdown-item" href="{{route('petitionsMonitoring') }}"><i class="far fa-circle nav-icon"></i> পিটিশন মনিটরিং</a></li>
                <li><a class="dropdown-item" href="{{route('citizen_appointment.index') }}"><i class="far fa-circle nav-icon"></i> এপয়েন্টমেন্ট অনুরোধ</a></li>
                <li><a class="dropdown-item" href="{{route('appointmentMonitoring') }}"><i class="far fa-circle nav-icon"></i> এপয়েন্টমেন্ট অনুরোধ মনিটরিং</a></li>
              
              </ul>
            </li>
            {{-- <li class="nav-item active dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">সিটিজেন এপয়েন্টমেন্ট</a>
              <ul class="dropdown-menu" >
                <li><a class="dropdown-item" href="{{route('citizen_appointment.index') }}"><i class="far fa-circle nav-icon"></i> এপয়েন্টমেন্ট অনুরোধ</a></li>
                <li><a class="dropdown-item" href="{{route('appointmentMonitoring') }}"><i class="far fa-circle nav-icon"></i> এপয়েন্টমেন্ট অনুরোধ মনিটরিং</a></li>
              </ul>
            </li> --}}

            
            {{-- <li class="nav-item active"> <a class="nav-link" href="#"><i class="far fa-circle nav-icon"></i> <span>পিটিশন আবেদন ফরম</span></a>
            </li> --}}

          </ul>
        </div>

      </div>
    </nav>
    <div class="col-12 text-center">
      <img src="{{asset('public/bangladesh_jatiya_sangsad_logo.jpg')}}" width="80px" alt="bangladesh_jatiya_sangsad_logo">
    </div>
    <div class="col-12 text-center text-white">
      <h3 style="font-weight: bold;">MP PORTAL AND ACTIVITY MANAGEMENT SYSTEM</h3>
    </div>
    <a id="sign_in" style="position: absolute;top: 72px;right: 41px;text-decoration: none;color: #007bff;cursor: pointer;">Login</a>
    <div class="d-none justify-content-center h-100 animate__animated" id="sign_in_div">
      <div class="card">
        <div class="card-header text-center" style="padding-bottom: 0px;">
          <img style="width: 55px;height: 60px;" src="{{asset('public/lock_logo.jpg')}}" alt="User Icon" />
        </div>
        <div class="card-body">
          <form id="submitForm">
            @csrf
            <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
              </div>
              <input type="email" name="email" class="email form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{old('email')}}">
              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
              </span>
              @enderror
            </div>
            <div class="input-group form-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
              </div>
              <input type="password" name="password" class="password form-control @error('password') is-invalid @enderror" placeholder="Password">
              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{$message}}</strong>
              </span>
              @enderror

            </div>
            <div class="row align-items-center remember">
              <input type="checkbox">Remember Me
            </div>
            <div class="form-group" style="margin-top: 5px;">
              <input type="submit" value="Login" class="btn btn-block login_btn">
            </div>
          </form>
        </div>
        <div class="card-footer">
          <div class="d-flex justify-content-center links">
            Forgot your password?<a href="#">Click Here</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12" style="height: 20px;background: #f6ee23;margin-bottom: 0px;bottom: 0;position: absolute;"></div>
  </div>
</body>
<script type="text/javascript">
  $(function(){
    $(document).on('click','#sign_in',function(){
      if($('#sign_in_div').hasClass('d-flex')){
        $('#sign_in_div').removeClass('animate__fadeInDown').addClass('animate__fadeOutUp');
      }else{
        $('#sign_in_div').removeClass('animate__fadeOutUp').addClass('d-flex animate__fadeInDown');
      }
    });

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

<script>
  $(document).ready(function(){
    $('#submitForm').validate({
      ignore:[],
      errorPlacement: function(error, element){
        if(element.hasClass("email")){error.insertAfter(element.parents('.input-group')); }
        else if(element.hasClass("password")){error.insertAfter(element.parents('.input-group')); }
        else{error.insertAfter(element);}
      },
      errorClass:'text-danger',
      validClass:'text-success',

      submitHandler: function (form) {
        event.preventDefault();
        $('[type="submit"]').attr('disabled','disabled').css('cursor','not-allowed');
        var formInfo = new FormData($("#submitForm")[0]);
        $.ajax({
          url : "{{route('login')}}",
          data : formInfo,
          type : "POST",
          processData: false,
          contentType: false,
          beforeSend : function(){
            $('.preload').show();
          },
          success:function(data){
            $('#toast-container').html('');
            if(data.status == 'success'){
              toastr.success("",data.message);
              $('.preload').hide();
              setTimeout(function(){
                location.replace("{{route('login')}}");
              }, 1000);
            }else if(data.status == 'error'){
              toastr.error("",data.message);
              $('[type="submit"]').removeAttr('disabled').css('cursor','pointer');
              $('.preload').hide();
            }else{
              toastr.error('দুঃখিত !!সফটওয়্যার মেইনটেনেন্স সমস্যার কারনে তথ্য সংরক্ষন করা যাচ্ছে না। আপনি রিলোড না নিয়ে সংশিষ্ট সাপোর্ট ইঞ্জিনিয়ারকে জানান ', {globalPosition: 'top right',className: 'error',autoHideDelay:10000});
              $('[type="submit"]').removeAttr('disabled').css('cursor','pointer');
              $('.preload').hide();
            }
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            toastr.error('দুঃখিত !!সফটওয়্যার মেইনটেনেন্স সমস্যার কারনে তথ্য সংরক্ষন করা যাচ্ছে না। আপনি রিলোড না নিয়ে সংশিষ্ট সাপোর্ট ইঞ্জিনিয়ারকে জানান ', {globalPosition: 'top right',className: 'error',autoHideDelay:10000});
            $('[type="submit"]').removeAttr('disabled').css('cursor','pointer');
            $('.preload').hide();
          }
        });
      }
    });

    jQuery.validator.addClassRules({
      'email' : {
        required : true
      },
      'password' : {
        required : true
      }
    });
  });


  (function navScript() {
      "use strict";
      const offcanvasToggle = document.querySelector(
        '[data-bs-toggle="offcanvas"]',
      );


      const dropdownToggle = document.querySelector(
        '[data-bs-toggle="dropdown"]',
      );

      const offcanvasCollapse = document.querySelector(".offcanvas-collapse");
      const dropdownMenu = document.querySelector(".dropdown-menu");

      offcanvasToggle.addEventListener("click", function () {
        offcanvasCollapse.classList.toggle("open");
        offcanvasToggle.classList.toggle("open");
      });
      dropdownToggle.addEventListener("click", function () {
        dropdownMenu.classList.toggle("show");
        dropdownToggle.setAttribute("aria-expanded", "true");
        
      });

    })();
</script>

</html>