@extends("BackOffice/TemplateAdmin")

@section("contenu")
 <link href="{{ asset('css/Fiche.css') }}" rel="stylesheet">
<div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Compte administrateur</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
<div class="container-fluid">
                <div class="row">
                    
                            <h3 class="box-title" style="margin-top: 40px"></h3>
                            <div class="row column1">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2 style="font-weight: bold">Détails</h2>
                                 </div>
                              </div>
                              <div class="full price_table padding_infor_info">
                                 <div class="row">
                                    <!-- user profile section --> 
                                    <!-- profile image -->
                                    <div class="col-lg-12">
                                       <div class="full dis_flex center_text">
                                         <!--  <div class="profile_img"><img width="180" class="rounded-circle" src="{{ asset('plugins/images/users/varun.jpg') }}" alt="#" /></div> -->
                                          <div class="profile_contant">
                                             <div class="contact_inner">
                                                <h3>{{ $reponse[0]->nom }} {{ $reponse[0]->prenom }}</h3>
                                               
                                                <ul class="list-unstyled">
                                                   <li><i class="fas fa-envelope"></i> : {{ $reponse[0]->email }}</li>
                                                  
                                                </ul>
                                             </div>
                                             <div class="user_progress_bar">
                                             	<span class="skill" style="width:85%"><strong>Poste: </strong>  {{ $reponse[0]->nomposte }}</span>
      										    <span class="skill" style="width:85%"><strong>Direction: </strong>  {{ $reponse[0]->nomDirection }}</span>
      										    <span class="skill" style="width:85%"><strong>Rôle: </strong>   {{ $reponse[0]->nomrole }}</span>
      										    <span class="skill" style="width:85%"><strong>Compte: </strong>   {{ $reponse[0]->status }}</span>
      										    <span class="skill" style="width:85%"><strong>Mot de passe: </strong>   {{ $reponse[0]->password }}</span>
                                             </div>
                                          </div>
                                       </div>
                                       <!-- profile contant section -->
                                       <div class="full inner_elements margin_top_30">
                                          <div class="tab_style2">
                                             <div class="tabbar">
                                                <nav>
                                                   <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                      <a href="Comptes?Page=<?php echo $_GET['Page']; ?>" class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#recent_activity" role="tab" aria-selected="true" style="margin-left: 610px">Retour à la liste</a>
                                                     
                                                   </div>
                                                </nav>
                                               
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-2"></div>
                        </div>
                        <!-- end row -->
                     </div>
                           
                        </div>
                                    
               
            </div>

@endsection