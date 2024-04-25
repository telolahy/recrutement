<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Loding font -->
    <link href="https://code.jquery.com/jquery-3.3.1.slim.min.js" rel="stylesheet">

    <!-- Custom Styles -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
     <link href=" https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js" rel="stylesheet">
   
    <!-- <link rel="stylesheet" type="text/css" href="./styles.css"> -->

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('plugins/images/logInstat.png') }}">
    <title>Login des enqueteurs</title>
  </head>
<style type="text/css">
    .login,
.image {
  min-height: 100vh;
}

.bg-image {
  background-image: url('{{ asset('plugins/images/image5.jpg') }}');
  background-size: cover;
  background-position: center center;
}
.btn-secondary {
    color: #fff;
    background-color: #2C495C;
    border-color: #638eab;
}

/*.btn-outline-info {
    color: #17a2b8;
    border-color: #17a2b8;
}*/

</style>
<body>
<div class="container-fluid">
    <div class="row no-gutter">
        <!-- The image half -->
        <div class="col-md-6 d-none d-md-flex bg-image"></div>


        <!-- The content half -->
        <div class="col-md-6 bg-light" style="width: 100%;height:790px">
            <div class="login d-flex align-items-center py-5">

                <!-- Demo content-->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-xl-7 mx-auto">
                            <!-- <span class="login100-form-title p-b-26">
                                <img src="{{ asset('plugins/images/logInstat.png') }}" width="110px" style="margin-left:120px" />
                            </span> -->
                            <h5 class="display-4">Recrutement sur les offres emplois</h5>
                            <p class="text-muted mb-4">Login pour les candidats</p>
                            <form method="POST" action="{{ route('traitementLogin') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <input id="inputEmail" type="email" placeholder="Email" autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4" name="email" required="required" spellcheck="false">
                                </div>
                                <div class="form-group mb-3">
                                    <input id="inputPassword" type="password" placeholder="Mot de passe" class="form-control rounded-pill border-0 shadow-sm px-4 text-dark" name="password" required="required" spellcheck="false">
                                     
                                </div>
                                <!-- <div class="custom-control custom-checkbox mb-3">
                                    <input id="customCheck1" type="checkbox" class="custom-control-input">
                                    <label for="customCheck1" class="custom-control-label">Mémoriser le mot de passe</label>
                                </div> -->
                                <?php if(isset($erreur)){ ?>
                                <div class="row">
                                   <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                   <div class="white-box">
                                      <div class="alert alert-danger" role="alert">
                                          <?php echo $erreur; ?>
                                      </div>
                                   </div>
                                  </div>
                                </div>
                                <?php } ?>
                                <button type="submit" class="btn btn-secondary btn-block mb-2 rounded-pill shadow-sm">Se connecter</button>
                                <span style="margin-top:5px;margin-left:200px">ou</span>
                                
                               <!--  <div class="text-center d-flex justify-content-between mt-4"><p>Snippet by <a href="https://bootstrapious.com/snippets" class="font-italic text-muted"> 
                                        <u>Boostrapious</u></a></p></div> -->
                            </form>
                           <a href="{{ route('inscription') }}" style="text-decoration: none"><button type="submit" class="btn btn-outline-info btn-block mb-2 rounded-pill shadow-sm" style="margin-top:6px">s'inscrire</button></a>
                        </div>
                    </div>
                </div><!-- End -->

            </div>
        </div><!-- End -->

    </div>
</div>
</body>
</html>
