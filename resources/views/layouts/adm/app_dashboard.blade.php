<!DOCTYPE html>
<html class="loading dark-layout" lang="pt-br" data-layout="dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" href="/adm/images/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="/adm/images/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
          rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="/adm/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="/adm/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/adm/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="/adm/css/colors.css">
    <link rel="stylesheet" type="text/css" href="/adm/css/components.css">
    <link rel="stylesheet" type="text/css" href="/adm/css/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="/adm/css/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="/adm/css/semi-dark-layout.css">
    <link href="/vendors/css/extensions/toastr.min.css"  rel="stylesheet" type="text/css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/adm/css/horizontal-menu.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/adm/css/style.css">
    <!-- END: Custom CSS-->
    @yield('css')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu  navbar-floating footer-static  " data-open="hover"
      data-menu="horizontal-menu" data-col="">

<!-- BEGIN: Header-->
<nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center"
     data-nav="brand-center">
    <div class="navbar-header d-xl-block d-none">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="navbar-brand" href="/admin">

                    <h2 class="brand-text mb-0">Logo</h2>
                </a>
            </li>
            <li class="nav-item">

            </li>
        </ul>
    </div>
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a>
                </li>
            </ul>

        </div>
        <ul class="nav navbar-nav align-items-center ms-auto">


            <li class="nav-item dropdown dropdown-user ">
                <a class="nav-link dropdown-toggle dropdown-user-link"
                                                           id="dropdown-user" href="#" data-bs-toggle="dropdown"
                                                           aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name fw-bolder">{{auth()->user()->name}}</span>
                        <span class="user-status">{{auth()->user()->role}}</span>
                    </div>
                    <span class="avatar"><img class="round" src="/images/avatar.jpg" alt="avatar" height="40" width="40"><span
                                class="avatar-status-online"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                    <a class="dropdown-item" href="/admin/perfil"><i class="me-50" data-feather="user"></i> Perfil</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/admin/config"><i class="me-50" data-feather="settings"></i>
                        Configurações</a>
                    <div class="dropdown-divider"></div>
                    <form action="/logout" method="POST">
                        @csrf
                        <button class="dropdown-item w-100" type="submit"><i class="me-50" data-feather="power"></i>
                            Sair
                        </button>
                    </form>

                </div>
            </li>
        </ul>
    </div>
</nav>

<!-- END: Header-->


<!-- BEGIN: Main Menu-->
<div class="horizontal-menu-wrapper">
    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-dark navbar-shadow menu-border container-xxl"
         role="navigation" data-menu="menu-wrapper" data-menu-type="floating-nav">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto"><a class="navbar-brand"
                                                href="../../../html/ltr/horizontal-menu-template-dark/index.html"><span
                                class="brand-logo">
                                <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                    <defs>
                                        <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%"
                                                        y2="89.4879456%">
                                            <stop stop-color="#000000" offset="0%"></stop>
                                            <stop stop-color="#FFFFFF" offset="100%"></stop>
                                        </lineargradient>
                                        <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%"
                                                        x2="37.373316%" y2="100%">
                                            <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                            <stop stop-color="#FFFFFF" offset="100%"></stop>
                                        </lineargradient>
                                    </defs>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                            <g id="Group" transform="translate(400.000000, 178.000000)">
                                                <path class="text-primary" id="Path"
                                                      d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
                                                      style="fill:currentColor"></path>
                                                <path id="Path1"
                                                      d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
                                                      fill="url(#linearGradient-1)" opacity="0.2"></path>
                                                <polygon id="Path-2" fill="#000000" opacity="0.049999997"
                                                         points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                                <polygon id="Path-21" fill="#000000" opacity="0.099999994"
                                                         points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                                <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994"
                                                         points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                            </g>
                                        </g>
                                    </g>
                                </svg></span>
                        <h2 class="brand-text mb-0">Vuexy</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
                                class="d-block d-xl-none text-primary toggle-icon font-medium-4"
                                data-feather="x"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <!-- Horizontal menu content-->
        <div class="navbar-container main-menu-content" data-menu="menu-container">
            <!-- include ../../../includes/mixins-->
            <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item  {{request()->path() == 'admin'?'active':''}}">
                    <a class="  nav-link d-flex align-items-center" href="/admin">
                        <i data-feather="activity"></i><span data-i18n="Dashboards">Dashboard </span>
                    </a>
                </li>
                <li class="nav-item  {{request()->path() == 'admin/usuarios'?'active':''}} ">
                    <a class="nav-link d-flex align-items-center" href="/admin/usuarios">
                        <i data-feather="users"></i><span data-i18n="Dashboards">Usuários </span>
                    </a>
                </li>
                <li class="nav-item  {{request()->path() == 'admin/categorias'?'active':''}} ">
                    <a class=" nav-link d-flex align-items-center" href="/admin/categorias">
                        <i data-feather="layers"></i><span data-i18n="Dashboards">Categorias</span>
                    </a>
                </li>
                <li class="nav-item  {{request()->path() == 'admin/avaliacoes'?'active':''}} ">
                    <a class=" nav-link d-flex align-items-center" href="/admin/avaliacoes">
                        <i data-feather="star"></i><span data-i18n="Dashboards">Avaliações</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
<!-- END: Main Menu-->

<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">@yield('title')</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/admin">Inicio</a>
                                </li>

                                <li class="breadcrumb-item"><a href="#">@yield('title')</a>

                            </ol>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12" id="app">
                    @yield('content')
                </div>
            </div>

        </div>
    </div>
</div>
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light footer-shadow">
    <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2023<a
                    class="ms-25" href="/" target="_blank">Empresa</a><span
                    class="d-none d-sm-inline-block">, Todos os direitos reservados</span></span></p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->


<!-- BEGIN: Vendor JS-->
<script src="/adm/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="/adm/js/jquery.sticky.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="/adm/js/app-menu.js"></script>
<script src="/adm/js/app.js"></script>
<script src="/js/app.js"></script>
<script src="/adm/js/moment.min.js"></script>
<script src="/vendors/js/extensions/toastr.min.js"></script>
<!-- END: Theme JS-->
@yield('js')
<!-- BEGIN: Page JS-->
<!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>
