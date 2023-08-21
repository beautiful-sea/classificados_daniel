@extends('layouts.adm.app_dashboard')
@section('title','Dashboard')
@section('content')



    <!-- BEGIN: Content-->

        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Analytics Start -->
                <section id="dashboard-analytics">
                    <div class="row match-height">
                        <!-- Greetings Card starts -->
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="card card-congratulations">
                                <div class="card-body text-center">
                                    <img src="/adm/images/decore-left.png" class="congratulations-img-left" alt="card-img-left" />
                                    <img src="/adm/images/decore-right.png" class="congratulations-img-right" alt="card-img-right" />
                                    <div class="avatar avatar-xl bg-primary shadow">
                                        <div class="avatar-content">
                                            <i data-feather="award" class="font-large-1"></i>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <h1 class="mb-1 text-white">Bem vindo {{auth()->user()->first_name}}</h1>
                                        <p class="card-text m-auto w-75">
                                            Este é seu <strong>Dashboard</strong>. Aqui você pode ver as estatisticas do seu site.

                                        </p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row ">
                                        <!-- Subscribers Chart Card starts -->
                                        <div class="col-6">
                                            <div class="card p-0">
                                                <div class="card-header d-flex align-items-start p-2">
                                                    <div class="avatar bg-light-primary p-50 m-auto">
                                                        <div class="avatar-content">
                                                            <i data-feather="users" class="font-medium-5"></i>
                                                        </div>
                                                    </div>
                                                    <div class="m-auto">
                                                        <h2 class="fw-bolder mt-1">{{$users_count}}</h2>
                                                        <p class="card-text">Usuários </p>
                                                    </div>
                                                </div>
                                                <div id="gained-chart"></div>
                                            </div>
                                        </div>
                                        <!-- Subscribers Chart Card ends -->

                                        <!-- Orders Chart Card starts -->
                                        <div class=" col-6">
                                            <div class="card  p-0">
                                                <div class="card-header d-flex align-items-start p-2">
                                                    <div class="avatar bg-light-warning p-50 m-auto">
                                                        <div class="avatar-content">
                                                            <i data-feather="package" class="font-medium-5"></i>
                                                        </div>
                                                    </div>
                                                    <div class=" m-auto">
                                                        <h2 class="fw-bolder mt-1">{{$categorias_count}}</h2>
                                                        <p class="card-text">Categorias</p>
                                                    </div>
                                                </div>
                                                <div id="order-chart"></div>
                                            </div>
                                        </div>
                                        <!-- Orders Chart Card ends -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Greetings Card ends -->

                        <!-- Avg Sessions Chart Card starts -->
                        <div class=" col-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row pb-50">
                                        <div class="col-sm-8 col-12 d-flex justify-content-between flex-column order-sm-1 order-2 mt-1 mt-sm-0">
                                            <div class="mb-1 mb-sm-0">
                                                <h2 class="fw-bolder mb-25">{{$total_visitas_7_dias}}</h2>
                                                <p class="card-text fw-bold mb-2">Visitante{{ $total_visitas_7_dias>1?'s':'' }}</p>
                                                <div class="font-medium-2">
                                                    <span class="{{$porcentagem_visitas_7_dias > 0 ? 'text-success' : 'text-danger'}} me-25">
                                                        @if($porcentagem_visitas_7_dias > 0)
                                                            <i data-feather="trending-up"></i>
                                                        @else
                                                            <i data-feather="trending-down"></i>
                                                        @endif
                                                        {{number_format($porcentagem_visitas_7_dias,2)}}%
                                                    </span>
                                                    <span>Visitantes nos ultimos 7 dias</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-12 d-flex justify-content-between flex-column text-end order-sm-2 order-1">
                                            <div class="dropdown chart-dropdown">
                                                <button class="btn btn-sm border-0 dropdown-toggle p-50" type="button" id="dropdownItem5" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Ultimos 7 dias
                                                </button>
{{--                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownItem5">--}}
{{--                                                    <a class="dropdown-item" href="#">Ultimos 28 Dias</a>--}}
{{--                                                    <a class="dropdown-item" href="#">Ultimo Mês</a>--}}
{{--                                                    <a class="dropdown-item" href="#">Ultimo Ano</a>--}}
{{--                                                </div>--}}
                                            </div>
                                            <div id="avg-sessions-chart"></div>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row pb-50">
                                        <div class="col-sm-8 col-12 d-flex justify-content-between flex-column order-sm-1 order-2 mt-1 mt-sm-0">
                                            <div class="mb-1 mb-sm-0">
                                                <h2 class="fw-bolder mb-25">{{$total_cliques_contato_7_dias}}</h2>
                                                <p class="card-text fw-bold mb-2">Contato{{ $total_cliques_contato_7_dias>1?'s':'' }}</p>
                                                <div class="font-medium-2">
                                                    <span class="{{$porcentagem_cliques_contato_7_dias > 0 ? 'text-success' : 'text-danger'}} me-25">
                                                        @if($porcentagem_cliques_contato_7_dias > 0)
                                                            <i data-feather="trending-up"></i>
                                                        @else
                                                            <i data-feather="trending-down"></i>
                                                        @endif
                                                        {{number_format($porcentagem_cliques_contato_7_dias,2)}}%
                                                    </span>
                                                    <span>Contatos nos ultimos 7 dias</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-12 d-flex justify-content-between flex-column text-end order-sm-2 order-1">
                                            <div class="dropdown chart-dropdown">
                                                <button class="btn btn-sm border-0 dropdown-toggle p-50" type="button" id="dropdownItem5" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Ultimos 7 dias
                                                </button>
                                                {{--                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownItem5">--}}
                                                {{--                                                    <a class="dropdown-item" href="#">Ultimos 28 Dias</a>--}}
                                                {{--                                                    <a class="dropdown-item" href="#">Ultimo Mês</a>--}}
                                                {{--                                                    <a class="dropdown-item" href="#">Ultimo Ano</a>--}}
                                                {{--                                                </div>--}}
                                            </div>
                                            <div id="avg-sessions-chart"></div>
                                        </div>
                                    </div>
{{--                                    <div class="row avg-sessions pt-50">--}}
{{--                                        <div class="col-6 mb-2">--}}
{{--                                            <p class="mb-50">Visitantes: 2.7k</p>--}}
{{--                                            <div class="progress progress-bar-primary" style="height: 6px">--}}
{{--                                                <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="50" aria-valuemax="100" style="width: 50%"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-6 mb-2">--}}
{{--                                            <p class="mb-50">Usuários: 92.6k</p>--}}
{{--                                            <div class="progress progress-bar-warning" style="height: 6px">--}}
{{--                                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="60" aria-valuemax="100" style="width: 60%"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-6">--}}
{{--                                            <p class="mb-50">Categorias: 38.4k</p>--}}
{{--                                            <div class="progress progress-bar-danger" style="height: 6px">--}}
{{--                                                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="70" aria-valuemax="100" style="width: 70%"></div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>






                </section>
                <!-- Dashboard Analytics end -->

            </div>
        </div>

    <!-- END: Content-->




    @section('js')

    <script src="/adm/js/apexcharts.min.js"></script>

    <!-- END: Page Vendor JS-->

    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->

    <!-- END: Page JS-->
    @endsection


@endsection
