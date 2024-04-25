@extends("FrontOffice/TemplateUtilisateur")
@section("contenuFront")
@inject('carbon','Carbon\Carbon')
<div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title" style="font-family: 'Quicksand', sans-serif;">Recrutements des agents enqueteurs</h4>
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
<div class="card">
	<div class="row">
         <div class="col-lg-12">
         	  <div class="card-body">
                 @foreach($detailsOffres as $details)
                                <h4 class="card-title" style="font-weight: bold">Détails de l'offre concernant {{ $details->nomEnquete }}</h4>
                            </div>
                                <div class="d-flex flex-row comment-row m-t-0">
                                    <div class="p-2"> </div>
                                    <div class="comment-text w-100">
                                        <h5 class="font-medium" style="font-weight: bold;color:#4fc3f7">{{ $details->nomEnquete }}</h5>
                                        <hr class="g-border-gray-lighten-2">
                                        <h6 class="font-medium" style="font-weight:bold">Date Limite :</h6>
                                        <span class="m-b-15 d-block" style="margin-left:89px;margin-top: -28px">{{ $carbon::parse($details->dateLimite)->translatedFormat('d F Y à H\hi') }}</span>
                                        <hr class="g-border-gray-lighten-2">
                                         <h6 class="font-medium" style="font-weight: bold">Description :</h6>
                                         
                                        <!-- <div class="comment-footer">
                                            
                                             <span class="m-b-15 d-block"></span>hhhh <span class="m-b-15 d-block" style="margin-left:85px;margin-top: -35px"></span>
                                        <div class="comment-footer">
                                            <span class="text-muted float-right"></span> 
                                            <a href=""><button type="button" class="btn btn-secondary">Postuler</button></a>
                                        </div>
                                        </div> -->
                                    </div>

                                </div>
                                 <div class="ll" style="margin-left: 50px"><?php  echo $details->detailsEnquete; ?></div>
                                 <?php if($details->statusDateOffre=="Postule") { ?>
                                 <a href="/formulaireOffres?idOffre=<?php echo $_GET['idOffre']; ?>&&Page=<?php echo $_GET['Page'] ;?>"><button type="button" class="btn btn-secondary" id="bt" style="margin-top: 20px;margin-left:30px">Postuler</button></a>
                                  <?php } else { ?>
                                 <a href="#" class="btn btn-secondary disabled"  style="margin-top: 20px;margin-left:30px" tabindex="-1" role="button" aria-disabled="true">Postuler</a>
                                  <?php } ?>
                                 <a href="ListesOffres?Page=<?php echo $_GET['Page'] ;?>"><button type="button" class="btn btn-secondary" style="margin-top: 20px;margin-left:25px">Retour à la liste</button></a>
                                <br>
                            </br>
                                @endforeach
                                    
                                 
                            </div>
    	</div>
    </div>
     </div>
@endsection
<script src="{{ asset('CssUtilisateur/libs/jquery/dist/jquery.min.js') }}"></script>
<script type="text/javascript">
    $(document).on('click',"#bt",function(e){
        localStorage.setItem('valeur',0);
    });
</script>