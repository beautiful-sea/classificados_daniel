@extends('layouts.app')
@section('title','Inicio')
@section('content')

    <!-- Hero Section -->
    <div class="gradient-overlay-half-primary-v1 bg-img-hero" style="background-image: url(images/img15.jpg);">
        <div class="container space-2 space-4-top--lg space-3-bottom--lg">
            <div class="row align-items-lg-center">
                <div class="col-lg-12 mb-lg-0">
                    <!-- Description -->
                    <div class="pr-lg-12 mb-5">
                        <h1 class="display-4 font-size-48--md-down text-white">Encontre Profissionais Qualificados</h1>
                        <p class="lead text-white">Pesquise, compare e escolha entre 15,000+ serviços disponíveis</p>
                    </div>
                    <form action="/categorias" class="cflyformtheme cflyformbannersearch">
                        <fieldset>
                            <div class="form-group cflyinputwithicon" style="width: 50%!important;"><i class="fas fa-bullhorn"></i>
                                <input type="text" name="q" class="form-control"
                                       placeholder="O que você procura?">
                            </div>
                            {{--                            <div class="form-group cflyinputwithicon"> <i class="far fa-paper-plane"></i> <a class="cflybtnsharelocation fa fa-crosshairs" href="javascript:void(0);"></a>--}}
                            {{--                            <input type="text" name="yourlocation" class="form-control" placeholder="Localização">--}}
                            {{--                            </div>--}}
{{--                            <div class="form-group cflyinputwithicon " >--}}
{{--                                <i class="fab fa-staylinked"></i>--}}
{{--                                <div class="cflyselect ">--}}
{{--                                    <select>--}}
{{--                                        <option value="none">Categoria</option>--}}
{{--                                        @foreach ($categorias as $categoria)--}}
{{--                                            <option value="{{$categoria->id}}">{{$categoria->nome}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <button class="cflybtn" type="button">Buscar</button>
                        </fieldset>
                    </form>

                    <!-- End Description -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="whiteBG pt80 pb60 portfolio">
        <div class="container space-2 space-3--lg">
            <!-- Title -->
            <div class="w-md-80 w-lg-60 text-center mx-md-auto mb-9">
                <span class="u-label u-label--sm u-label--purple mb-3">Mais Avaliados</span>
                <h2 class="h3">Os Favoritos dos <strong>Clientes</strong></h2>
                <p>Veja os serviços preferidos dos clientes com base em suas avaliações</p>
            </div>
            <!-- End Title -->

            <div class="row">
                <div class="col-md-12 p-0">
                    <div class="nav justify-content-center">
                        <ul class="nav-tabs nav-tabs-style-2 text-center px-2 p-md-0 m-0 mb-4">
                            <li class="nav-filter active" data-filter="*">Todos</li>
                            <li class="nav-filter" data-filter=".marketing">Mais Recentes</li>
                            <li class="nav-filter" data-filter=".photo">Mais Populares</li>
                        </ul>
                    </div>
                    <div class="portfolio-wrap grid items-3 items-padding">
                        @foreach($anunciantes as $a)
                        <!-- portfolio-card -->
                        <div class="portfolio-card isotope-item photo marketing Classidied-box">
                            <div class="card card-event info-overlay">
                                <div class="img has-background"
                                     style="background-image: url({{$a->foto_principal_path}}); background-size:cover ">
                                    <a href="addetail.html" class="event-pop-link"> <span class="event-badges "> <span
                                                    class="badge badge-danger"> EM ALTA</span> </span>
                                        <div class="event-pop-info">
                                            <p class="publisher"><strong>{{$a->titulo}}</strong></p>
                                            <div class="event-rating">
                                                <div class="star"><i class="fa  fa-star"></i> <i
                                                            class="fa  fa-star"></i> <i class="fa  fa-star"></i> <i
                                                            class="fa  fa-star"></i> <i class="fa  fa-star"></i></div>
                                                <div class="review-count"> 4.89 | 89 avaliações</div>
                                            </div>
                                        </div>
                                    </a> <a href="addetail.html"> <img alt="340x230" class="card-img-top img-responsive"
                                                                       data-holder-rendered="true"
                                                                       src="images/10x6.gif"> </a></div>
                                <div class="card-body">
                                    <h4 class="card-title"><a href="addetail.html">{{$a->titulo}}</a>
                                    </h4>
                                    <div class="card-event-info">
                                        <p class="event-location"><i class="far fa-compass"></i> <a class="location"
                                                                                                    href="">
                                                {{$a->endereco->cidade->nome}} - {{$a->endereco->estado->sigla}}
                                            </a></p>
{{--                                        <p class="event-time"><i class="far fa-clock"></i>{{$a}} </p>--}}
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="pull-left left">
                                        <div class="">por <a href="dashboard-myads.html">{{$a->user->name}} </a></div>
                                    </div>
                                    <div class="pull-right right social-link"><a href="#"><i
                                                    class="fa  fa-share-alt"></i> </a> <a href="#"></a></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- portfolio wrap -->

                </div>
            </div>
        </div>
    </div>

    <div class="grayBG pt80 pb60">
        <div class="container space-2 space-3--lg">
            <!-- Title -->
            <div class="w-md-80 w-lg-60 text-center mx-md-auto mb-9"><span class=""><a
                            class="u-label u-label--sm u-label--purple mb-3" href="/categorias">Categorias</a></span>
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
                            <div class="inner-box-content"><a href="#"><img class="img-responsive" src="images/app.jpg"
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
                    <div class="col-lg-5 text-lg-right"><a class="btn btn-purple mb-2 mb-sm-0 mr-sm-2" href="/login">LOGIN</a>
                        <a class="btn btn-light mb-2 mb-sm-0" href="/cadastro">Criar Conta</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
