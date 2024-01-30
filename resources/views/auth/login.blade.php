@extends('layouts.app', ['without_extra_content' => true])
@section('title','Login')
@section('content')

<section class="login-area" style="height: calc(100vh - 85px) background-image: url('/images/background.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="login-box">
                @if(session('success'))
                    <div class="alert alert-success" id="successAlert" style="position: relative; padding-right: 35px;">
                        <button type="button" class="close" aria-label="Close" onclick="document.getElementById('successAlert').style.display='none';" style="position: absolute; top: 0; right: 0; padding: 0.75rem 1.25rem; color: inherit;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger" id="errorAlert" style="position: relative; padding-right: 35px;">
                        <button type="button" class="close" aria-label="Close" onclick="document.getElementById('errorAlert').style.display='none';" style="position: absolute; top: 0; right: 0; padding: 0.75rem 1.25rem; color: inherit;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('error') }}
                    </div>
                @endif
                    <div class="login-top">
                        <h3 id="formTitle" class="title-login">Bem-vindo!</h3>
                        <p id="formDescription" class="title-login">Faça login na sua conta.</p>
                    </div>
                    
                    <!-- Formulário de Login -->
                    <form id="loginForm" class="login-form" action="/login" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 email">
                                <label class="title-login">Email</label>
                                <input class="input" type="text" name="email" placeholder="Seu e-mail aqui">
                            </div>
                            <div class="col-md-12 password">
                                <label class="title-login">Senha</label>
                                <input class="input" type="password" name="password" placeholder="Sua senha aqui">
                            </div>
                            <div class="col-12">
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{$error}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <button class="button-login" type="submit" name="button">Entrar</button>
                            </div>
                        </div>
                    </form>

                    <!-- Formulário de Recuperação de Senha -->
                    <form id="forgotPasswordForm" class="login-form" action="/forgot-password" method="POST" style="display: none;">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-md-12 email">
                                <label class="title-login">Email para recuperação de senha</label>
                                <input class="input" type="email" name="email" placeholder="Digite seu e-mail">
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary button-login">Recuperar Senha</button>
                            </div>
                        </div>
                    </form>

                    <div class="col-md-12 d-flex justify-content-between align-items-center mt-3">
                        <div class="chqbox" id="rememberMeContainer">
                            <input type="checkbox" name="rememberme" id="rmme">
                            <label for="rmme" class="title-login">Lembre de mim</label>
                        </div>
                        <div class="forget-btn">
                            <a href="#" id="forgotPasswordLink">Esqueceu a senha?</a>
                        </div>
                    </div>

                    <div class="col-md-12 text-center forget-btn" id="backToLogin" style="display:none;">
                        <a href="#" id="backToLoginLink">Voltar para Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const loginForm = document.getElementById('loginForm');
        const forgotPasswordForm = document.getElementById('forgotPasswordForm');
        const formTitle = document.getElementById('formTitle');
        const formDescription = document.getElementById('formDescription');
        const backToLoginLink = document.getElementById('backToLogin');
        const rememberMeContainer = document.getElementById('rememberMeContainer');
        const forgotPasswordLink = document.getElementById('forgotPasswordLink');
        
        forgotPasswordLink.addEventListener('click', function (e) {
            e.preventDefault();
            loginForm.style.display = 'none';
            forgotPasswordForm.style.display = 'block';
            formTitle.textContent = 'Recuperação de Senha';
            formDescription.textContent = 'Insira seu e-mail para recuperar a senha';
            rememberMeContainer.style.display = 'none';
            backToLoginLink.style.display = 'block';
            forgotPasswordLink.style.display = 'none';
        });

        document.getElementById('backToLoginLink').addEventListener('click', function (e) {
            e.preventDefault();
            loginForm.style.display = 'block';
            forgotPasswordForm.style.display = 'none';
            formTitle.textContent = 'Bem-vindo de volta!';
            formDescription.textContent = 'Faça login na sua conta.';
            rememberMeContainer.style.display = 'flex';
            backToLoginLink.style.display = 'none';
            forgotPasswordLink.style.display = 'block';
        });
    });
</script>
@endsection
