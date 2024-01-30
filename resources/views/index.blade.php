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
    <div class="bg-img-hero" style="background-image: url('/images/background.jpg')">
        <div class="container space-2 space-4-top--lg space-3-bottom--lg">
            <div class="row align-items-lg-center">
                <div class="col-lg-12 mb-lg-0">
                    <!-- Description -->
                    <div class="pr-lg-12 mb-5 content-title-home">
                        <h1 class="display-4 font-size-48--md-down text-white title-home">Buscando Profissionais?</h1>
                        <h1 class="display-4 font-size-36--md-down text-white subtitle-home">Temos a solução!</h1>
                    </div>
                    <form action="/categorias" class="cflyformtheme cflyformbannersearch">
                        <fieldset>
                            <div class="form-group cflyinputwithicon" ><i class="fas fa-search"></i>
                                <input type="text" name="q" class="form-control"
                                       placeholder="Pesquise por um profissional">
                            </div>
                            <button class="cflybtn" type="submit">Buscar</button>
                        </fieldset>
                    </form>
                    <div class="pr-lg-12 mb-5 content-title-home">
                        <h1 class="display-4 font-size-18--md-down text-white more-title-home">Pesquise, compare e escolha.</h1>
                    </div>
                    <!-- End Description -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="whiteBG pt80 pb60 portfolio">
        <div class="container space-2 space-3--lg">
            <div class="row">
                <tabs-anunciantes></tabs-anunciantes>
            </div>
        </div>
    </div>

@endsection
