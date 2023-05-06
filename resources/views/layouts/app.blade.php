<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/style.css">

    <link rel="icon" type="image/png" href="/images/favicon.png">
    <link href="/images/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="/images/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
    <link href="/images/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
    <link href="/images/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">
    <title>@yield('title')</title>
</head>
<body>
<header class="header-static navbar-sticky navbar-light shadow">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <p class="logo"><a class="navbar-brand dropdown-item" href="/"> <img src="images/logo-header.png"
                                                                                 alt="travelgo"> </a></p>
            <button class="navbar-toggler ml-auto btn-categoria" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span></button>
            <div class="collapse navbar-collapse nav-categorias" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    <!-- Menu item 1 Demos-->
                    <li class="nav-item dropdown active"><a class="nav-link dropdown-toggle" href="#" id="demosMenu"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">Categorias</a>
                        <ul class="dropdown-menu" aria-labelledby="homeMenu">
                            <li><a class="dropdown-item" href="/categorias"><i class="fas fa-laptop"></i> Tecnologia
                                    <span>1029</span></a></li>
                            <li><a class="dropdown-item" href="/categorias"><i class="fas fa-truck-pickup"></i> Veículos
                                    <span>1228</span></a></li>
                            <li><a class="dropdown-item" href="/categorias"><i class="fas fa-home"></i> Casa
                                    <span>178</span></a></li>
                            <li><a class="dropdown-item" href="/categorias"><i class="fas fa-user-md"></i> Saúde &amp;
                                    Beleza <span>7163</span></a></li>
                            <li><a class="dropdown-item" href="/categorias"><i class="fas fa-paw"></i> Pets &amp;
                                    Animais <span>8709</span></a></li>
                        </ul>
                    </li>


                </ul>
            </div>

            @if(Auth::check())
                <div class="nav-perfil">
                    <div class="nav-perfil-content nav-perfil-item ">
                        <div class="d-flex justify-content-end">
                            <div >
                                <a href="/perfil" style="color:black" class="perfil-nome">{{Auth::user()->name}}</a>
                                <br>
                                <span class="perfil-email"><small>{{Auth::user()->email}}</small></span>
                            </div>
                            <div  >
                                <div class="avatar-content nav-perfil-item">
                                    <a href="/perfil" class="">
                                        <img src="images/avatar.jpg" alt="avatar">
                                    </a>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            @else
            <div class="nav-item border-0 d-lg-inline-block align-self-center">
                <a href="/login"
                   class=" btn btn-sm btn-grad text-white mb-0">Login</a>
            </div>
            @endif
        </div>
    </nav>
</header>
<div class="content">


    @yield('content')

</div>

<footer class="main-footer">
    <div class="footer-content">
        <div class="container">
            <div class="row">

                <div class="col-sm-12 col-xs-6 col-xxs-12 no-padding-lg">
                    <div class="hero-subscribe">
                        <h4 class="footer-title no-margin">Nos siga no</h4>
                        <ul class="list-unstyled list-inline footer-nav social-list-footer social-list-color footer-nav-inline">
                            <li><a class="icon-color fb" title="" data-placement="top" data-toggle="tooltip" href="#"
                                   data-original-title="Facebook"><i class="fab fa-facebook-f"></i> </a></li>
                            <li><a class="icon-color tw" title="" data-placement="top" data-toggle="tooltip" href="#"
                                   data-original-title="Twitter"><i class="fab fa-twitter"></i> </a></li>
                            <li><a class="icon-color gp" title="" data-placement="top" data-toggle="tooltip" href="#"
                                   data-original-title="Google+"><i class="fab fa-google-plus-g"></i> </a></li>
                            <li><a class="icon-color lin" title="" data-placement="top" data-toggle="tooltip" href="#"
                                   data-original-title="Linkedin"><i class="fab fa-linkedin"></i> </a></li>
                            <li><a class="icon-color pin" title="" data-placement="top" data-toggle="tooltip" href="#"
                                   data-original-title="Linkedin"><i class="fab fa-pinterest-p"></i> </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div style="clear: both"></div>
        <div class="col-xl-12">
            <div class=" text-center paymanet-method-logo"><img src="images/master_card.png" alt="img"> <img alt="img"
                                                                                                             src="images/visa_card.png">
                <img alt="img" src="images/paypal.png"> <img alt="img" src="images/american_express_card.png"> <img
                        alt="img" src="images/discover_network_card.png"></div>
            <div class="copy-info text-center"> © 2023 All Rights Reserved.</div>
        </div>
    </div>
</footer>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/popper.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/isotope.pkgd.min.js" type="text/javascript"></script>
<script src="js/imagesloaded.pkgd.min.js" type="text/javascript"></script>
<script src="js/functions.js" type="text/javascript"></script>
<script src="js/owl.carousel.min.js" type="text/javascript"></script>
<script src="js/slick.js" type="text/javascript"></script>
<script src="js/swiper.min.js" type="text/javascript"></script>
<script src="js/main.js" type="text/javascript"></script>
</body>
</html>



