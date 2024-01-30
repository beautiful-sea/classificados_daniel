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
                            <form class="reg-form" action="/register" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 srname">
                                        <label>Nome</label>
                                        <input type="text" name="name"  autocomplete="off"  placeholder="Seu nome aqui" required>
                                    </div>
                                    <div class="col-md-12 email">
                                        <label>Email</label>
                                        <input type="email" name="email" autocomplete="off" placeholder="Seu e-mail aqui" required>
                                    </div>
                                    <div class="col-md-12 password">
                                        <label>Senha</label>
                                        <input type="password"  autocomplete="off"  name="password" placeholder="Sua senha aqui" required>
                                    </div>

                                    <div class="col-md-12 email">
                                            <label>Categoria</label>
                                            <select  name="categoria_id" class="select2 form-control" style="width: 100%; border: 1px solid rgba(150, 150, 150,.3); height: 40px; font-size: 120%; margin-top: 10px;">
                                                <option value="0">Selecione uma categoria</option>
                                                @foreach($categorias as $categoria)
                                                    <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="col-md-12 email">
                                        <label>Telefone</label>
                                        <input type="text" name="phone" id="phone" placeholder="Seu telefone aqui" required>
                                    </div>
                                    <div class="col-md-12 chqbox chqbox2">
                                        <input type="checkbox" name="terms" id="term" required>
                                        <label for="term">Li &amp; concordo com os <span>Termos &amp; Condições</span>.</label>
                                    </div>
                                    @foreach($errors->all() as $error)
                                        <li class="text-danger">{{$error}}</li>
                                    @endforeach
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

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            //Mascara de telefone formato (00) 00000-0000
            $("#phone").mask("(00) 00000-0000");
        });

    </script>
@endsection
