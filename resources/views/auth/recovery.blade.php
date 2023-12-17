@extends('layouts.app', ['without_extra_content' => true])
@section('title', 'Redefinição de Senha')
@section('content')

<section class="login-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="login-box">
                    <div class="login-top">
                        <h3>Redefinição de Senha</h3>
                        <p>Insira sua nova senha abaixo.</p>
                    </div>
                    
                    <!-- Formulário de Redefinição de Senha -->
                    <form id="resetPasswordForm" class="login-form" action="/recovery-password" method="POST">
                        @csrf

                        <!-- Token -->
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row">
                            <!-- Email Input -->
                            <div class="col-md-12 email">
                                <label>Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Seu e-mail">
                            </div>

                            <!-- Password Input -->
                            <div class="col-md-12 password">
                                <label>Nova Senha</label>
                                <input type="password" name="password" required placeholder="Nova senha">
                            </div>

                            <!-- Confirm Password Input -->
                            <div class="col-md-12 password">
                                <label>Confirme a Nova Senha</label>
                                <input type="password" name="password_confirmation" required placeholder="Confirme a nova senha">
                            </div>

                            <!-- Display Errors -->
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

                            <!-- Submit Button -->
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Redefinir Senha</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
