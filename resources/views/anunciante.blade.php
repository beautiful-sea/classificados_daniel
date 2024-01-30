@extends('layouts.app')
@section('title','Categorias')
@section('content')

<section class="grayBG pt80 pb50 GridList adsDetails perfil-content" >
  <anunciante-page slug="{!! $slug !!}"></anunciante-page>
</section>
<!-- End Hero Section -->

@endsection

@section('script_start')

  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiWXsgSJXp6TyYa_nl7LJCFSK0Oyp0yd8&v=weekly"
  ></script>

@endsection
