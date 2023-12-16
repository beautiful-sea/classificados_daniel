@extends('layouts.adm.app_dashboard')
@section('title','Usuários')
@section('content')

    <!-- BEGIN: Content-->

    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="app-user-view-account">
                <div class="row">
                    <!-- User Sidebar -->
                    <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                        <!-- User Card -->
                        <div class="card">
                            <div class="card-body">
                                <div class="user-avatar-section">
                                    <div class="d-flex align-items-center flex-column">
                                        <img class="img-fluid rounded mt-3 mb-2" src="{{$user->photo_path}}"
                                             height="110" width="110" alt="User avatar">
                                        <div class="user-info text-center">
                                            <h4>{{$user->name}}</h4>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="fw-bolder border-bottom pb-50 mb-1">Detalhes</h4>
                                <div class="info-container">
                                    <ul class="list-unstyled">
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Email:</span>
                                            <span>{{$user->email}}</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Permissão:</span>
                                            <span>{{$user->role}}</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Telefone:</span>
                                            <span>{{$user->phone_formatted}}</span>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Url:</span>
                                            @if($user->anunciante && $user->anunciante->slug)
                                            <a href="{{env('APP_URL').'/anunciante/'.$user->anunciante->slug}}"
                                               target="_blank">{{env('APP_URL').'/anunciante/'.$user->anunciante->slug}}</a>
                                               @else
                                                <span>Não possui link anunciante</span>
                                            @endif
                                        </li>
                                    </ul>
                                    {{--                                    <div class="d-flex justify-content-center pt-2">--}}
                                    {{--                                        <a href="javascript:;" class="btn btn-primary me-1 waves-effect waves-float waves-light" data-bs-target="#editUser" data-bs-toggle="modal">--}}
                                    {{--                                            Editar--}}
                                    {{--                                        </a>--}}
                                    {{--                                        <a href="javascript:;" class="btn btn-outline-danger suspend-user waves-effect">Deletar</a>--}}
                                    {{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                        <!-- /User Card -->
                        <!-- /Plan Card -->
                    </div>
                    <div class="col-xl-8 col-lg-7 col-md-5 order-1 order-md-0">
                        <!--/ User Sidebar -->
                        <div class="col-12">

                        @if($user->anunciante)

                            <!-- Project table -->
                            <div class="card">
                                <h4 class="card-header">Informações</h4>

                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <img style="border-radius: 20px"
                                                 src="{{$user->anunciante->foto_principal_path}}">
                                        </div>
                                        <div style="margin-left: 30px">
                                            <p><b>Título: </b> {{$user->anunciante->titulo}}</p>
                                            <p><b>Descrição: </b> {{$user->anunciante->descricao}}</p>
                                            <p><b>Endereço: </b> {{$user->anunciante->endereco->logradouro}}</p>
                                            @if($user->anunciante->endereco->cidade)
                                            <p><b>Cidade: </b> {{$user->anunciante->endereco->cidade->nome}}</p>
                                            @else
                                            <p><b>Cidade: </b> Não possui</p>
                                            @endif
                                            @if($user->anunciante->endereco->estado)
                                            <p><b>Estado: </b> {{$user->anunciante->endereco->estado->nome}}</p>
                                            @else
                                            <p><b>Estado: </b> Não possui</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @else 

                            <div class="card">
                                <h4 class="card-header">Informações</h4>

                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p><b>Título: </b> Não possui</p>
                                            <p><b>Descrição: </b> Não possui</p>
                                            <p><b>Endereço: </b> Não possui</p>
                                            <p><b>Cidade: </b> Não possui</p>
                                            <p><b>Estado: </b> Não possui</p>
                                        </div>
                                    </div>
                                </div>

                            
                            @endif

                        </div>
                        <!-- User Content -->
                        @if($user->is_anunciante)
                            <admin-usuarios-avaliacoes
                                    :anunciante_id="{{$user->anunciante->id}}"></admin-usuarios-avaliacoes>
                        @endif
                    </div>
                    <!--/ User Content -->
                </div>
            </section>
            <!-- Edit User Modal -->
            <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                    <div class="modal-content">
                        <div class="modal-header bg-transparent">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body pb-5 px-sm-5 pt-50">
                            <div class="text-center mb-2">
                                <h1 class="mb-1">Edit User Information</h1>
                                <p>Updating user details will receive a privacy audit.</p>
                            </div>
                            <form id="editUserForm" class="row gy-1 pt-75" onsubmit="return false"
                                  novalidate="novalidate">
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalEditUserFirstName">First Name</label>
                                    <input type="text" id="modalEditUserFirstName" name="modalEditUserFirstName"
                                           class="form-control" placeholder="John" value="Gertrude"
                                           data-msg="Please enter your first name">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalEditUserLastName">Last Name</label>
                                    <input type="text" id="modalEditUserLastName" name="modalEditUserLastName"
                                           class="form-control" placeholder="Doe" value="Barton"
                                           data-msg="Please enter your last name">
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="modalEditUserName">Username</label>
                                    <input type="text" id="modalEditUserName" name="modalEditUserName"
                                           class="form-control" value="gertrude.dev" placeholder="john.doe.007">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalEditUserEmail">Billing Email:</label>
                                    <input type="text" id="modalEditUserEmail" name="modalEditUserEmail"
                                           class="form-control" value="gertrude@gmail.com"
                                           placeholder="example@domain.com">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalEditUserStatus">Status</label>
                                    <select id="modalEditUserStatus" name="modalEditUserStatus" class="form-select"
                                            aria-label="Default select example">
                                        <option selected="">Status</option>
                                        <option value="1">Active</option>
                                        <option value="2">Inactive</option>
                                        <option value="3">Suspended</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalEditTaxID">Tax ID</label>
                                    <input type="text" id="modalEditTaxID" name="modalEditTaxID"
                                           class="form-control modal-edit-tax-id" placeholder="Tax-8894"
                                           value="Tax-8894">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalEditUserPhone">Contact</label>
                                    <input type="text" id="modalEditUserPhone" name="modalEditUserPhone"
                                           class="form-control phone-number-mask" placeholder="+1 (609) 933-44-22"
                                           value="+1 (609) 933-44-22">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalEditUserLanguage">Language</label>
                                    <div class="position-relative"><select id="modalEditUserLanguage"
                                                                           name="modalEditUserLanguage"
                                                                           class="select2 form-select select2-hidden-accessible"
                                                                           multiple=""
                                                                           data-select2-id="modalEditUserLanguage"
                                                                           tabindex="-1" aria-hidden="true">
                                            <option value="english">English</option>
                                            <option value="spanish">Spanish</option>
                                            <option value="french">French</option>
                                            <option value="german">German</option>
                                            <option value="dutch">Dutch</option>
                                            <option value="hebrew">Hebrew</option>
                                            <option value="sanskrit">Sanskrit</option>
                                            <option value="hindi">Hindi</option>
                                        </select><span class="select2 select2-container select2-container--default"
                                                       dir="ltr" data-select2-id="1" style="width: auto;"><span
                                                    class="selection"><span
                                                        class="select2-selection select2-selection--multiple"
                                                        role="combobox" aria-haspopup="true" aria-expanded="false"
                                                        tabindex="-1" aria-disabled="false"><ul
                                                            class="select2-selection__rendered"><li
                                                                class="select2-search select2-search--inline"><input
                                                                    class="select2-search__field" type="search"
                                                                    tabindex="0" autocomplete="off" autocorrect="off"
                                                                    autocapitalize="none" spellcheck="false"
                                                                    role="searchbox" aria-autocomplete="list"
                                                                    placeholder=""
                                                                    style="width: 0.75em;"></li></ul></span></span><span
                                                    class="dropdown-wrapper" aria-hidden="true"></span></span></div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="modalEditUserCountry">Country</label>
                                    <div class="position-relative"><select id="modalEditUserCountry"
                                                                           name="modalEditUserCountry"
                                                                           class="select2 form-select select2-hidden-accessible"
                                                                           data-select2-id="modalEditUserCountry"
                                                                           tabindex="-1" aria-hidden="true">
                                            <option value="" data-select2-id="3">Select Value</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="Canada">Canada</option>
                                            <option value="China">China</option>
                                            <option value="France">France</option>
                                            <option value="Germany">Germany</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Korea">Korea, Republic of</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Russia">Russian Federation</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United States">United States</option>
                                        </select><span class="select2 select2-container select2-container--default"
                                                       dir="ltr" data-select2-id="2" style="width: auto;"><span
                                                    class="selection"><span
                                                        class="select2-selection select2-selection--single"
                                                        role="combobox" aria-haspopup="true" aria-expanded="false"
                                                        tabindex="0" aria-disabled="false"
                                                        aria-labelledby="select2-modalEditUserCountry-container"><span
                                                            class="select2-selection__rendered"
                                                            id="select2-modalEditUserCountry-container" role="textbox"
                                                            aria-readonly="true"
                                                            title="Select Value">Select Value</span><span
                                                            class="select2-selection__arrow" role="presentation"><b
                                                                role="presentation"></b></span></span></span><span
                                                    class="dropdown-wrapper" aria-hidden="true"></span></span></div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex align-items-center mt-1">
                                        <div class="form-check form-switch form-check-primary">
                                            <input type="checkbox" class="form-check-input" id="customSwitch10"
                                                   checked="">
                                            <label class="form-check-label" for="customSwitch10">
                                                <span class="switch-icon-left"><svg xmlns="http://www.w3.org/2000/svg"
                                                                                    width="14" height="14"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    stroke="currentColor"
                                                                                    stroke-width="2"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="feather feather-check"><polyline
                                                                points="20 6 9 17 4 12"></polyline></svg></span>
                                                <span class="switch-icon-right"><svg xmlns="http://www.w3.org/2000/svg"
                                                                                     width="14" height="14"
                                                                                     viewBox="0 0 24 24" fill="none"
                                                                                     stroke="currentColor"
                                                                                     stroke-width="2"
                                                                                     stroke-linecap="round"
                                                                                     stroke-linejoin="round"
                                                                                     class="feather feather-x"><line
                                                                x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6"
                                                                                                           x2="18"
                                                                                                           y2="18"></line></svg></span>
                                            </label>
                                        </div>
                                        <label class="form-check-label fw-bolder" for="customSwitch10">Use as a billing
                                            address?</label>
                                    </div>
                                </div>
                                <div class="col-12 text-center mt-2 pt-50">
                                    <button type="submit"
                                            class="btn btn-primary me-1 waves-effect waves-float waves-light">Submit
                                    </button>
                                    <button type="reset" class="btn btn-outline-secondary waves-effect"
                                            data-bs-dismiss="modal" aria-label="Close">
                                        Discard
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Edit User Modal -->


        </div>
    </div>

@endsection
