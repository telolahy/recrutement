<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('plugins/images/logInstat.png') }}">
  <title>Login Recruteur</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/CssLoginAdmin/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/CssLoginAdmin/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/CssLoginAdmin/fonts/iconic/css/material-design-iconic-font.min.css') }}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/CssLoginAdmin/vendor/animate/animate.css') }}">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/CssLoginAdmin/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/CssLoginAdmin/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/CssLoginAdmin/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/CssLoginAdmin/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/CssLoginAdmin/css/util.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/CssLoginAdmin/css/main.css') }}">
</head>
<style type="text/css">
  .invalid-feedback{
  display: inline-block;
  color: red;
  font-weight: bold;
  margin-left:10px
}
</style>
<body>
  
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
            @csrf
          <span class="login100-form-title p-b-26">
            <img src="{{ asset('plugins/images/instatkely.png') }}" class="rounded-circle" width="110px" style="margin-top: -20px" />
          </span>
          <span class="login100-form-title p-b-48">
            Login Recruteur
          </span>
          <div class="wrap-input100 validate-input" data-validate="veuillez entrer email">
            <input class="input100" type="email" name="email" :value="{{ old('email') }}" spellcheck="false">
            <span class="focus-input100" data-placeholder="Email"></span>
          </div>
           @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
                </span>
          @endif

          <div class="wrap-input100 validate-input" data-validate="veuillez entrer votre mot de passe">
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <input class="input100" type="password" name="password" autocomplete="current-password" spellcheck="false">
            <span class="focus-input100" data-placeholder="Mot de passe"></span>
          </div>
          @if ($errors->has('password'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif

          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button type="submit" class="login100-form-btn">
                Se connecter
              </button>
            </div>
          </div>
        </form>
        <?php if(isset($notif)){ ?>
              <span class="invalid-feedback" role="alert" style="margin-top: 20px">
                  <strong style="margin-left:30px"><?php echo $notif; ?></strong>
              </span>
        <?php } ?>
      </div>
    </div>
  </div>
  

  <div id="dropDownSelect1"></div>
  <!-- <a href="{{ route('DemandeOffres') }}"><button type="submit" class="btn btn-primary">Demande Offre</button></a> -->
<script src="{{ asset('plugins/CssLoginAdmin/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
  <script src="{{ asset('plugins/CssLoginAdmin/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
  <script src="{{ asset('plugins/CssLoginAdmin/vendor/bootstrap/js/popper.js') }}"></script>
  <script src="{{ asset('plugins/CssLoginAdmin/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
  <script src="{{ asset('plugins/CssLoginAdmin/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
  <script src="{{ asset('plugins/CssLoginAdmin/vendor/daterangepicker/moment.min.js') }}"></script>
  <script src="{{ asset('plugins/CssLoginAdmin/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
  <script src="{{ asset('plugins/CssLoginAdmin/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
  <script src="{{ asset('plugins/CssLoginAdmin/js/main.js') }}"></script>

</body>
</html>