@extends("FrontOffice/TemplateUtilisateur")
<head>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" charset="utf-8"></script> -->
   <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js" charset="utf-8"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
.container {
  display: grid;
  grid-template-columns: repeat(1, 160px);
  grid-gap: 80px;
  background: white;
  /*box-shadow: -5px -5px 8px rgba(94, 104, 121, 0.288),
              4px 4px 6px rgba(94, 104, 121, 0.288);*/
  padding: 60px;
  margin: auto 0;
}

@media (min-width: 420px) and (max-width: 659px) {
  .container {
    grid-template-columns: repeat(2, 160px);
  }
}

@media (min-width: 660px) and (max-width: 899px) {
  .container {
    grid-template-columns: repeat(3, 200px);
  }
}

@media (min-width: 900px) {
  .container {
    grid-template-columns: repeat(3, 160px);
  }
}

.container .box {
  width: 100%;
}

.container .box h2 {
  display: block;
  text-align: center;
  color: black;
  font-size: 60%;
  margin-top: 100px;
}

.container .box .chart {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  font-size: 40px;
  line-height: 160px;
  height: 160px;
  color: black;
}

.container .box canvas {
  position: absolute;
  top: 0;
  left: 0;
  width: 200px;
  margin-top: -80px;
  
}

  </style>
</head>
@section("contenuFront")
<div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Formulaire à remplir lorsqu'on postule uiuiuiusur cette offre</h4>
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
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                  <form action="{{ route('traitementEnqueteurs') }}"  method="POST" enctype="multipart/form-data"  class="form-horizontal form-material">
                                    @csrf
                                    @foreach($val as $form)
                                  <div class="form-group row">
                                    <input type="hidden" name="idOffre" value="<?php echo $_GET['idOffre']?>">
                                    <input type="hidden" name="Page" value="<?php echo $_GET['Page']?>">
                                    <input type="hidden" name="nomchamps[]" value="{{ $form->champs }}">
                                    <input type="hidden" name="typechamps[]" value="{{ $form->typechamps }}">
                                    <input type="hidden" name="typefield[]" value="{{ $form->type }}">
                                    <input type="hidden" name="anneExperience[]" value="{{ $form->anneeExperience }}">
                                        <label class="col-sm-2 col-form-label" style="color:#2C495C;font-weight: bold">{{ $form->champs }} :</label>
                                        <div class="col-sm-10">
                                            <?php if($form->champs=="Régions" || $form->champs=="Région" || $form->champs=="Région(s)") { ?>
                                              <select name="{{ $form->champs }}" class="form-control" id="{{ $form->champs }}">  
                                                  <option value=""></option> 
                                                 
                                                  @foreach($listesRegions as $reg)       
                                                        <option <?php if(old($form->champs)==$reg->nom) { echo 'selected="selected"' ;} ?> value="{{ $reg->nom }}">{{ $reg->nom }}</option>
                                                  @endforeach
                                              </select>
                                        <?php } else { ?>
                                        <input @if ($form->type=="image" || $form->type=="file"){ echo type="file" } @else{ echo type="{{ $form->type }}" } @endif name="{{ $form->champs }}[]" class="form-control" id="{{ $form->champs }}" value="{{ old($form->champs) }}" placeholder="{{ $form->champs }}" spellcheck="false"> 
                                        <?php } ?>
                                           
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label class="col-md-12" style="font-weight: bold">Prenom </label>
                                        <div class="col-md-12">
                                            <input type="text" name="nom" class="form-control form-control-line" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12" style="font-weight: bold">Age </label>
                                        <div class="col-md-12">
                                            <input type="text" name="nom" class="form-control form-control-line" value="">
                                        </div>
                                    </div> -->
                                    
                                     @error($form->champs)
                                    <small class="invalid-feedback" id="error">{{ $message }}</small>
                                    @enderror
                                     @endforeach
                                    <button type="submit" class="btn btn-secondary " id="but" >Envoyer ma candidature</button>
                                     
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                           
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <!-- <div class="card">
                            <div class="card-body"> -->
                                <div class="container">

                                      <div class="box">
                                        <div  class="chart"  data-percent="0" style="margin-left:70px">  <h2 id="val">0%</h2></div>
                                      
                                      </div>
                                     
                                </div>
                            </div>
                        </div>
                    </div>
<script type="text/javascript">
  $(function() {
    $('.chart').easyPieChart({
    size: 200,
    barColor: function (percent) {
       return (percent <=20 ? '#f62d51' :  percent>20 && percent<=50 ? '#fb8c00' : percent>50 && percent <=80 ? '#e5e619' : percent>80 ? '#9ACD32' :'white');
    },
    scaleLength: 0,
    lineWidth: 15,
    trackColor: "#525151",
    lineCap: "circle",
    animate: 2000,
     
  });
    
    let data = localStorage.getItem('valeur');
$('.chart').data('easyPieChart').update(data);
$('#val').text(data+"%"); 

    var idInput=<?php echo json_encode($val); ?>;
    var nombreInput=<?php echo count($val); ?>;
    
   
     for(let i = 0; i < idInput.length; i++){
        tgh=idInput[i].champs;
    $(document).on('input',"#"+tgh,function(e){
      let somme=0;
     for(let j=0;j < idInput.length; j++){

         if($("#"+idInput[j].champs).val()!=""){
           somme=somme+1;
           
          }     
     } 

    let pourcentage=(somme/idInput.length)*100;
    let couleur;
    let valeurPourcentage=Math.round(pourcentage);
    localStorage.setItem('valeur', valeurPourcentage);
    // if(valeurPourcentage<=20){
    //   couleur="#F62d51";
    // }
    // if(valeurPourcentage>20 && valeurPourcentage<=50){
    //   couleur="#Fb8c00";
    // }
    // if(valeurPourcentage<50 && valeurPourcentage>=80){
    //   couleur="#FFF0";
    // }
    // if(valeurPourcentage>80){
    //   couleur="#9ACD3";
    // }
$('.chart').easyPieChart({
    size: 160,
    barColor:  function (percent) {
       return (percent <=20 ? '#f62d51' : percent>20 && percent<=50 ? '#fb8c00' : percent>50 && percent <=80 ? '#e5e619' : percent>80 ? '#9ACD32': 'white');
    },
    scaleLength: 0,
    lineWidth: 15,
    trackColor: "#525151",
    lineCap: "circle",
    animate: 2000,
     
  });

$('.chart').data('easyPieChart').update(valeurPourcentage);
$('#val').text(valeurPourcentage+"%"); 
                 
});

}
  
 
 });  

</script>              
@endsection
