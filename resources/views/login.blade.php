@extends('layouts.app')
@section('title','Categorias')
@section('content')

<section class="login-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="login-box">
                            <div class="login-top">
                                <h3>Bem-vindo de volta!</h3>
                                <p>Faça login na sua conta.</p>
                            </div>
                            <form class="login-form" action="#">
                                <div class="row">
                                    <div class="col-md-12 email">
                                        <label>Email</label>
                                        <input type="text" name="email" placeholder="Seu e-mail aqui">
                                    </div>
                                    <div class="col-md-12 password">
                                        <label>Senha</label>
                                        <input type="text" name="email" placeholder="Sua senha aqui">
                                    </div>
                                    <div class="col-md-12 d-flex justify-content-between">
                                        <div class="chqbox">
                                            <input type="checkbox" name="rememberme" id="rmme">
                                            <label for="rmme">Lembre de mim</label>
                                        </div>
                                        <div class="forget-btn">
                                            <a href="">Esqueceu a senha?</a>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" name="button">Entrar</button>
                                    </div>
                                </div>
                            </form>
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
                <div class="col-lg-5 text-lg-right"> <a class="btn btn-purple mb-2 mb-sm-0 mr-sm-2" href="/cadastro">CRIAR CONTA</a></div>
            </div>
            </div>
        </div>
        </div>
@endsection