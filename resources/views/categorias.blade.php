@extends('layouts.app',['without_extra_content'=>true])
@section('title','Categorias')
@section('content')
<div class="content-title-categoria-page">
  <h1> {{$categoria->nome}} </h1>
</div>
<!-- End Hero Section -->
<categorias-page></categorias-page>
@endsection
