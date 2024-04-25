@extends("BackOffice/TemplateAdmin")


@section("contenu")
<script src="{{ asset('js/jQuery.js') }}"></script>
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
  width: 80px;
  height: 50px;
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

/* Button 1 */
#button-1 .knobs:before {
  content: "Active";
  position: absolute;
  top: 4px;
  left: 4px;
  width: 50px;
  height: 12px;
  color: #fff;
  font-size: 10px;
  font-weight: bold;
  text-align: center;
  line-height: 1;
  padding: 9px 4px;
  background-color: #03a9f4;
  border-radius: 50%;
  transition: 0.3s cubic-bezier(0.18, 0.89, 0.35, 1.15) all;
}

#button-1 .checkbox:checked + .knobs:before {
  content: "Desactive";
  left: 42px;
  background-color: #f44336;
}

#button-1 .checkbox:checked ~ .layer {
  background-color: #fcebeb;
}

#button-1 .knobs,
#button-1 .knobs:before,
#button-1 .layer {
  transition: 0.3s ease all;
}

/* Button 2 */
#button-2 .knobs:before,
#button-2 .knobs:after {
  content: "YES";
  position: absolute;
  top: 4px;
  left: 4px;
  width: 20px;
  height: 10px;
  color: #fff;
  font-size: 10px;
  font-weight: bold;
  text-align: center;
  line-height: 1;
  padding: 9px 4px;
  background-color: #03a9f4;
  border-radius: 50%;
  transition: 0.3s ease all;
}

#button-2 .knobs:before {
  content: "YES";
}

#button-2 .knobs:after {
  content: "NO";
}

#button-2 .knobs:after {
  right: -28px;
  left: auto;
  background-color: #f44336;
}

#button-2 .checkbox:checked + .knobs:before {
  left: -28px;
}

#button-2 .checkbox:checked + .knobs:after {
  right: 4px;
}

#button-2 .checkbox:checked ~ .layer {
  background-color: #fcebeb;
}

/* Button 3 */
#button-3 .knobs:before {
  content: "YES";
  position: absolute;
  top: 4px;
  left: 4px;
  width: 20px;
  height: 10px;
  color: #fff;
  font-size: 10px;
  font-weight: bold;
  text-align: center;
  line-height: 1;
  padding: 9px 4px;
  background-color: #03a9f4;
  border-radius: 50%;
  transition: 0.3s ease all, left 0.3s cubic-bezier(0.18, 0.89, 0.35, 1.15);
}

#button-3 .checkbox:active + .knobs:before {
  width: 46px;
  border-radius: 100px;
}

#button-3 .checkbox:checked:active + .knobs:before {
  margin-left: -26px;
}

#button-3 .checkbox:checked + .knobs:before {
  content: "NO";
  left: 42px;
  background-color: #f44336;
}

#button-3 .checkbox:checked ~ .layer {
  background-color: #fcebeb;
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
  background-color:#f44336;
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
}

#button-10 .checkbox:checked + .knobs span {
  color: #4e4e4e;
}

#button-10 .checkbox:checked + .knobs:before {
  left: 69px;
  background-color: #2C495C;
}

#button-10 .checkbox:checked + .knobs:after {
  color: #fff;
}

#button-10 .checkbox:checked ~ .layer {
  background-color: #ebf7fc;
}





