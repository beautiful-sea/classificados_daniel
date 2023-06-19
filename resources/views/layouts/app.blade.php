@php
    $categorias  = \App\Models\Categoria::with('categorias_filho')->get();
       //categorias pai
       $categoriasPai = $categorias->where('categoria_pai_id', null);
       $anunciantes = \App\Models\Anunciante::query()
           ->with('user')
           ->with('categoria')
           ->with('endereco.cidade')
           ->with('endereco.estado') ->listaveis()
           ->limit(6)->get();
@endphp

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1 ">
    <link rel="stylesheet" href="/css/style.css">

    <link rel="icon" type="image/png" href="/images/favicon.png">
    <link href="/images/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="/images/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
    <link href="/images/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
    <link href="/images/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">
    <link href="/vendors/css/forms/select/select2.min.css" rel="stylesheet" type="text/css">
    <link href="/vendors/css/extensions/toastr.min.css" rel="stylesheet" type="text/css">
    {{--    Font awesome:--}}
    <link href="/css/fontawesome.min.css" rel="stylesheet" type="text/css">
    <title>@yield('title')</title>
</head>
<body style="width: min-content">
<header class="header-static navbar-sticky navbar-light shadow">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <p class="logo"><a class="navbar-brand dropdown-item" href="/">LOGO </a></p>
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
                            @foreach($categorias as $categoria)
                                <li>
                                    <a class="dropdown-item" href="/categorias">
                                        {{--                                    <i class="fas fa-laptop"></i>--}}
                                        {{$categoria->nome}}
                                        {{--                                    <span>1029</span>--}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>

            @if(Auth::check())
                <div class="nav-perfil">
                    <div class="nav-perfil-content nav-perfil-item ">
                        <div class="d-flex justify-content-end">
                            <div>
                                <a href="/home" style="color:black" class="perfil-nome">{{Auth::user()->name}}</a>
                                <br>
                                <span class="perfil-email"><small>{{Auth::user()->email}}</small></span>
                            </div>
                            <div>
                                <div class="avatar-content nav-perfil-item">
                                    <a href="/home" class="">
                                        @if(auth()->user()->photo_path)
                                            <img src="{!! \Illuminate\Support\Facades\Storage::url(auth()->user()->photo_path) !!}"
                                                 style="width: 100%; height: 100%;" alt="">
                                        @else

                                            <img src="/images/avatar.webp" style="width: 100%; height: 100%;" alt="">
                                        @endif
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
<div class="content" id="app">
    @yield('content')
    @if(!isset($without_extra_content) || (isset($without_extra_content) && $without_extra_content == false))
        <div class="grayBG pt80 pb60">
            <div class="container space-2 space-3--lg">
                <!-- Title -->
                <div class="w-md-80 w-lg-60 text-center mx-md-auto mb-9"><span class=""><a
                                class="u-label u-label--sm u-label--purple mb-3"
                                href="/categorias">Categorias</a></span>
                    <h2 class="h3">Descubra uma <strong>Ampla Gama de Opções de Serviços</strong></h2>
                    <p>Opções de Serviços para Todos os Tipos de Necessidades</p>
                </div>
                <!-- End Title -->
                <div class="row">
                    <div class="col-md-9 page-content col-thin-right">
                        <div class="inner-box category-content">
                            <div class="row">
                                @foreach($categoriasPai as $categoria)
                                    <div class="col-md-4 col-sm-4 ">
                                        <div class="cat-list">
                                            <h3 class="cat-title"><a href="/categorias"> {{$categoria->nome}}
                                                    {{--                                            <span class="count">277,959</span>--}}
                                                </a></h3>
                                            <ul class="cat-collapse cat-id-1 collapse show" style="">
                                                @foreach($categoria->categorias_filho as $categoriaFilho)
                                                    <li><a href="/categorias">{{$categoriaFilho->nome}}</a></li>
                                                @endforeach

                                            </ul>
                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="inner-box has-aff relative"><a class="dummy-aff-img" href="categories.html"><img
                                        src="images/aff2.jpg" class="img-responsive" alt=" aff"> </a></div>
                    </div>
                    <div class="col-md-3 page-sidebar col-thin-left">
                        <aside>
                            <div class="inner-box no-padding">
                                <div class="inner-box-content"><a href="#"><img class="img-responsive"
                                                                                src="images/app.jpg"
                                                                                alt="tv"></a></div>
                            </div>
                            <div class="inner-box">
                                <h2 class="title-2">Mais Populares </h2>
                                <div class="inner-box-content">
                                    <ul class="cat-list arrow">
                                        @foreach($categorias->where('categoria_pai_id','!=',null) as $categoria)
                                            <li><a href="/categorias"> {{$categoria->nome}} </a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="inner-box no-padding"><img class="img-responsive" src="images/add2.jpg" alt="">
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>

        <div class="gradient-overlay-half-primary-v1">
            <div class="bg-img-hero" style="background-image: url(images/bg2.png);">
                <div class="container">
                    <div class="row align-items-lg-center text-lg-left space-2">
                        <div class="col-lg-7">
                            <h3 class="text-white h3">Amplie sua Visibilidade e Alcance Mais Clientes</h3>
                            <p class="text-white">Crie sua Conta e Faça Parte do Nosso Marketplace</p>
                        </div>
                        <div class="col-lg-5 text-lg-right"><a class="btn btn-purple mb-2 mb-sm-0 mr-sm-2"
                                                               href="/login">LOGIN</a>
                            <a class="btn btn-light mb-2 mb-sm-0" href="/cadastro">Criar Conta</a></div>
                    </div>
                </div>
            </div>
        </div>
    @endif
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

            <div class="copy-info text-center"> © 2023 Todos os direitos reservados.</div>
        </div>
    </div>
</footer>
<script src="/js/jquery.min.js" type="text/javascript"></script>
<script src="/js/popper.min.js" type="text/javascript"></script>
<script src="/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/js/functions.js" type="text/javascript"></script>
<script src="/js/owl.carousel.min.js" type="text/javascript"></script>
<script src="/js/slick.js" type="text/javascript"></script>
<script src="/js/swiper.min.js" type="text/javascript"></script>
<script src="/js/main.js" type="text/javascript"></script>
@yield('script_start')
<script src="/js/app.js"></script>
<script src="/vendors/js/forms/select/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="/vendors/js/extensions/toastr.min.js"></script>
@yield('scripts')
</body>
</html>



