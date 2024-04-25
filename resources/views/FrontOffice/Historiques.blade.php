@extends("FrontOffice/TemplateUtilisateur")
@inject('carbon','Carbon\Carbon')
<link rel="stylesheet" href="{{ asset('CssUtilisateur/styleHistoriques.css') }}">
@section("contenuFront")
<div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title"></h4>
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
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class=mt-5>Historiques des offres postulées</h3>
                        <p></p>
                    </div>
                    <div class="col-12 mx-auto">
                        <ul class="timeline">
                            @foreach($HistoriquesPostulesOffres as $histo)
                            <li class="timeline-item">
                                <div class="timeline-info">
                                    <span>Date postule: {{ $carbon::parse($histo->datepostule)->translatedFormat('d F Y à H\hi') }}</span>
                                </div>

                                <div class="timeline-marker"></div>
                                <div class="timeline-content">
                                    <h3 class="timeline-title">{{ $histo->nomEnquete }}</h3>
                                    <p>Vous avez postulé l'offre concernant {{ $histo->nomEnquete }} le {{ $carbon::parse($histo->datepostule)->translatedFormat('d F Y à H\hi') }}. Cette offre a pour date limite le {{ $carbon::parse($histo->dateLimite)->translatedFormat('d F Y à H\hi') }}.</p>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="row example-split">
        <div class="col-md-12 example-title">
            <h2>Historiques des offres postules</h2>
            <p>Small devices (tablets, 768px and up)</p>
        </div>
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2">
            <ul class="timeline timeline-split" style="margin-left: 350px">
                @foreach($HistoriquesPostulesOffres as $histo)
                <li class="timeline-item">
                    <div class="timeline-info">
                        <span>{{ $carbon::parse($histo->datepostule)->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="timeline-marker"></div>
                    <div class="timeline-content">
                        <h3 class="timeline-title">{{ $histo->nomEnquete }}</h3>
                        <p>Cette offre concernant {{ $histo->nomEnquete  }} a pour date limite le {{ $carbon::parse($histo->dateLimite)->translatedFormat('d F Y') }}.</p>
                    </div>
                </li>
                
 @endforeach
 </ul>
</div>
</div> -->
</div>
</div>
</div>

@endsection
<script src="{{ asset('CssUtilisateur/libs/jquery/dist/jquery.min.js') }}"></script>