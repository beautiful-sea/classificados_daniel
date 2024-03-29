@extends('layouts.app')
@section('title','Perfil Profissional')
@section('content')
    <!-- End Hero Section -->

    <section class="grayBG pt80 pb50 GridList adsDetails OurServices dashboardsection">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="tab-vertical tab-vertical-md py-5 mr-lg-7 tab-professional">
                        <div class="pr-md-7 mb-5">
                            <div class="author_img">
                                @if(auth()->user()->photo_path)
                                    <img src="{!! auth()->user()->photo_path !!}" style="width: 100%; height: 100%;"
                                         alt="">
                                @else

                                    <img src="/images/avatar.webp" style="width: 100%; height: 100%;" alt="">
                                @endif
                            </div>
                            <h3 class="author_imgtitle">{{auth()->user()->name}}</h3>
                        </div>

                        <!-- Tab Nav -->
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                             aria-orientation="vertical">
                            <a class="nav-link  tab-vertical__nav-link" id="v-pills-Dashboard-tab"
                               data-toggle="pill" href="#v-pills-Dashboard" role="tab" aria-controls="v-pills-Dashboard"
                               aria-selected="true">Perfil</a>
                            <a class="nav-link tab-vertical__nav-link" id="v-pills-Saved-tab" data-toggle="pill"
                               href="#v-pills-Saved" role="tab" aria-controls="v-pills-Saved" aria-selected="false">Editar
                                Perfil</a>
                            <a class="nav-link tab-vertical__nav-link active" id="agenda-tab" data-toggle="pill"
                                href="#agenda" role="tab" aria-controls="v-pills-Saved" aria-selected="false">Agenda</a>
                            <a class="nav-link tab-vertical__nav-link" id="v-pills-avaliacoes-tab" data-toggle="pill"
                               href="#v-pills-avaliacoes" role="tab" aria-controls="v-pills-avaliacoes"
                               aria-selected="false">Avaliações</a>
                            <a class="nav-link tab-vertical__nav-link" href="/logout">Sair</a>
                        </div>
                        <!-- End Tab Nav -->
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

                    <!-- Tab Content -->
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade" id="v-pills-Dashboard" role="tabpanel"
                             aria-labelledby="v-pills-key-Dashboard-tab">
                            <div class="row">
                                <div class="inner-box inner-boxdrash">
                                    <div class="welcome-msg">
                                        <h3 class="page-sub-header2 clearfix no-padding">
                                            Olá {{auth()->user()->name}}</h3>
                                        <span class="page-sub-header-sub small">Membro desde {{auth()->user()->created_at }}</span>
                                    </div>
                                    <div id="accordion" class="panel-group">
                                        <div class="card card-default">
                                            <div class="card-header">
                                                <h4 class="card-title"><a href="#collapseB1" aria-expanded="true"
                                                                          data-toggle="collapse"> Meus Detalhes </a>
                                                </h4>
                                            </div>
                                            <div class="panel-collapse collapse show" id="collapseB1">
                                                <div class="card-body">
                                                    <p><span class="title-perfil">Nome: </span> <span
                                                                class="value-perfil">{{auth()->user()->name}}</span></p>
                                                                <p>
                                                                    <span class="title-perfil">Categoria: </span> 
                                                                    <span class="value-perfil">
                                                                        {{ auth()->user()->anunciante ? auth()->user()->anunciante->categoria->nome : 'Sem Categoria' }}
                                                                    </span>
                                                                </p>

                                                    <p><span class="title-perfil">Email: </span> <span
                                                                class="value-perfil">{{auth()->user()->email}}</span>
                                                    </p>
                                                    <p><span class="title-perfil">Contato: </span> <span
                                                                class="value-perfil">{{auth()->user()->phone}}</span>
                                                    </p>
                                                    <p><span class="title-perfil">Endereço: </span> <span
                                                                class="value-perfil">{{auth()->user()->endereco->logradouro}}</span>
                                                    </p>
                                                    <p><span class="title-perfil">Cidade: </span> <span
                                                                class="value-perfil">{{auth()->user()->endereco->cidade->nome??'Não cadastrado'}}</span>
                                                    </p>
                                                    <p><span class="title-perfil">Estado: </span> <span
                                                                class="value-perfil">{{auth()->user()->endereco->estado->sigla??'Não cadastrado'}}</span>
                                                    </p>
                                                    <p><span class="title-perfil">CEP: </span> <span
                                                                class="value-perfil">{{auth()->user()->endereco->cep}}</span>
                                                    </p>
                                                    <p><span class="title-perfil">Titulo: </span> <span class="value-perfil">
                                                                        {{ auth()->user()->anunciante ? auth()->user()->anunciante->titulo : 'Sem Titulo' }}
                                                                    </span>
                                                    </p>
                                                    <p><span class="title-perfil">Descrição: </span> <span class="value-perfil">
                                                                        {{ auth()->user()->anunciante ? auth()->user()->anunciante->descricao : 'Sem Descrição' }}
                                                                    </span>
                                                    </p>


                                                </div>
                                            </div>
                                        </div>
                                        <div class="card card-default">
                                            <div class="card-header">
                                                <h4 class="card-title"><a href="#collapseB2" aria-expanded="true"
                                                                          data-toggle="collapse"> Configurações </a>
                                                </h4>
                                            </div>
                                            <div class="panel-collapse collapse" id="collapseB2">
                                                <div class="card-body">
                                                    <form class="form-horizontal" role="form">

                                                        <div class="form-group">
                                                            <label class="col-lg-12 control-label">Nova Senha</label>
                                                            <div class="col-lg-12">
                                                                <input type="password" class="form-control"
                                                                       placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-lg-12 control-label">Confirme a
                                                                Senha</label>
                                                            <div class="col-lg-12">
                                                                <input type="password" class="form-control"
                                                                       placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-lg-12">
                                                                <button type="submit" class="btn btn-default">
                                                                    Atualizar
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!--/.row-box End-->

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-Saved" role="tabpanel"
                             aria-labelledby="v-pills-key-Saved-tab">
                            <div class="row">
                                <div class="classi-ads-detail">
                                    <div class="account-overview">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h4 class="profile-heading">Editar Perfil</h4>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <anunciante-editar-perfil
                                                    :user-id="{{auth()->user()->id}}"></anunciante-editar-perfil>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade  show active" id="agenda" role="tabpanel"
                             aria-labelledby="v-pills-key-Saved-tab">
                            <div class="row">
                                <div class="classi-ads-detail">
                                    <div class="account-overview">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h4 class="profile-heading">Agenda</h4>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <anunciante-agenda></anunciante-agenda>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-avaliacoes" role="tabpanel"
                             aria-labelledby="v-pills-key-avaliacoes-tab">
                            <h4 class="card-title">
                                Minhas avaliações
                            </h4>
                            @if (auth()->user()->anunciante)
                            <div class="row">
                                <anunciante-avaliacoes></anunciante-avaliacoes>
                            </div>
                            @else
                                <p>Para ter acesso a avaliações, você precisa ter um perfil profissional.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('script_start')

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAY5_-0H8f5jxqkIW_2egw90w2igZcQPb4&v=weekly"
    ></script>

@endsection
