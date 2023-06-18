@extends('layouts.app')
@section('title','Avaliação')
@section('content')

<div class="d-flex justify-content-center">
    <form-avaliacao :anunciante_avaliado="{{$anunciante_avaliado}}"></form-avaliacao>
</div>


@endsection
