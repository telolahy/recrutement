@extends("BackOffice/TemplateAdmin")

@section("contenu")

<div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Nouvel Administrateur</h4>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="container-fluid">
               
                <div class="row">
                    <!-- Column -->
                    
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        
                        <div class="card">
                            <div class="card-body">
                            
                                <form class="form-horizontal form-material" action="{{ route('traitementAdmin') }}" method="POST">
                                     @csrf
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0" style="font-weight: bold">Nom :</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" placeholder="Nom"
                                                class="form-control p-0 border-0" name="nom" required="required" spellcheck="false"> </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="example-email" class="col-md-12 p-0" style="font-weight: bold">Prenom :</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="text" placeholder="Prenom" name="prenom" 
                                                class="form-control p-0 border-0" name="example-email"
                                                id="example-email" required="required" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0" style="font-weight: bold">Email :</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            <input type="email" class="form-control p-0 border-0" placeholder="Email" name="email" required="required" spellcheck="false">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0" style="font-weight: bold">Mot de passe :</label>
                                        <div class="col-md-12 border-bottom p-0">

                                            <input type="password" placeholder="Mot de Passe"
                                                class="form-control p-0 border-0" name="password" required="required" spellcheck="false" id="password">
                                                
                                              
                                        </div>

                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0" style="font-weight: bold">Role :</label>
                                        <div class="col-md-12 border-bottom p-0">
                                            @if (Session::get('nomrole')=="Super Admin")
                                                <select name="idRole" class="form-select shadow-none p-0 border-0 form-control-line">

                                                @foreach($listrole as $role)
                                                <option @if ($role->nomrole =="Admin"){{ 'selected="selected"' }}  @endif value="{{ $role->id }}">{{ $role->nomrole }}</option>
                                                @endforeach
                                            </select>
                                            @endif

                                            @if (Session::get('nomrole')=="Admin")
                                                <select name="idRole" class="form-select shadow-none p-0 border-0 form-control-line">

                                                @foreach($listrole as $role)
                                                <option value="{{ $role->id }}">{{ $role->nomrole }}</option>
                                                @endforeach
                                            </select>

                                            @endif
                                             
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-sm-12" style="font-weight: bold">Poste :</label>
                                        @if (Session::get('nomrole')=="Super Admin")
                                                <select name="idPoste" class="form-select shadow-none p-0 border-0 form-control-line">
                                                @foreach($listpost as $poste)
                                                <option @if ($poste->nomposte =="Directeur"){{ 'selected="selected"' }}  @endif value="{{ $poste->id }}">{{ $poste->nomposte }}</option>
                                                @endforeach
                                            </select>
                                            @endif

                                          @if (Session::get('nomrole')=="Admin")
                                        <div class="col-sm-12 border-bottom">
                                            <select name="idPoste" class="form-select shadow-none p-0 border-0 form-control-line">
                                                @foreach($listpost as $poste)
                                                <option value="{{ $poste->id }}">{{ $poste->nomposte }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                         @endif
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-sm-12" style="font-weight: bold">Direction :</label>
                                        <div class="col-md-12 border-bottom p-0">
                                             <select name="idDirection" class="form-select shadow-none p-0 border-0 form-control-line">
                                                @foreach($listDirection as $direction)
                                                <option value="{{ $direction->id }}">{{ $direction->nomDirection }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group mb-4">
                                        <div class="col-sm-12">
                                            <button class="btn btn-primary" style="margin-left: 1000px;width:250px">Ajouter</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>

@endsection