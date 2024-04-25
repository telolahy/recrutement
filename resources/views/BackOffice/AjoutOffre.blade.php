@extends("BackOffice/TemplateAdmin")

  <script src="{{ asset('js/jQuery.js') }}"></script>


@section("contenu")
<style>

    * {
  user-select: none;
  -webkit-tap-highlight-color: transparent;
}

*:focus {
  outline: none;
}



#app-cover {
  display: table;
  width: 600px;
  margin: 80px auto;
  counter-reset: button-counter;
}


.toggle-button-cover {
  display: table-cell;
  position: relative;
  width: 50px;
  height: 30px;
  box-sizing: border-box;
}

/*.button-cover {
  height: 100px;
  margin: 20px;
  background-color: #fff;
  box-shadow: 0 10px 20px -8px #c5d6d6;
  border-radius: 4px;
}*/

.button-cover:before {
  counter-increment: button-counter;
  content: counter(button-counter);
  position: absolute;
  right: 0;
  bottom: 0;
  color: #d7e3e3;
  font-size: 12px;
  line-height: 1;
  padding: 5px;
}

.button-cover,
.knobs,
.layer {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
}

.button {
  position: relative;
  top: 50%;
  width: 120px;
  height: 36px;
  margin: -20px auto 0 auto;
  overflow: hidden;
}

.button.r,
.button.r .layer {
  border-radius: 100px;
}

.button.b2 {
  border-radius: 2px;
}

.checkbox {
  position: relative;
  width: 100%;
  height: 100%;
  padding: 0;
  margin: 0;
  opacity: 0;
  cursor: pointer;
  z-index: 3;
}

.knobs {
  z-index: 2;
}

.layer {
  width: 100%;
  background-color: #fcebeb;
  transition: 0.3s ease all;
  z-index: 1;
}
/* Button 10 */
#button-10 .knobs:before,
#button-10 .knobs:after,
#button-10 .knobs span {
  position: absolute;
  top: 2px;
  width: 53px;
  height: 49px;
  font-size: 10px;
  font-weight: bold;
  text-align: center;
  line-height: 1;
  padding: 9px 4px;
  border-radius: 2px;
  transition: 0.3s ease all;
}

#button-10 .knobs:before {
  content: "";
  left: 4px;
  background-color:#f33155;
}

#button-10 .knobs:after {
  content: "Active";
  right: 4px;
  color: #4e4e4e;
}

#button-10 .knobs span {
  display: inline-block;
  left: 4px;
  color: #fff;
  z-index: 1;
  font-weight: bold;
}

#button-10 .checkbox:checked + .knobs span {
  color: #4e4e4e;
}

#button-10 .checkbox:checked + .knobs:before {
  left: 69px;
  background-color: #7ace4c;
}

#button-10 .checkbox:checked + .knobs:after {
  color: #fff;
}

#button-10 .checkbox:checked ~ .layer {
  background-color: #ebf7fc;
}
</style>
 <form action="{{ route('traitementOffre') }}" method="POST">
 @csrf
<script type="text/javascript">
  var count=1;
    $(document).ready(function(){
      
       var x=1;
       $("#Ajouter").click(function(){
        count++;
        var html= '<tr><td><input type="text" class="form-control" id="bi'+count+'" name="nomchamps[]" placeholder="nom champs" spellcheck="true"></td><td><select name="type[]" class="form-select shadow-none p-1 border-1"> @foreach($listesTypeChamps as $q)<option value="{{ $q->type }}">{{ $q->nom }}</option> @endforeach</select></td><td><select name="typechamps[]" class="form-select shadow-none p-1 border-1"><option value="Obligatoire">Champs Obligatoire</option><option value="Non Obligatoire">Champs Non Obligatoire</option><td id="n'+count+'"></td><td><input type="button" class="btn btn-danger" name="remove" value="Effacer" id="remove"></td></tr>';
           $("#table_field").append(html);
           $(document).on('input',"#bi"+count,function(e){

                 input = document.getElementById("bi"+count).value;
                 console.log(input);
              if(input=="expérience"){
                    console.log(input);
                    var html= '<input type="number" class="form-control" id="inputEmail4" name="anneeExperience" placeholder="année expérience requis à ce poste">';
                    $("#n"+count).append(html);            
              } 
                
            });
          
       });
       $("#table_field").on('click','#remove',function(){
           $(this).closest('tr').remove();
       });


    });



</script>


