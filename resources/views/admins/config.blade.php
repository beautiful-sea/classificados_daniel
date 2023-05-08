@extends('layouts.adm.app_dashboard')
@section('title','Configuração')

@section('content')

        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        

                        <!-- security -->

                        <div class="card">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">Mudar Senha</h4>
                            </div>
                            <div class="card-body pt-1">
                                <!-- form -->
                                <form class="validate-form">
                                    <div class="row">
                                        <div class="col-12 col-sm-6 mb-1">
                                            <label class="form-label" for="account-old-password">Senha Atual</label>
                                            <div class="input-group form-password-toggle input-group-merge">
                                                <input type="password" class="form-control" id="account-old-password" name="password" placeholder="Insira sua senha" data-msg="Senha atual" />
                                                <div class="input-group-text cursor-pointer">
                                                    <i data-feather="eye"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-6 mb-1">
                                            <label class="form-label" for="account-new-password">Nova Senha</label>
                                            <div class="input-group form-password-toggle input-group-merge">
                                                <input type="password" id="account-new-password" name="new-password" class="form-control" placeholder="Insira a nova senha" />
                                                <div class="input-group-text cursor-pointer">
                                                    <i data-feather="eye"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 mb-1">
                                            <label class="form-label" for="account-retype-new-password">Confirme a nova senha</label>
                                            <div class="input-group form-password-toggle input-group-merge">
                                                <input type="password" class="form-control" id="account-retype-new-password" name="confirm-new-password" placeholder="Confirme a nova senha" />
                                                <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <p class="fw-bolder">Requerimento de senha:</p>
                                            <ul class="ps-1 ms-25">
                                                <li class="mb-50">Mínimo de 8 caracteres - quanto mais, melhor</li>
                                                <li class="mb-50">Pelo menos um caractere minúsculo</li>
                                                <li>Pelo menos um número, símbolo ou caractere de espaço em branco</li>
                                            </ul>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary me-1 mt-1">Salvar Mudanças</button>
                                            <button type="reset" class="btn btn-outline-secondary mt-1">Descartar</button>
                                        </div>
                                    </div>
                                </form>
                                <!--/ form -->
                            </div>
                        </div>

                        <!-- two-step verification -->
                        
                        <!-- / recent device -->

                        <!--/ security -->
                    </div>
                </div>
                <!-- two factor auth modal -->
                

            </div>
        </div>
    
       

@endsection