@extends('layouts.app')
@section('title','Categorias')
@section('content')

<div class="gradient-overlay-half-primary-v1 bg-img-hero innerCategoryList" style="background-image: url(images/img15.jpg);">
  <div class="container space-2 space-4-top--lg space-3-bottom--lg">
    <div class="row align-items-lg-center">
      <div class="col-lg-12 mb-lg-0">
        <form action="/categorias" method="GET" class="cflyformtheme cflyformbannersearch">
          <fieldset>
            <div class="form-group cflyinputwithicon" style="width: 100%;"><i class="fas fa-bullhorn"></i>
              <input value="{{request()->q??''}}" type="text" name="q" class="form-control"
                     placeholder="O que você procura?">
            </div>
            {{--                            <div class="form-group cflyinputwithicon"> <i class="far fa-paper-plane"></i> <a class="cflybtnsharelocation fa fa-crosshairs" href="javascript:void(0);"></a>--}}
            {{--                            <input type="text" name="yourlocation" class="form-control" placeholder="Localização">--}}
            {{--                            </div>--}}
            {{--            <div class="form-group cflyinputwithicon " >--}}
            {{--              <i class="fab fa-staylinked"></i>--}}
            {{--              <div class="cflyselect ">--}}
            {{--                <select name="categoria">--}}
            {{--                  <option value="none">Categoria</option>--}}
            {{--                  @foreach ($categorias as $categoria)--}}
            {{--                    <option value="{{$categoria->id}}">{{$categoria->nome}}</option>--}}
            {{--                  @endforeach--}}
            {{--                </select>--}}
            {{--              </div>--}}
            {{--            </div>--}}
            <button class="cflybtn" type="submit">Buscar</button>
          </fieldset>
        </form>

        <!-- End Description -->
      </div>
    </div>
  </div>
</div>

<section class="grayBG pt80 pb50 GridList adsDetails perfil-content" >
  <anunciante-page slug="{!! $slug !!}"></anunciante-page>
</section>
<div class="gradient-overlay-half-primary-v1">
  <div class="bg-img-hero" style="background-image: url(images/bg2.png);">
    <div class="container">
      <div class="row align-items-lg-center text-lg-left space-2">
        <div class="col-lg-7">
          <h3 class="text-white h3">Amplie sua Visibilidade e Alcance Mais Clientes</h3>
          <p class="text-white">Crie sua Conta e Faça Parte do Nosso Marketplace</p>
        </div>
        <div class="col-lg-5 text-lg-right"> <a class="btn btn-purple mb-2 mb-sm-0 mr-sm-2" href="#">LOGIN</a> <a class="btn btn-light mb-2 mb-sm-0" href="#">Criar Conta</a> </div>
      </div>
    </div>
  </div>
</div>
<!-- End Hero Section -->

@endsection

@section('script_start')

  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiWXsgSJXp6TyYa_nl7LJCFSK0Oyp0yd8&v=weekly"
  ></script>

@endsection
