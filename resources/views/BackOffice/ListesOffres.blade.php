@extends("BackOffice/TemplateAdmin")
@inject('carbon','Carbon\Carbon')
@section("contenu")
<div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Listes des offres créées</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                       
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
          
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                             <h3 class="box-title" style="color: #286ac7">Offres</h3>
                            <!-- <p class="text-muted"><code>Offres sur les enquêtes</code></p> -->
                            <div class="table-responsive">
                                 <table id="compt_table" class="table table-bordered table-hover">
                               <!--  <table class="table text-nowrap"> -->
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Enquête</th>
                                            <th class="border-top-0">Date Debut</th>
                                            <th class="border-top-0">Date limite</th>
                                            <th class="border-top-0">Responsable</th>
                                            <th class="border-top-0">Poste</th>
                                            <th class="border-top-0">Role</th>
                                            <th class="border-top-0">Action</th>
                                            <th class="border-top-0"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                
                                        @foreach($listes as $list)
                                        <tr>
                                            <td style="color: #286ac7;font-weight: bold">{{ $list->nomEnquete }}</td>
                                            <td>{{ $carbon::parse($list->dateDebut)->translatedFormat('d-m-Y à H\hi') }}</td>
                                            <td>{{ $carbon::parse($list->dateLimite)->translatedFormat('d-m-Y à H\hi') }}</td>
                                            <td>{{ $list->nom }} {{ $list->prenom }}</td>
                                            <td>{{ $list->nomposte }}</td>                                 
                                            <td>{{ $list->nomrole }}</td>    
                                            <td><a href="ModificationOffre?idOffre=<?php echo $list->idOffres ?>" title="Modifier" id="show" 
                                                data-action=""
                                                data-id=""
                                                data-name="" 
                                                data-is_collection=3
                                                data-title="Modifier" style="color:#36698a;margin-top:8px">        
                                                <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                            </a>
                                            &nbsp;
                                            <a href="DetailsOffres?idOffre=<?php echo $list->idOffres ?>&&Page=1" title="Voir détails" id="show" 
                                            data-action=""
                                            data-id=""
                                            data-name="" 
                                            data-is_collection=3
                                            data-title="voir détails" style="color:#36698a;margin-top:8px" > 
                                            <i class="fas fa-eye" aria-hidden="true"></i>
                                            </a>
                                            </td>
                                            <td>
                                                <?php if($list->statusOffres=="Non publie"){ ?>
                                                <a href="ModificationStatusOffres?idOffre=<?php echo $list->idOffres ?>&&Page=<?php echo $_GET['Page'] ?>"><button type="submit" class="btn btn-secondary">Publier</button></a>
                                                <?php } if($list->statusOffres=="publie"){ ?>
                                                <a href="#" class="btn btn-secondary disabled" tabindex="-1" role="button" aria-disabled="true">Offre publié</a>
                                                <?php } ?>
                                            </td>       
                                            <!-- <td><button type="submit" class="btn btn-primary">voir détails Enquete <i class="fas fa-arrow-circle-right" aria-hidden="true" style="margin-left: 5px"></i></button></td> -->
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end">
                                      <!-- <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Précédent</a>
                                      </li> -->
                                        <li class="page-item">
                                        <a class="page-link" href="#">Précédent</a>
                                      </li>
                                       <?php for($i=1;$i<=$numberPage;$i++) { ?>
                                       <?php if(isset($_GET['Page']) && $_GET['Page']==$i) { ?>
                                      <li class="page-item active"><a class="page-link" href="Acceuil?Page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                        <?php } else { ?>
                                         <li class="page-item"><a class="page-link" href="Acceuil?Page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                         <?php } } ?>
                                      <li class="page-item">
                                        <a class="page-link" href="#">Suivant</a>
                                      </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                
               
            </div>
@endsection