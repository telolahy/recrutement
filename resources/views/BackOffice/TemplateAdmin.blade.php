<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Ample lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Ample admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>PlateForme Recrutement des agents enqueteurs</title>
   
    <link rel="icon" type="{{ asset('image/png') }}" sizes="16x16" href="{{ asset('plugins/images/logInstat.png') }}">
    
  <!--   <link href="{{ asset('plugins/bower_components/chartist/dist/chartist.min.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{ asset('plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css') }}">
      <!--   <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> -->
       <!--  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet"> -->
    <link href="{{ asset('plugins/summernote-0.8.18-dist/summernote.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/summernote-0.8.18-dist/summernote-lite.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style2.css') }}" rel="stylesheet">
    
     

    
    

    <link href="{{ asset('plugins/summernote-0.8.18-dist/summernote-bs4.css') }}" rel="stylesheet">

    
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!-- <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div> -->
    
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="dashboard.html">
                        <!-- Logo icon -->
                        <!-- <b class="logo-icon">
                           
                            <img src="plugins/images/logo-icon.png" alt="homepage" />
                        </b> -->
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="{{ asset('plugins/images/logInstat.png') }}" alt="homepage" style="width: 50%;margin-left: 45px" />

                        </span>

                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                   
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav ms-auto d-flex align-items-center">

                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <!-- <li class=" in">
                            <form role="search" class="app-search d-none d-md-block me-3">
                                <input type="text" placeholder="Search..." class="form-control mt-0">
                                <a href="" class="active">
                                    <i class="fa fa-search"></i>
                                </a>
                            </form>
                        </li> -->
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li>
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                     <!--  <img src="{{ asset('plugins/images/users/v2.png') }}" alt class="w-px-40 h-auto rounded-circle" /> -->
                     
                      <span class="text-white font-medium">{{ Auth::user()->prenom }}</span>
                    </div>

                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="plugins/images/users/v2.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{ Auth::user()->nom }}</span>
                            <span class="fw-semibold d-block">{{ Auth::user()->prenom }}</span>
                            <small class="text-muted">{{  Session::get('nomrole'); }}</small>

                          </div>
                        </div>
                      </a>
                    </li>
                    <!-- <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">Mon Profil</span>
                      </a> -->
                    </li>
                    <!-- <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li> -->
                    
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                   
                    <li>
                      <a class="dropdown-item" href="{{ route('logout') }}">
                        <i class="fa fa-power-off me-2"></i>
                        <span class="align-middle">se déconnecter</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
                            <!-- <div class="nav-item dropdown">
                            <a class="profile-pic"  data-bs-toggle="dropdown" href="#">
                                <img src="plugins/images/users/varun.jpg" alt="user-img" width="36"
                                    class="img-circle">

                                    <span class="text-white font-medium">{{ Auth::user()->nom }}</span>
                                    <span class="text-white font-medium">{{ Auth::user()->prenom }}</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">

                                <a href="#" class="dropdown-item"><p>{{  Session::get('nomrole'); }}</p></a>
                                <a href="#" class="dropdown-item"><h5>Steaven Jen</h5></a>
                             <div class="dropdown-divider"></div>   
                            <a href="#" class="dropdown-item">Se déconnecter</a>
                        </div>
                    </div> -->
                                    <!-- <div class="profile-info">
                                    <div class="profile_info_iner">
                                        ::before
                                    <p>Directeur</p>
                                    <h5>Steaven Jen</h5>

                                    </div>
                                </div> -->
                                 
                                    

                        </li>

                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6" style="margin-top: 9px">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">

                    <ul id="sidebarnav">
                        <!-- <li class="text-center p-20 upgrade-btn">
                            <a href="https://www.wrappixel.com/templates/ampleadmin/"
                                class="btn d-grid btn-secondary text-white" target="_blank">
                                Back-Office</a>
                        </li> -->
                        <!-- User Profile-->
                        <!--  <li class="text-center p-20 upgrade-btn">
                                <h4 class="page-title" style="margin-right:30px;font-weight: bold">Back-Office</h4>
                        </li> -->
                        <li class="sidebar-item pt-2">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="Acceuil?Page=1"
                                aria-expanded="false">
                                <i class="fas fa-copy" aria-hidden="true"></i>
                                <span class="hide-menu">Listes des Offres</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('AjoutOffres') }}"
                                aria-expanded="false">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                                <span class="hide-menu">Nouvel Offre</span>
                            </a>
                        </li>

                        @if(Session::get('nomrole')!="Collaborateurs")
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('AjoutAdministrateurs') }}"
                                aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span class="hide-menu">Ajout Administrateurs</span>
                            </a>
                        </li>
                        @endif

                        @if(Session::get('nomrole')=="Super Admin" || "Admin")
                        <!-- <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('ListesDemandeAjoutoffre') }}"
                                aria-expanded="false">
                                <i class="fa fa-list" aria-hidden="true"></i>
                                <span class="hide-menu">Listes Demandes Offres</span>
                            </a>
                        </li> -->
                       
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="Comptes?Page=1"
                                aria-expanded="false">
                                <i class="fas fa-user-circle" aria-hidden="true"></i>
                                <span class="hide-menu">Listes des comptes</span>
                            </a>
                        </li>
                        @endif
                       
                    </ul>


                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
             @yield("contenu")
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">Copyright <span><i class="fa fa-copyright"></i></span> INSTAT {{date('Y')}}. Tous les droits sont réservés
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="{{ asset('bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <!--   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->

<!--  <script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js') }}"></script> -->

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   
    <!-- Bootstrap tether Core JavaScript -->
   

   <!--  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
 <script src="{{ asset('plugins/summernote-0.8.18-dist/summernote-bs4.js') }}"></script> -->
  <script src="{{ asset('js/summernote.js') }}"></script>

    <script src="{{ asset('js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('js/custom.js') }}"></script>
    
    <script src="{{ asset('plugins/bower_components/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ asset('js/pages/dashboards/dashboard1.js') }}"></script>
</body>

</html>