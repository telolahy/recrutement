@extends("BackOffice/TemplateAdmin")

@section("contenu")
<style>
#chartdiv {
  width: 95%;
  height: 265px;
  margin-left: 25px;
}
</style>
</style>
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-5 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Détails de l'offre concernant {{ $nomOffre }}</h4>
                    </div>
                    
                </div>            
            </div>
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
              <div class="row justify-content-center">
                    <!-- <div class="col-lg-4 col-md-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Total Page Views</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash2"><canvas width="67" height="30"
                                            style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ms-auto"><span class="counter text-purple">869</span></li>
                            </ul>
                        </div>
                    </div> -->
                    <div class="col-lg-6 col-md-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Nombre des visiteurs</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash"><canvas width="67" height="30"
                                            style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <?php if(isset($nombreVisiteurs[0]->nombre)){ ?>
                                <li class="ms-auto"><span class="counter text-success">{{ $nombreVisiteurs[0]->nombre }}</span></li>
                                <?php } else { ?>
                                  <li class="ms-auto"><span class="counter text-success">0</span></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <!-- <div class="white-box analytics-info">
                            <h3 class="box-title">Nombres des agents enqueteurs qui ont postulés</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash2"><canvas width="67" height="30"
                                            style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ms-auto"><span class="counter text-purple"></span></li>
                            </ul>
                        </div> -->
                    </div>
                    <!-- <div class="col-lg-6 col-md-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">Unique visitor</h3>
                            <ul class="list-inline two-part d-flex align-items-center mb-0">
                                <li>
                                    <div id="sparklinedash3"><canvas width="67" height="30"
                                            style="display: inline-block; width: 67px; height: 30px; vertical-align: top;"></canvas>
                                    </div>
                                </li>
                                <li class="ms-auto"><span class="counter text-info">911</span>
                                </li>
                            </ul>
                        </div>
                    </div> -->
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-12">
                        <div class="white-box">
                            <code style="font-size:18px"></code>
                           <h3 class="box-title">Nombres des agents enquêteurs qui ont postulés sur {{ $nomOffre }}</h3>
                    <!-- Chart code -->
                   <script>
                    am4core.ready(function() {

                    // Themes begin
                    am4core.useTheme(am4themes_animated);
                    // Themes end

                    // create chart
                    var chart = am4core.create("chartdiv", am4charts.GaugeChart);
                    chart.innerRadius = am4core.percent(82);

                    /**
                     * Normal axis
                     */

                    var valeur=<?php echo $totalCandidatsOffre;?>;
                    var axis = chart.xAxes.push(new am4charts.ValueAxis());
                    axis.min = 0;
                    axis.max = valeur+100;
                    axis.strictMinMax = true;
                    axis.renderer.radius = am4core.percent(80);
                    axis.renderer.inside = true;
                    axis.renderer.line.strokeOpacity = 1;
                    axis.renderer.ticks.template.disabled = false
                    axis.renderer.ticks.template.strokeOpacity = 1;
                    axis.renderer.ticks.template.length = 10;
                    axis.renderer.grid.template.disabled = true;
                    axis.renderer.labels.template.radius = 40;
                    // axis.renderer.labels.template.adapter.add("text", function(text) {
                    //   return text + "%";
                    // })
                    axis.renderer.labels.template.adapter.add("text", function(text) {
                      return text ;
                    })

                    /**
                     * Axis for ranges
                     */

                    var colorSet = new am4core.ColorSet();

                    var axis2 = chart.xAxes.push(new am4charts.ValueAxis());
                    axis2.min = 0;
                    axis2.max = valeur+100;
                    axis2.strictMinMax = true;
                    axis2.renderer.labels.template.disabled = true;
                    axis2.renderer.ticks.template.disabled = true;
                    axis2.renderer.grid.template.disabled = true;

                    var range0 = axis2.axisRanges.create();
                    range0.value = 0;
                    range0.endValue = Math.round((valeur+100)/2);
                    range0.axisFill.fillOpacity = 1;
                    range0.axisFill.fill = colorSet.getIndex(1);

                    var range1 = axis2.axisRanges.create();
                    range1.value = Math.round((valeur+100)/2);
                    range1.endValue = valeur+100;
                    range1.axisFill.fillOpacity = 1;
                    range1.axisFill.fill = am4core.color("#2C495C");

                    /**
                     * Label
                     */

                    var label = chart.radarContainer.createChild(am4core.Label);
                    label.isMeasured = false;
                    label.fontSize = 45;
                    label.x = am4core.percent(50);
                    label.y = am4core.percent(100);
                    label.horizontalCenter = "middle";
                    label.verticalCenter = "bottom";
                    label.text = "50%";


                    /**
                     * Hand
                     */
                    

                    var hand = chart.hands.push(new am4charts.ClockHand());
                    hand.axis = axis2;
                    hand.innerRadius = am4core.percent(20);
                    hand.startWidth = 10;
                    hand.pin.disabled = true;
                    hand.value =<?php echo $totalCandidatsOffre;?>;

                    hand.events.on("propertychanged", function(ev) {
                      range0.endValue = ev.target.value;
                      range1.value = ev.target.value;
                      label.text = axis2.positionToValue(hand.currentPosition).toFixed(0);
                      axis2.invalidate();
                    });

                    }); // end am4core.ready()
                    </script>

<!-- HTML -->
<div id="chartdiv"></div> 

                        </div>
                        
                    </div>
                    <div class="col-sm-5.75" >
                        <div class="white-box">
                            
                            <code style="font-size:18px"></code>
                            <h3 class="box-title">Nombres des candidats experimentés,moyens,novices qui ont postulés sur {{ $nomOffre }}</h3>
                            <style>
                                #divtypeCandidats {
                                    width: 530px;
                                    height: 384px;
                                    margin-left: 20px;
                                }
                            </style>
                              <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
                                <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
                                <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
                            <script>
                                            am5.ready(function() {

                                            // Create root element
                                            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                            var root = am5.Root.new("divtypeCandidats");


                                            // Set themes
                                            // https://www.amcharts.com/docs/v5/concepts/themes/
                                            root.setThemes([
                                              am5themes_Animated.new(root)
                                            ]);


                                            // Create chart
                                            // https://www.amcharts.com/docs/v5/charts/xy-chart/
                                            var chart = root.container.children.push(am5xy.XYChart.new(root, {
                                              panX: false,
                                              panY: false,
                                              wheelX: "panX",
                                              wheelY: "zoomX",
                                              layout: root.verticalLayout
                                            }));


                                            // Data
                                            var colors = chart.get("colors");

                                            var data = <?php echo $nombreDesCandidatsParCategorie?>;
                            //                 var visiteurs=
                            //                 [{country:"Visiteurs",
                            // visits : 1,
                            // columnSettings : fill: colors.next() }] ;

                                            // Create axes
                                            // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                                            var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                                              categoryField: "country",
                                              renderer: am5xy.AxisRendererX.new(root, {
                                                minGridDistance: 30
                                              }),
                                              bullet: function (root, axis, dataItem) {
                                                return am5xy.AxisBullet.new(root, {
                                                  location: 0.5,
                                                  sprite: am5.Picture.new(root, {
                                                    width: 24,
                                                    height: 24,
                                                    centerY: am5.p50,
                                                    centerX: am5.p50,
                                                    src: dataItem.dataContext.icon
                                                  })
                                                });
                                              }
                                            }));

                                            xAxis.get("renderer").labels.template.setAll({
                                              paddingTop: 20
                                            });

                                            xAxis.data.setAll(data);
                                            // xAxis.data.setAll(visiteurs);
                                            var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                                              renderer: am5xy.AxisRendererY.new(root, {})
                                            }));


                                            // Add series
                                            // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                                            var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                                              xAxis: xAxis,
                                              yAxis: yAxis,
                                              valueYField: "visits",
                                              categoryXField: "country"
                                            }));

                                            series.columns.template.setAll({
                                              tooltipText: "{categoryX}: {valueY}",
                                              tooltipY: 0,
                                              strokeOpacity: 0,
                                              templateField: "columnSettings"
                                            });

                                            series.data.setAll(data);
                                            // series.data.setAll(visiteurs);

                                            // Make stuff animate on load
                                            // https://www.amcharts.com/docs/v5/concepts/animations/
                                            series.appear();
                                            chart.appear(1000, 100);

                                            }); // end am5.ready()
                                            </script>

                                        <div id="divtypeCandidats"></div>
                        
                    </div>
                    </div>
                  </div>
                </div>

                <?php if(isset($valiny)) { ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            
                            <code style="font-size:18px"></code>
                           <h3 class="box-title">Nombres des candidats par region qui ont postules sur {{ $nomOffre }}</h3>
                                <style>
                                    #candidatParRegion {
                                        width: 96%;
                                        height: 400px;
                                    }
                                </style>

                                <!-- Resources -->
                                <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
                                <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
                                <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

                                        <!-- Chart code -->
                                        <script>
                                        am5.ready(function() {

                                        // Create root element
                                        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                        var root = am5.Root.new("candidatParRegion");


                                        // Set themes
                                        // https://www.amcharts.com/docs/v5/concepts/themes/
                                        root.setThemes([
                                          am5themes_Animated.new(root)
                                        ]);


                                        // Create chart
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/
                                        var chart = root.container.children.push(am5xy.XYChart.new(root, {
                                          panX: true,
                                          panY: true,
                                          wheelX: "panX",
                                          wheelY: "zoomX",
                                          pinchZoomX:true
                                        }));

                                        // Add cursor
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                                        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                                        cursor.lineY.set("visible", false);


                                        // Create axes
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                                        var xRenderer = am5xy.AxisRendererX.new(root, { minGridDistance: 30 });
                                        xRenderer.labels.template.setAll({
                                          rotation: -90,
                                          centerY: am5.p50,
                                          centerX: am5.p100,
                                          paddingRight: 15
                                        });

                                        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                                          maxDeviation: 0.3,
                                          categoryField: "country",
                                          renderer: xRenderer,
                                          tooltip: am5.Tooltip.new(root, {})
                                        }));

                                        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                                          maxDeviation: 0.3,
                                          renderer: am5xy.AxisRendererY.new(root, {})
                                        }));


                                        // Create series
                                        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                                        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                                          name: "Series 1",
                                          xAxis: xAxis,
                                          yAxis: yAxis,
                                          valueYField: "value",
                                          sequencedInterpolation: true,
                                          categoryXField: "country",
                                          tooltip: am5.Tooltip.new(root, {
                                            labelText:"{valueY}"
                                          })
                                        }));

                                        series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5 });
                                        series.columns.template.adapters.add("fill", function(fill, target) {
                                          return chart.get("colors").getIndex(series.columns.indexOf(target));
                                        });

                                        series.columns.template.adapters.add("stroke", function(stroke, target) {
                                          return chart.get("colors").getIndex(series.columns.indexOf(target));
                                        });

                                     
                                        // Set data
                                        
                                        var data=<?php echo $encodeliste;?>;


                                        xAxis.data.setAll(data);
                                        series.data.setAll(data);


                                        // Make stuff animate on load
                                        // https://www.amcharts.com/docs/v5/concepts/animations/
                                        series.appear(1000);
                                        chart.appear(1000, 100);

                                        }); // end am5.ready()
                                        </script>

                                        <!-- HTML -->
                                        <div id="candidatParRegion"></div>
                    </div>
                </div>
            </div>
                 <?php } ?>

                 <div class="row">
                    <div class="col-sm-12">
                        
                </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            
                            <code style="font-size:18px"></code>
                            <h3 class="box-title display-1 display-sm-4 display-md-3 display-lg-2 display-xl-1" style="color: #286ac7">Listes des agents enquêteurs qui ont postulés sur {{ $nomOffre }}</h3>

                            <form  method="post" action="{{ route('ExportExcelEnqueteurs') }}" class="d-flex  justify-content-end  mb-4 ">
                             @csrf
                            <input type="hidden" name="idOffre" value="<?php echo $_GET['idOffre']; ?>">
                            <button type="submit" class="btn btn-success" >Export en Excel <i class="fas fa-download" aria-hidden="true"></i></button>
                            </form>

                             <?php if(isset($valiny)) { ?>
                            <form method="get" action="FiltreParRegion" class="w-100 d-flex gap-3 ">
                                  @csrf
                            <div class="input-group mb-3" class="w-100 d-flex gap-3 ">
                                 <input type="hidden" name="idoffre" value="<?php echo $_GET['idOffre']; ?>">
                                <input type="hidden" name="nomchamps" class="form-control" value="<?php echo $valiny; ?>">
                                <h5  style="margin-top:5px">Filtre:</h5><select name="nomRegion" class="form-control" > 
                                    <option value=""></option>
                                    <option value="Tous">Tous</option> 
                                  @foreach($listesRegions as $reg)       
                                    <option value="{{ $reg->nom }}">{{ $reg->nom }}</option>
                                  @endforeach
                                </select>  

                                <select name="typeEnqueteur" class="form-control" > 
                                    <option value=""></option> 
                                    @foreach($types as $ty) 
                                    <option value="{{ $ty }}">{{ $ty }}</option>
                                     @endforeach
                                </select>    
                                <input type="hidden" name="Page" value="1">
                                <div class="input-group-append">
                                <button class="btn btn-secondary" type="submit" style="margin-left:20px">Rechercher</button>
                            </div>
                            </div>
                            </form>
                              <?php } ?>
                            <!-- <p class="text-muted"></p> -->
                            <?php if(isset($ListesEnqueteurs)) { ?>
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                         
                                        <tr>
                                            <?php for ($i=0; $i <count($ListesEnqueteurs[0]) ; $i++) { ?>
                                            <th class="border-top-0"><?php echo $ListesEnqueteurs[0][$i]->champs; ?></th>
                                            <?php } ?>
                                        </tr>
                                        
                                    </thead>
                                    <tbody>
                                        <?php for ($l=0; $l <count($ListesEnqueteurs) ; $l++) { ?>
                                            
                                        <tr>
                                            <?php for ($j=0; $j <count($ListesEnqueteurs[0]) ; $j++) { ?>
                                            @if($ListesEnqueteurs[$l][$j]->typefield=="image")
                                            <td><a href="DownloadImage?nomImage=<?php echo $ListesEnqueteurs[$l][$j]->valeur ?>"><img src="{{ asset('DetailsEnqueteur/'.$ListesEnqueteurs[$l][$j]->valeur) }}" style="width:150px;height:150px"></a></td>
                                            @elseif($ListesEnqueteurs[$l][$j]->typefield=="file")
                                            <td><a href="DownloadFichier?nomfichier=<?php echo $ListesEnqueteurs[$l][$j]->valeur ?>">{{ $ListesEnqueteurs[$l][$j]->valeur }}</a></td>
                                            @else
                                            <td>{{ $ListesEnqueteurs[$l][$j]->valeur }}</td>
                                            @endif
                                           <?php } ?> 
                                        </tr>
                                         <?php } ?>
                                    </tbody>
                                </table>
                                 <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end">
                                      
                                        <li class="page-item">
                                        <a class="page-link" href="#">Précédent</a>
                                      </li>
                                       <?php for($i=1;$i<=$numberPage;$i++) { ?>
                                       <?php if(isset($_GET['Page']) && $_GET['Page']==$i) { ?>
                                      <li class="page-item active"><a class="page-link" href="DetailsOffres?idOffre=<?php echo $_GET['idOffre'] ?>&&Page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                        <?php } else { ?>
                                         <li class="page-item"><a class="page-link" href="DetailsOffres?idOffre=<?php echo $_GET['idOffre'] ?>&&Page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                         <?php } } ?>
                                      <li class="page-item">
                                        <a class="page-link" href="#">Suivant</a>
                                      </li>
                                    </ul>
                                </nav>
                            </div>
                            <?php } ?>

                        </div>
                        
                    </div>
                </div>
                
               
            </div>
@endsection