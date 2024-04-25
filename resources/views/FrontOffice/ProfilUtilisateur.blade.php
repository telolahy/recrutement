@extends("FrontOffice/TemplateUtilisateur")
<script src="{{ asset('js/jQuery.js') }}"></script>
@section("contenuFront")
<div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Profil de l'utilisateur</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="text-right upgrade-btn">
                            
                        </div>
                    </div>
                </div>
            </div>
<div class="container-fluid">
	<div class="row">
                    <!-- Column -->
                    @foreach($ficheEnqueteurs as $f)
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> <img src="{{ asset('ProfilEnqueteur/'.$f->photo) }}" class="rounded-circle" width="150" />
                                    <h4 class="card-title m-t-10">{{ $f->nom }} {{ $f->prenom }}</h4>
                                    <h6 class="card-subtitle">{{ $f->email }}</h6>
                                    
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body">
                                <h5 style="margin-bottom: 20px">Modification de mon mot de passe</h5>
                                <form action="{{ route('ModificationMotDePasse') }}"  method="POST" enctype="multipart/form-data"  class="form-horizontal form-material">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-md-12" style="color:#4fc3f7;font-weight: bold">Mot de passe actuel : </label>
                                        <div class="col-md-12">
                                            <input type="password" name="motdepasseActuel" class="form-control form-control-line" value="{{ old('motdepasseActuel') }}" id="motdepasseActuel">
                                            <span toggle="#motdepasseActuel" class="fa fa-eye field-icon toggle-password" style="margin-left: 330px; cursor: pointer;margin-top:-24px"></span>
                                        </div>
                                    </div>
                                    @error('motdepasseActuel')
                                    <small class="invalid-feedback" id="error" style="margin-left:20px">{{ $message }}</small>
                                    @enderror
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12" style="color:#4fc3f7;font-weight: bold">Nouveau mot de passe : </label>
                                        <div class="col-md-12">
                                            <input type="password" placeholder="" class="form-control form-control-line" name="nouveauMotdepasse" value="{{ old('nouveauMotdepasse') }}" id="nouveauMotdepasse">
                                            <span toggle="#nouveauMotdepasse" class="fa fa-eye field-icon toggle-password" style="margin-left: 330px; cursor: pointer;margin-top:-24px"></span>
                                        </div>
                                    </div>
                                    @error('nouveauMotdepasse')
                                    <small class="invalid-feedback" id="error" style="margin-left:20px">{{ $message }}</small>
                                    @enderror
                                    <div class="form-group">
                                        <label class="col-md-12" style="color:#4fc3f7;font-weight: bold">Confirmation du nouveau mot de passe :</label>
                                        <div class="col-md-12">
                                            <input type="password" name="confirmationMotdepasse" class="form-control form-control-line" value="{{ old('confirmationMotdepasse') }}" id="confirmationMotdepasse">
                                            <span toggle="#confirmationMotdepasse" class="fa fa-eye field-icon toggle-password" style="margin-left: 330px; cursor: pointer;margin-top:-50px"></span>
                                        </div>
                                    </div>
                                    @error('confirmationMotdepasse')
                                    <small class="invalid-feedback" id="error" style="margin-left:20px">{{ $message }}</small>
                                    @enderror
                                     <button type="submit" class="btn btn-secondary" style="margin-left:10px">Modifier mon mot de passe</button>
                                     <?php if(isset($notif)){ ?>
                                        <div class="row" style="margin-top:20px">
                                                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                                <div class="white-box">
                                          <div class="alert alert-success" role="alert">
                                              <?php echo $notif; ?>
                                          </div>
                                       </div>
                                      </div>
                                    </div>
                                    <?php } ?>
                                    <?php if(isset($erreur)){ ?>
                                        <div class="row" style="margin-top:20px">
                                                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                                <div class="white-box">
                                          <div class="alert alert-danger" role="alert">
                                              <?php echo $erreur; ?>
                                          </div>
                                       </div>
                                      </div>
                                    </div>
                                    <?php } ?>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                           
                                        </div>
                                    </div>
                                </form> 
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('ModificationProfilUtilisateur') }}"  method="POST" enctype="multipart/form-data"  class="form-horizontal form-material">
                                    @csrf
                                    <div class="form-group">
                                        <label class="col-md-12" style="color:#4fc3f7;font-weight: bold">Nom </label>
                                        <div class="col-md-12">
                                            <input type="text" name="nom" class="form-control form-control-line" value="{{ $f->nom }}" spellcheck="false">
                                        </div>
                                    </div>
                                    @error('nom')
                                    <small class="invalid-feedback" id="error">{{ $message }}</small>
                                    @enderror
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12" style="color:#4fc3f7;font-weight: bold">Prenom</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="" class="form-control form-control-line" name="prenom" value="{{ $f->prenom }}" spellcheck="false">
                                        </div>
                                    </div>
                                    @error('prenom')
                                    <small class="invalid-feedback" id="error">{{ $message }}</small>
                                    @enderror
                                    <div class="form-group">
                                        <label class="col-md-12" style="color:#4fc3f7;font-weight: bold">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" name="email" value="{{ $f->email }}" class="form-control form-control-line" spellcheck="false">
                                        </div>
                                    </div>
                                    @error('email')
                                    <small class="invalid-feedback" id="error">{{ $message }}</small>
                                    @enderror
                                    <div class="form-group">
                                        <label class="col-md-12" style="color:#4fc3f7;font-weight: bold">Date de Naissance</label>
                                        <div class="col-md-12">
                                             <input type="date" name="dateNaissance" placeholder="" value="{{ $f->dateNaissance }}" class="form-control form-control-line" spellcheck="false">
                                        </div>
                                    </div>
                                    @error('dateNaissance')
                                    <small class="invalid-feedback" id="error">{{ $message }}</small>
                                    @enderror
                                    <div class="form-group">
                                        <label class="col-sm-12" style="color:#4fc3f7;font-weight: bold">Photo</label>
                                        <div class="col-sm-12" style="margin-left: 10px;width: 795px">
                                             <input type="file" class="custom-file-input" id="customFile" name="photo" spellcheck="false">
                                             <label class="custom-file-label" for="customFile">{{ $f->photo }}</label>
                                        </div>
                                    </div>
                                    @error('photo')
                                    <small class="invalid-feedback" id="error">{{ $message }}</small>
                                    @enderror
                                    <div class="form-group">
                                        <label class="col-md-12" style="color:#4fc3f7;font-weight: bold">Diplomes</label>
                                        <div class="col-md-12">
                                            <textarea rows="5" name="diplomes" class="form-control form-control-line" spellcheck="false">{{ $f->diplomes }}</textarea>
                                        </div>
                                    </div>
                                    @error('diplomes')
                                    <small class="invalid-feedback" id="error">{{ $message }}</small>
                                    @enderror
                                    <div class="form-group">
                                        <label class="col-md-12" style="color:#4fc3f7;font-weight: bold">Expériences</label>
                                        <div class="col-md-12">
                                            <textarea rows="5" name="experiences" class="form-control form-control-line" spellcheck="false">{{ $f->experiences }}</textarea>
                                        </div>
                                    </div>
                                     <button type="submit" class="btn btn-secondary" style="margin-left:10px">Modifier mon profil</button>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                           
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!-- Column -->
                </div>
                 </div>
                 <script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var photo = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(photo);
});
</script>
<script type="text/javascript">
    $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>
@endsection

<!-- <div class="form-group">
    <label class="col-md-12" style="color:#4fc3f7;font-weight: bold">Votre mot de passe</label>
        <div class="col-md-12">
            <input type="password" name="password" placeholder="" value="" class="form-control form-control-line">
        </div>
</div>
<div class="form-group">
    <label class="col-md-12" style="color:#4fc3f7;font-weight: bold">Confirmation de votre mot de passe</label>
    <div class="col-md-12">
        <input type="password" name="confirmpassword" placeholder="" value="" class="form-control form-control-line">
    </div>
</div> -->