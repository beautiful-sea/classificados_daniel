@extends('admin.layouts/contentLayoutMaster')

@section('title', 'Usuários')

@section('content')
    <!-- Kick start -->
{{--     Tabela de listagem de usuários --}}
    <section id="users-list-wrapper">
        <div class="users-list-table">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
{{--                        Mensagem de usuario cadastrado com sucesso--}}
                        @if (session('success'))
                            <div class="alert alert-success">
                                <span class="p-1">
                                    {{ session('success') }}
                                </span>
                            </div>
                        @endif
{{--                        Campo de busca--}}
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <div class="add-new">
                                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                                                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                                            </svg>
                                             Adicionar Usuário</a>
                                    </div>
                                    <div class="search-form">
                                        <form method="get" action="{{route('admin.users.index')}}">
                                            <div class="input-group">
                                                <input type="text" name="search" id="search" class="form-control round" placeholder="Buscar" aria-label="Buscar" aria-describedby="search-users">
                                                <button class="btn btn-primary round" id="search-users">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <!-- Datatable -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-light">
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Perfil</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td class="text-truncate">{{ $user->name }}</td>
                                        <td class="text-truncate">{{ $user->email }}</td>
                                        <td class="text-truncate">{{ $user->role }}</td>
                                        <td class="text-truncate">
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!--/ Datatable -->
                    </div>
                </div>
            </div>
        </div>
    <!--/ Kick start -->
@endsection