<div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Nouvel Offre</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <div class="container-fluid">
                <?php if(isset($notif)){ ?>
                        <div class="row">
                           <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                           <div class="white-box"  style="margin-top: 20px">
                              <div class="alert alert-success" role="alert">
                                  <?php echo $notif; ?>
                              </div>
                           </div>
                          </div>
                        </div>
                      <?php } ?>
                <div class="row" style="margin-top: 20px">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title" style="color: #286ac7">Offre sur les enquêtes</h3>
                            
                           
                              <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label for="inputEmail4" style="font-weight: Bold;margin-top: 10px">Nom enquête :</label>
                                  <input type="text" name="nomEnquete" class="form-control" id="inputEmail4" placeholder="Nom de l'enquête" required="required" spellcheck="false">
                                </div>

                                <div class="form-group col-md-6">
                                  <label for="inputEmail4" style="font-weight: Bold;margin-top: 10px">Années  Expéruance :</label>
                                  <input type="number" class="form-control" id="inputEmail4" name="anneeExperience" placeholder="année expérience requis à ce poste">
                                </div>

                                <div class="form-group col-md-6" style="margin-left: 640px;margin-top: -80px">
                                  <label for="inputPassword4" style="font-weight:Bold">  Date Limite :</label>
                                  <input type="datetime-local" class="form-control" name="dateLimite" required="required">
                                </div>
                              </div>
                          <div class="form-group">
                            <label for="inputAddress" style="font-weight:Bold">Description de l'enquête :</label>
                            
                                <textarea id="summernote" class="form-control" rows="4" name="DetailsEnquete" required="required" spellcheck="false"></textarea>
                          </div>
                        
                                                </div>
                                            </div>
                                        </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title" style="color:#286ac7">Champs du formulaire sur cette offre</h3>
                          
                           
                              <table class="table table-bordered" id="table_field">
                                  <tr>
                                    <th>Nom champs</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                   
                                    <th></th>
                                  </tr>
                                  <tr>
                                    <td><input type="text" class="form-control" id="nomchamps" name="nomchamps[]" placeholder="nom champs" spellcheck="true" required="required"></td>
                                    <td><select name="type[]" class="form-select shadow-none p-1 border-1">
                                       @foreach($listesTypeChamps as $q)
                                                <option value="{{ $q->type }}">{{ $q->nom }}</option>
                                        @endforeach
                                            </select></td>
                                     <td><select name="typechamps[]" class="form-select shadow-none p-1 border-1">
                                                <option value="Obligatoire">Champs Obligatoire</option>
                                                <option value="Non Obligatoire">Champs Non Obligatoire</option>
                                            </select></td> 
                                     <td id="annee"></td>
                                    <td><input type="button" class="btn btn-success" name="ajouter" value="Ajouter" id="Ajouter"></td>
                                  </tr>
                              </table>
                                            </div>
                                            </div>
                </div>
                <?php if(count($donneacces)>=1){ ?>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title" style="color:#286ac7">Choisir qui peut voir cette offre</h3>
                                <table class="table table-bordered">
                                  <tr>
                                    <th>Nom</th>
                                    <th>Poste</th>
                                    <th>Rôle</th>
                                    
                                    <th><center></center></th>
                                  </tr>
                                  @foreach($donneacces as $d)
                                  <tr>
                                    <td>{{ $d->nom }} {{ $d->prenom }}</td>
                                    <td>{{ $d->nomposte }}</td>
                                    <td>{{ $d->nomrole }}</td>
                                    <td>
                                      <div class="toggle-button-cover">
                                   
                                  <center><div class="button-cover">           
                                    <div class="button b2" id="button-10">
                                          
                                          <input type="checkbox" class="checkbox"  name="idPersonnel[]" value="{{ $d->idAdmin }}"/>
                                          
                                      <div class="knobs">
                                        <span>Desactive</span>
                                      </div>

                                      <div class="layer"></div>

                                    </div>
                                    
                                  </div></center>                     
                                </div>
                                    </td>
                                    <!-- <td><center><input class="form-check-input" type="checkbox" name="idPersonnel[]" value="{{ $d->idAdmin }}" id="flexCheckChecked"></center></td> -->
                                  </tr>
                                  @endforeach
                              </table>
                           
                        </div>
                    </div>
                </div>
                 <?php } ?>
                                         <div class="row">
                                              <div class="">
                                                   <div class="white-box">
                                                       <button type="submit" class="btn btn-secondary" >Valider</button>
                         
                                                    </div>
                                               </div>
                                           </div>
                                        </form>
                        
                
               
            </div>
            <script type="text/javascript">
            
              $(document).on('input',"#nomchamps",function(e){

                 input = document.getElementById("nomchamps").value;
                 console.log(input);
              if(input=="expérience"){
                    console.log(input);
                    var html= '<input type="number" class="form-control" id="inputEmail4" name="anneeExperience" placeholder="année expérience requis à ce poste">';
                    $("#annee").append(html);       
              }  

            });
              
              
</script>
@endsection
