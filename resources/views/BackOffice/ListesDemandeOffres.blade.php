@extends("BackOffice/TemplateAdmin")


@section("contenu")
<div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Listes des demandes d'ajout offre</h4>
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
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">Nom</th>
                                            <th class="border-top-0">Prenom</th>
                                            <th class="border-top-0">Enquete</th>
                                            <th class="border-top-0">Date de demande</th>
                                            <th class="border-top-0">Poste</th>
                                            <th class="border-top-0">Direction</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($reponse as $list)
                                        <tr>
                                            <td style="color: #286ac7">{{ $list->nom }}</td>
                                            <td>{{ $list->prenom }}</td>
                                            <td style="color: #286ac7">{{ $list->nomEnquete }}</td>
                                            <td>{{ $list->dateDemande }}</td>
                                            <td style="color: #286ac7">{{ $list->nomposte }}</td>
                                            <td>{{ $list->nomDirection }}</td>
                                        </tr>
                                          @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
               
            </div>
@endsection