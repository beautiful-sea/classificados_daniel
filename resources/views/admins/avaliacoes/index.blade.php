@extends('layouts.adm.app_dashboard')
@section('title','Avaliações')
@section('content')

    <!-- BEGIN: Content-->

    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
           <div class="row">
               <admin-campos-avaliacoes></admin-campos-avaliacoes>
               <admin-avaliacoes-list>

               </admin-avaliacoes-list>
           </div>
        </div>
    </div>

@endsection
