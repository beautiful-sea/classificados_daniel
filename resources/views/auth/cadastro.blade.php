@extends('layouts.app')
@section('title','Cadastro')
@section('content')

<section class="registration">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="registration-box">
                            <div class="reg-top">
                                <h3>Crie sua conta.</h3>
                                <p>Amplie sua Visibilidade e Alcance Mais Clientes.</p>
                            </div>
                            <form class="reg-form" action="#">
                                <div class="row">
                                    <div class="col-md-6 name">
                                        <label>Nome</label>
                                        <input type="text" name="name" placeholder="Seu nome aqui" require>
                                    </div>
                                    <div class="col-md-6 srname">
                                        <label>Sobrenome</label>
                                        <input type="text" name="srname" placeholder="Seu sobrenome aqui" require>
                                    </div>
                                    <div class="col-md-12 email">
                                        <label>Email</label>
                                        <input type="email" name="email" placeholder="Seu e-mail aqui" require>
                                    </div>
                                    <div class="col-md-12 password">
                                        <label>Senha</label>
                                        <input type="password" name="password" placeholder="Sua senha aqui" require>
                                    </div>
                                    <div class="col-md-6 srname">
                                        <label>Endereço</label>
                                        <select  name="endereco" id="endereco" style="width: 100%; border: 1px solid rgba(150, 150, 150,.3); height: 40px; font-size: 120%; margin-top: 10px;">
                                            <option value="valenca">Valença</option>
                                            <option value="rio-das-flores">Rio das Flores</option>
                                            <option value="barra-do-pirai">Barra do piraí</option>
                                            <option value="juparana">Juparanã</option>
                                            <option value="conservatoria">Conservatória</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 email">
                                        <form  action="#">
                                            <label>Profissão</label>
                                            <select  name="profissao" id="profissao" style="width: 100%; border: 1px solid rgba(150, 150, 150,.3); height: 40px; font-size: 120%; margin-top: 10px;">
                                                <option value="Pedreiro">Pedreiro</option>
                                                <option value="Mecanico">Mecânico</option>
                                                <option value="Dentista">Dentista</option>
                                                <option value="Diarista">Diarista</option>
                                            </select>
                                        </form>
                                    </div>
                                    <div class="col-md-12 email">
                                        <label>Valor por Hora</label>
                                        <input type="number" name="valor-hora" placeholder="Seu valor cobrado por Hora" require>
                                    </div>
                                    <div class="col-md-12 email">
                                        <label>Telefone</label>
                                        <input type="number" name="vtelefone" placeholder="Seu telefone aqui" require>
                                    </div>
                                    <div class="col-md-12 email">
                                        <label>Descrição do anúncio</label>
                                        <textarea name="anuncio" placeholder="Descreva seu anúncio" class="form-control" require></textarea>
                                    </div>
                                    <div class="col-md-12 email">
                                        <label>Imagem Ilustrativa do anúncio</label>
                                        <input class="form-control" name="foto-ilustrativa" placeholder="FOTO ILUSTRATIVA" type="file">
                                    </div>
                                    <div class="col-md-12 email">
                                        <label>Foto Perfil</label>
                                        <input class="form-control" name="foto-perfil" placeholder="FOTO PERFIL" type="file">
                                    </div>
                                    
                                    <div class="col-md-12 chqbox chqbox2">
                                        <input type="checkbox" name="terms" id="term" require>
                                        <label for="term">Eu li &amp; concordo com os <span>Termos &amp; Condições</span>.</label>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" name="button">Criar Conta</button>
                                    </div>
                                </div>
                            </form>
                            <div class="login-btm text-center">
                                <p>Ja tem conta?<a href="/login">Login</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<div class="gradient-overlay-half-primary-v1">
  <div class="bg-img-hero" style="background-image: url(images/bg2.png);">
    <div class="container">
      <div class="row align-items-lg-center text-lg-left space-2">
        <div class="col-lg-7">
          <h3 class="text-white h3">Amplie sua Visibilidade e Alcance Mais Clientes</h3>
          <p class="text-white">Crie sua Conta e Faça Parte do Nosso Marketplace. </p>
        </div>
        <div class="col-lg-5 text-lg-right"> <a class="btn btn-purple mb-2 mb-sm-0 mr-sm-2" href="/login">LOGIN</a> <a class="btn btn-light mb-2 mb-sm-0" href="/cadastro">CRIAR CONTA</a> </div>
      </div>
    </div>
  </div>
</div>

@endsection