@extends('layouts.app')
@section('title','Inicio')
<?php
    $qtd_anunciantes = \App\Models\Anunciante::count();
    //Verifica o valor de $texto_total_profissionais é dezenas, centenas ou milhares
    if($qtd_anunciantes < 100){
        $texto_total_profissionais = $qtd_anunciantes;
    }elseif($qtd_anunciantes < 1000){
        $texto_total_profissionais = ' dezenas de';
    } elseif($qtd_anunciantes < 10000){
        $texto_total_profissionais = ' centenas de';
    } else {
        $texto_total_profissionais = ' milhares de';
    }
?>
@section('content')

    <!-- Hero Section -->
    <div class="gradient-overlay-half-primary-v1 bg-img-hero" style="background-image: url(/images/app.jpg);">
        <div class="container space-2 space-4-top--lg space-3-bottom--lg">
            <div class="row align-items-lg-center">
                <div class="col-lg-12 mb-lg-0">
                    <!-- Description -->
                    <div class="pr-lg-12 mb-5">
                        <h1 class="display-4 font-size-48--md-down text-white">Encontre Profissionais Qualificados</h1>
                        <p class="lead text-white">Pesquise, compare e escolha entre {{$texto_total_profissionais}} profissionais disponíveis</p>
                    </div>
                    <form action="/categorias" class="cflyformtheme cflyformbannersearch">
                        <fieldset>
                            <div class="form-group cflyinputwithicon" ><i class="fas fa-bullhorn"></i>
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
                            <button class="cflybtn" type="submit">Buscar</button>
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
                <h2 class="h3">Conheça nossos <strong>Profissionais</strong></h2>
                <p>Veja algum dos serviços disponíveis em nossa plataforma </p>
            </div>
            <!-- End Title -->

            <div class="row">
                <tabs-anunciantes></tabs-anunciantes>
            </div>
        </div>
    </div>

@endsection