</style>
<div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Gestion administrateurs</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Listes</h3>
                            <div class="table-responsive">
                               <!--  <table class="table text-nowrap" border="1" > -->
                                 <table id="compt_table" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="border-top-1">Nom</th>
                                            <th class="border-top-1">Prénom</th>
                                            <th class="border-top-1">Rôle</th>
                                            <th class="border-top-1">Status</th>
                                            <th class="border-top-1">Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($val as $compt)
                                        <tr>
                                            <td>    {{ $compt->nom }}   </td>
                                            <td>    {{ $compt->prenom }}    </td>
                                            <td>
                                                <?php foreach ($listroles as $role) {?>
    <input type="checkbox" name="role" <?php if($role['nomrole']==$compt->nomrole){ echo 'checked="checked"' ;} ?> value="<?php echo $role['id'] ;?>" >
    <label for="role"> <?php echo $role['nomrole'] ;?> </label><br>
     <?php } ?>
   </td>                                        
                              <td>
                                <div class="toggle-button-cover">
                                   
                                  <div class="button-cover">           
                                    <div class="button b2" id="button-10">
                                          
                                          <input type="checkbox" class="checkbox" name="status" <?php if($compt->status=="Active"){ echo 'checked="checked"' ;} ?> onclick="tooglestatus(<?php echo $compt->idAdmin ;?>)"/>
                                          
                                      <div class="knobs">
                                        <span>Desactive</span>
                                      </div>

                                      <div class="layer"></div>

                                    </div>
                                    
                                  </div>
                                   
                                </div>
                              </td>
                                  <!-- <div class="form-check form-switch">
 <input class="form-check-input" <?php if($compt->status=="Active"){ echo 'checked="checked"' ;} ?> onclick="tooglestatus(<?php echo $compt->idAdmin ;?>)" type="checkbox" id="check"/>
  <label class="form-check-label" for="flexSwitchCheckDefault" id="nomstatus">{{ $compt->status }}</label>
</div> -->                                
                                
                            
                                      
                       <td>
                             <input type="hidden" id="idolona" value="{{ $compt->idAdmin }}">
                            <a href="Fiche?idAdmin=<?php echo $compt->idAdmin ;?>&&Page=<?php echo $_GET['Page']?>" title="Voir détails" id="show" 
                                data-action=""
                                data-id=""
                                data-name="" 
                                data-is_collection=3
                                data-title="voir détails" style="color:#36698a;margin-top:15px" > 
                                <i class="fas fa-eye" aria-hidden="true" style="margin-top:15px"></i>
                               <!--  <i class="fas fa-pencil-alt" aria-hidden="true" style="margin-top:15px"></i> -->
                            </a>
                            &nbsp;
                            <!--   <form action="{{ url('deletecomptes/'.$compt->idAdmin) }}" method="get" style="display:initial"> -->
                                <form action="deletecomptes/{{ $compt->idAdmin }}?Page=<?php echo $_GET['Page'] ?>" method="post" style="display:initial">
                                 @csrf 
                              <a href="" title="Supprimer" data-bs-toggle="modal" data-bs-target="#exampleModal"
                               data-title="Compte de {{ $compt->nom }} " style="color:#36698a">
                               <i class="far fa-trash-alt" aria-hidden="true"></i></a>
                               <input type="hidden" name="Page" value="<?php echo $_GET['Page'] ?>">
                              </form>
                            <!-- Modal -->
                           @include('BackOffice.deleteconfirm')
                            
                     </td>
                     


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
                                      <li class="page-item active"><a class="page-link" href="Comptes?Page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                        <?php } else { ?>
                                         <li class="page-item"><a class="page-link" href="Comptes?Page=<?php echo $i ?>"><?php echo $i ?></a></li>
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
<script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-1.9.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
 function tooglestatus(id){
    var id=id;
    $.ajax({
        
        url:'/Modificationstatus',
        type:"get",
        data:{idAdmin:id},
        success :function(result){
        console.log(result);
          if(result=="Active"){
            $('#nomstatus').text(result);
            swal("Effectué!","Compte Active","success");
          }
          else{
               $('#nomstatus').text(result);
               swal("Effectué!","Compte Desactive","success");
          }
        }
      });
  }
</script>
<script type="text/javascript">
  
  $(function(){
  
      $('#compt_table').on('show.bs.modal','#exampleModal', function (e) {
        $title = $(e.relatedTarget).attr('data-title');
        $(this).find('.modal-title').text($title);

        var form = $(e.relatedTarget).closest('form');
        $(this).find('.modal-footer #confirm').data('form', form);
        });

       $('#compt_table').on('click','#exampleModal .modal-footer #confirm', function(){
          $(this).data('form').submit();
         });
    
  });
</script>
