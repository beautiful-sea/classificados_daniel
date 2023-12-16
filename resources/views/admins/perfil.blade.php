@extends('layouts.adm.app_dashboard')
@section('title','Perfil Admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="/adm/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/adm/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="/adm/css/sweetalert2.min.css">
    <!-- END: Vendor CSS-->

    <link rel="stylesheet" type="text/css" href="/adm/css/ext-component-sweet-alerts.css">
    <link rel="stylesheet" type="text/css" href="/adm/css/form-validation.css">
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
                            <!-- form -->
                            <form action="/admin/perfil/update" method="POST" enctype="multipart/form-data" class="validate-form mt-2 pt-50">
                            <!-- header section -->
                            <div class="d-flex  mb-5">
                                <a href="#" class="me-25">
                                    <img {!! auth()->user()->photo_path?'src="'.Storage::url('users/'.auth()->user()->photo_path,'public').'"':'src="/images/avatar.jpg"' !!} id="account-upload-img" class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100" />
                                </a>
                                <!-- upload and reset button -->
                                <div class="d-flex align-items-end mt-75 ms-1">
                                    <div>
                                        <label for="account-upload" class="btn btn-sm btn-primary mb-75 me-75">Upload</label>
                                        <input type="file" name="image" id="account-upload" hidden accept="image/*" />
                                        <button type="button" id="account-reset" class="btn btn-sm btn-outline-secondary mb-75">Remover</button>
                                        <p class="mb-0">Formatos aceitos: png, jpg, jpeg.</p>
                                    </div>
                                </div>
                                <!--/ upload and reset button -->
                            </div>
                            <!--/ header section -->


                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="accountFirstName">Nome</label>
                                        <input type="text" class="form-control" id="accountFirstName" name="name" placeholder="Nome" value="{{auth()->user()->name}}" data-msg="Insira seu nome" />
                                    </div>
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="accountEmail">Email</label>
                                        <input type="email" class="form-control" id="accountEmail" name="email" placeholder="Email" value="{{auth()->user()->email}}" />
                                    </div>

                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="phone">Telefone</label>
                                        <input type="text" class="form-control " value="{{auth()->user()->phone??null}}" id="phone" name="phone" placeholder="Telefone"  />
                                    </div>
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="cep">CEP</label>
                                        <input type="text" class="form-control "  value="{{auth()->user()->endereco->cep??null}}" id="cep" name="cep" placeholder="CEP"  />
                                    </div>
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="state">Estado</label>
                                        <select id="estado" name="estado_id" class="select2 form-select">
                                            <option>Selecione um estado</option>

                                           @foreach($estados as $estado)

                                            <option value="{{$estado->id}}" {!! auth()->user()->endereco && auth()->user()->endereco->estado_id === $estado->id?'selected="true"':'' !!}  >{{$estado->nome}}</option>
                                           @endforeach

                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="country">Cidade</label>
                                        <select id="cidade" name="cidade_id" class="select2 form-select">
                                            @if(auth()->user()->endereco && auth()->user()->endereco->cidade_id)
                                                <option value="{{auth()->user()->endereco->cidade_id}}" selected>{{auth()->user()->endereco->cidade->nome}}</option>
                                            @else
                                            <option value="0" >Selecione sua cidade</option>
                                                @endif
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="logradouro">Endereço</label>
                                        <input type="text" class="form-control" id="logradouro" value="{{auth()->user()->endereco->logradouro??null}}" name="logradouro" placeholder="Endereço completo" />
                                    </div>
                                   <div class="col-12">
                                       @foreach($errors->all() as $error)
                                           <div class="alert alert-danger" role="alert">
                                               {{$error}}
                                           </div>
                                       @endforeach
                                   </div>
                                    <div class="col-12">
                                        @if (session('success'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('success') }}
                                            </div>
                                            @endif
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mt-1 me-1">Salvar Mudanças</button>
                                    </div>
                                </div>
                            </form>
                            <!--/ form -->
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>

    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>





@section('js')

    <script src="/adm/js/select2.full.min.js"></script>
    <script src="/adm/js/sweetalert2.all.min.js"></script>
    <script src="/adm/js/jquery.validate.min.js"></script>
    <script src="/adm/js/cleave.min.js"></script>
    <script src="/adm/js/cleave-phone.us.js"></script>
    <script>
        //Ao selecionar imagem de perfil, carrega a imagem
        $('#account-upload').on('change', function() {
            var file = $(this).get(0).files;
            var reader = new FileReader();
            reader.readAsDataURL(file[0]);
            reader.addEventListener("load", function(e) {
                var image = e.target.result;
                $('#account-upload-img').attr('src', image);
            });
        });

        //Ao remover imagem de perfil, remove a imagem
        $('#account-reset').on('click', function() {
            $('#account-upload-img').attr('src', '/images/avatar.jpg');
            $('#account-upload').val('');
        });

        //Ao selecionar estado, carrega as cidades usando select2
        $('#estado').on('change', function() {
            var id = $(this).val();
            $('#cidade').prop('disabled', false);
            $('#cidade').select2({
                ajax: {
                    url: '/cidades/get/' + id,
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.nome,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        });

        //Mascara para o CEP pt-br
         new Cleave('#cep', {
            blocks: [5, 3],
            delimiter: '-',
            numericOnly: true
        });
        //Mascara para o telefone pt-br
         new Cleave('#phone', {
            phoneRegionCode: 'BR',
            delimiter: ' ',
            blocks: [0,2, 5, 4],
            delimiters: ['(', ') ',  '-'],

        });
    </script>


@endsection
@endsection
