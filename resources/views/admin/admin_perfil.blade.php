@extends('layouts.adm.app_dashboard')
@section('title','Perfil Admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="adm/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="adm/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="adm/css/sweetalert2.min.css">
    <!-- END: Vendor CSS-->

    <link rel="stylesheet" type="text/css" href="adm/css/ext-component-sweet-alerts.css">
    <link rel="stylesheet" type="text/css" href="adm/css/form-validation.css">
@endsection
@section('content')

    
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    

                    <!-- profile -->
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">Detalhes do perfil</h4>
                        </div>
                        <div class="card-body py-2 my-25">
                            <!-- header section -->
                            <div class="d-flex">
                                <a href="#" class="me-25">
                                    <img src="images/avatar.jpg" id="account-upload-img" class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100" />
                                </a>
                                <!-- upload and reset button -->
                                <div class="d-flex align-items-end mt-75 ms-1">
                                    <div>
                                        <label for="account-upload" class="btn btn-sm btn-primary mb-75 me-75">Upload</label>
                                        <input type="file" id="account-upload" hidden accept="image/*" />
                                        <button type="button" id="account-reset" class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
                                        <p class="mb-0">Formatos aceitos: png, jpg, jpeg.</p>
                                    </div>
                                </div>
                                <!--/ upload and reset button -->
                            </div>
                            <!--/ header section -->

                            <!-- form -->
                            <form class="validate-form mt-2 pt-50">
                                <div class="row">
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="accountFirstName">Nome</label>
                                        <input type="text" class="form-control" id="accountFirstName" name="firstName" placeholder="Nome" value="Jorge" data-msg="Insira seu nome" />
                                    </div>
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="accountLastName">Sobrenome</label>
                                        <input type="text" class="form-control" id="accountLastName" name="lastName" placeholder="Sobrenome" value="Jesus" data-msg="Insira seu sobrenome" />
                                    </div>
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="accountEmail">Email</label>
                                        <input type="email" class="form-control" id="accountEmail" name="email" placeholder="Email" value="jorge.jesus@mail.com" />
                                    </div>
                                
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="accountPhoneNumber">Telefone</label>
                                        <input type="text" class="form-control account-number-mask" id="accountPhoneNumber" name="phoneNumber" placeholder="Telefone" value="457 657 1237" />
                                    </div>
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="accountAddress">Endereço</label>
                                        <input type="text" class="form-control" id="accountAddress" name="address" placeholder="Seu endereço" />
                                    </div>
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="state">Estado</label>
                                        <select id="state" class="select2 form-select">
                                            <option value="">Selecione seu estado</option>
                                            <option value="rj">Rio de Janeiro</option>
                                            <option value="sp">São Paulo</option>
                                            
                                            
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="accountZipCode">CEP</label>
                                        <input type="text" class="form-control account-zip-code" id="accountZipCode" name="zipCode" placeholder="CEP" maxlength="7" />
                                    </div>
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="country">Cidade</label>
                                        <select id="country" class="select2 form-select">
                                            <option value="">Selecione sua cidade</option>
                                            <option value="Valenca">Valença</option>
                                            <option value="Barra_do_pirai">Barra do Piraí</option>
                                            <option value="Rio_preto">Rio Preto</option>
                                            <option value="Rio_das_flores">Rio das Flores</option>
                                            
                                        </select>
                                    </div>
                                    
                                    
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mt-1 me-1">Salvar Mudanças</button>
                                        <button type="reset" class="btn btn-outline-secondary mt-1">Descartar</button>
                                    </div>
                                </div>
                            </form>
                            <!--/ form -->
                        </div>
                    </div>

                    <!-- deactivate account  -->
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">Desativar Conta</h4>
                        </div>
                        <div class="card-body py-2 my-25">
                            <div class="alert alert-warning">
                                <h4 class="alert-heading">Você tem certeza de que deseja desativar sua conta?</h4>
                                <div class="alert-body fw-normal">
                                    Uma vez desativada não haverá volta, tenha certeza!
                                </div>
                            </div>

                            <form id="formAccountDeactivation" class="validate-form" onsubmit="return false">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" data-msg="Please confirm you want to delete account" />
                                    <label class="form-check-label font-small-3" for="accountActivation">
                                        Eu confirmo a desativação da minha conta
                                    </label>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-danger deactivate-account mt-1">Desativar Conta</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--/ profile -->
                </div>
            </div>

        </div>
    </div>
    
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>





@section('js')

    <script src="adm/js/select2.full.min.js"></script>
    <script src="adm/js/sweetalert2.all.min.js"></script>
    <script src="adm/js/jquery.validate.min.js"></script>
    <script src="adm/js/cleave.min.js"></script>
    <script src="adm/js/cleave-phone.us.js"></script>
    <script src="adm/js/page-account-settings-account.js"></script>
    

@endsection
@endsection