@extends('admin.layouts/contentLayoutMaster')

@section('title', 'Usuários')

@section('content')
    {{--     formulario de edição de usuário com nome, email, senha e tipo de usuario (role) --}}
    <section id="users-list-wrapper">
        <div class="users-list-table">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <div class="add-new">
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-primary mb-2">
                                            Voltar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('admin.users.update', $user->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" name="name" id="name" class="form-control"
                                       placeholder="Nome do usuário" value="{{ $user->name }}">
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" name="email" id="email" class="form-control"
                                       placeholder="E-mail do usuário" value="{{ $user->email }}">
                            </div>
                            <div class="form-group">
                                <label for="password">Senha</label>
                                <input type="password" name="password" id="password" class="form-control"
                                       placeholder="Senha do usuário" value="{{ old('password') }}">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirmação de senha</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       class="form-control" placeholder="Confirmação de senha do usuário"
                                       value="{{ old('password_confirmation') }}">
                            </div>
                            <div class="form-group">
                                <label for="role">Tipo de usuário</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="administrador" {{ $user->role == 'administrador' ? 'selected' : '' }}>
                                        Administrador
                                    </option>
                                    <option value="anunciante" {{ $user->role == 'anunciante' ? 'selected' : '' }}>
                                        Anunciante
                                    </option>
                                    <option value="visitante
                                    " {{ $user->role == 'visitante' ? 'selected' : '' }}>Visitante
                                    </option>
                                </select>
                            </div>
                            {{-- Mensagem de erro de validação--}}
                            <div class="mt-1">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
