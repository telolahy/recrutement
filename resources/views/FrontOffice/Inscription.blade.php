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
     <!-- <link href=" https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js" rel="stylesheet"> -->
    <script src="{{ asset('js/jQuery.js') }}"></script>
    <!-- <link rel="stylesheet" type="text/css" href="./styles.css"> -->

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('plugins/images/logInstat.png') }}">
    <title>Inscription</title>
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
.btn-outline-info {
    color: #17a2b8;
    border-color: #17a2b8;
}
.btn-info{
    color:white;
    border-color: white;
}
.invalid-feedback{
  display: inline-block;
  color: red;
  font-weight: bold;
  margin-left:150px
}
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
                        <div class="col-lg-10 col-xl-11 mx-auto">
                            <h5 class="display-4">Inscription</h5>
                            <p class="text-muted mb-4">Inscription pour les nouveaux candidats</p>
                            <form method="POST" action="{{ route('TraitementInscription') }}"  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                     <label for="exampleInputPassword1">Nom:</label>
                                    <input id="inputnom" type="text" placeholder="Nom" autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4" name="nom" value="{{ old('nom') }}" spellcheck="false" style="margin-left:120px;margin-top: -40px;width:550px">
                                </div>
                                @error('nom')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                                 <div class="form-group mb-3">
                                    <label for="exampleInputPassword1" style="margin-top:15px">Prenom:</label>
                                    <input id="inputprenom" type="text" placeholder="Prenom" autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4" name="prenom" value="{{ old('prenom') }}" spellcheck="false" style="margin-left:120px;margin-top: -40px;width:550px">
                                </div>
                                @error('prenom')
                                  <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                                 <div class="form-group mb-3">
                                     <label for="inputdateNaissance" style="margin-top:15px">Date Naissance:</label>
                                    <input id="inputdateNaissance" type="date" placeholder="Date de Naissance" autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4" name="dateNaissance" value="{{ old('dateNaissance') }}" spellcheck="false" style="margin-left:120px;margin-top: -40px;width:550px">
                                </div>
                                 @error('dateNaissance')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                 @enderror
                                 <div class="form-group mb-3">
                                     <label for="exampleInputPassword1" style="margin-top:15px">Email:</label>
                                    <input id="inputEmail" type="email" placeholder="Email" autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4" name="email" value="{{ old('email') }}" spellcheck="false" style="margin-left:120px;margin-top: -40px;width:550px">
                                </div>
                                @error('email')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                                <div class="form-group mb-3">
                                     <label for="exampleInputPassword1" style="margin-top:15px">Mot de passe:</label>
                                    <input id="inputPassword" type="password" placeholder="Mot de passe" class="form-control rounded-pill border-0 shadow-sm px-4 text-dark" name="password" value="{{ old('password') }}" spellcheck="false" style="margin-left:120px;margin-top: -40px;width:550px">
                                     
                                </div>
                                @error('password')
                                  <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                                 <div class="form-group mb-3">
                                     <label for="exampleInputPassword1" style="margin-top:15px">Photos:</label>
                                     <div class="col-sm-12" style="margin-left:120px;margin-top: -40px;width:550px;border-radius:30px">
                                             <input type="file" class="custom-file-input" id="customFile" name="photo" spellcheck="false">
                                             <label class="custom-file-label" for="customFile"></label>
                                        </div>
                                     
                                    <!-- <input id="inputEmail" type="email" placeholder="photos" autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4" name="photo" value="{{ old('photo') }}" spellcheck="false" style="margin-left:120px;margin-top: -40px;width:550px"> -->
                                </div>
                                @error('photo')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                                 <div class="form-group mb-3">
                                     <label for="exampleInputPassword1" style="margin-top:15px">Diplomes:</label>
                                    <textarea  class="form-control rounded-pill border-0 shadow-sm px-4" name="Diplome" placeholder="diplomes" value="{{ old('Diplome') }}" spellcheck="false" style="margin-left:120px;margin-top: -40px;width:550px;height: 70px"></textarea>
                                </div>
                                @error('Diplome')
                                  <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                                 <div class="form-group mb-3">
                                     <label for="exampleInputPassword1" style="margin-top:15px">Expériences:</label>
                                    <textarea class="form-control rounded-pill border-0 shadow-sm px-4" name="experience" placeholder="expériences" spellcheck="false" style="margin-left:120px;margin-top: -40px;width:550px;height: 80px"></textarea>
                                </div>
                                <button type="submit" class="btn btn-secondary btn-block mb-2 rounded-pill shadow-sm" style="margin-left:120px;width: 550px;margin-top: 20px">S'inscrire</button>
                                
                               
                            </form>
                            <!-- <span style="margin-top:5px;margin-left:390px">ou</span>
                            <a href="" style="text-decoration: none"><button type="submit" class="btn btn-outline-info btn-block mb-2 rounded-pill shadow-sm" style="margin-left:120px;width: 550px;margin-top: 10px">se connecter</button></a> -->
                        </div>
                    </div>
                </div><!-- End -->

            </div>
        </div><!-- End -->

    </div>
</div>
</body>
</html>
<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var photo = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(photo);
});
</script>