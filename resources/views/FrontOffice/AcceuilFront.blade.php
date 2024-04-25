 @extends("FrontOffice/TemplateUtilisateur")
 @section("contenuFront")
@inject('carbon','Carbon\Carbon')
<div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title" style="">Recrutements des agents enqueteurs</h4>
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
                    <!-- column -->
                    <div class="col-lg-12">
                        
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="font-weight: bold;">Listes des offres d'emplois</h4>
                            </div>
                            @foreach($listeoffres as $list)
                            <div class="comment-widgets scrollable">
                                <!-- Comment Row -->
                                <div class="d-flex flex-row comment-row m-t-0">
                                    <div class="p-2"> </div>
                                    <div class="comment-text w-100">
                                        <h5 class="font-medium" style="font-weight: bold">{{ $list->nomEnquete }}</h5>
                                        <span class="m-b-15 d-block"> </span>
                                        <div class="comment-footer">
                                            
                                            <?php if($list->statusDateOffre=="cette offre a atteint la date limite") { ?>

                                               <span class="m-b-15 d-block" style="color:red;font-weight:bold"><?php echo $list->statusDateOffre; ?></span>
                                             
                                              <?php } else { ?>
                                                  <span class="m-b-15 d-block" style="color:#4fc3f7;font-weight: bold">Date Limite :</span> <span class="m-b-15 d-block" style="margin-left:85px;margin-top: -35px">{{ $carbon::parse($list->dateLimite)->translatedFormat('d F Y à H\hi') }}</span>
                                              <?php } ?>   

                                        <div class="comment-footer">
                                            <span class="text-muted float-right">crée le {{ $carbon::parse($list->dateDebut)->translatedFormat('d F Y') }}</span> 
                                            <a href="/DetailsOffre?idOffre={{ $list->id }}&&Page=<?php echo $_GET['Page'] ?>"><button type="button" class="btn btn-secondary" style="border-radius:50px">Détails offres</button></a>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                     <hr class="g-border-gray-lighten-2">
                                
                            </div>
                            @endforeach
                             <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end">
                                    
                                        <li class="page-item">
                                        <a class="page-link" href="#">Précédent</a>
                                      </li>
                                       <?php for($i=1;$i<=$numberPage;$i++) { ?>
                                       <?php if(isset($_GET['Page']) && $_GET['Page']==$i) { ?>
                                      <li class="page-item active"><a class="page-link" href="ListesOffres?Page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                        <?php } else { ?>
                                         <li class="page-item"><a class="page-link" href="ListesOffres?Page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                         <?php } } ?>
                                      <li class="page-item">
                                        <a class="page-link" href="#">Suivant</a>
                                    </ul>
                                </nav>
                        </div>
                    </div>
                    <!-- column -->
                    
                </div>
       </div>        
@endsection
<script src="{{ asset('CssUtilisateur/libs/jquery/dist/jquery.min.js') }}"></script>