@extends('layouts.adm.app_dashboard')
@section('title','Usuários')
@section('content')

    @section('css')
        
        <link rel="stylesheet" type="text/css" href="adm/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" type="text/css" href="adm/css/responsive.bootstrap5.min.css">
        <link rel="stylesheet" type="text/css" href="adm/css/buttons.bootstrap5.min.css">
        <link rel="stylesheet" type="text/css" href="adm/css/horizontal-menu.css">
        <link rel="stylesheet" type="text/css" href="adm/css/form-validation.css">
        
    @endsection

    <!-- BEGIN: Content-->
    
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <h3>Lista de usuários</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam quaerat qui (libero ab itaque tenetur ea)</p>

            <!-- Permission Table -->
            <div class="card" style="border-radius: 5px; ">
                <div class="top-table">
                    <div class="exibir">
                        <p>Exibindo </p>
                        <select name="tabela-length" class="form-select">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    
                    <div class="btn_cadastrar">
                        
                        <!-- <button type="button" class="btn btn-primary btn-table">Cadastrar</button> -->
                        <div class="form-modal-ex">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-table" data-bs-toggle="modal" data-bs-target="#inlineForm">
                                Cadastrar
                            </button>
                            <!-- Modal -->
                            <div class="modal fade text-start" id="inlineForm" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel33">Cadastrar Usuário</h4>
                                            <button style="width: 20px;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="#">
                                            <div class="modal-body">
                                                <label>Nome: </label>
                                                <div class="mb-1">
                                                    <input type="text" placeholder="Nome do Usuário" class="form-control" />
                                                </div>

                                                <label>Profissão: </label>
                                                <div class="mb-1">
                                                    <select id="state" class="select2 form-select">
                                                        <option value="">Pedreiro</option>
                                                        <option value="rj">Mecânico</option>
                                                        <option value="sp">Diarista</option>
                                                    </select>
                                                </div>
                                                <label>Localização: </label>
                                                <div class="mb-1">
                                                    <input type="text" placeholder="Localização do Usuário" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cadastrar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="procurar">

                        <p>Buscar <input class="input-table" type="text" placeholder="Buscar usuário"></p>
                        

                    </div>

                </div>
                <hr>
                <div class="card-datatable table-responsive " style="border-radius: 5px;">
                    <table class=" table" style="border-top: 10px;">
                        <thead class="table-light" >
                            <tr class="tabela">
                                
                                
                                <th>Nome</th>
                                <th>Profissão</th>
                                <th>Membro des de</th>
                                <th>Localização</th>
                                
                                
                            </tr>
                            
                        </thead>
                        <tbody class="table-primary">
                            <tr class="tabela">
                                
                                
                                <td style="color: black;">Jorge Jesus</td>
                                <td style="color: black;">Pedreiro</td>
                                <td style="color: black;">02/05/2023</td>
                                <td style="color: black;">Valença RJ</td>
                                
                                
                            </tr>
                            
                        </tbody>
                        
                    </table>
                </div>
            </div>
            <!--/ Permission Table -->
            <!-- Add Permission Modal -->
            
            <!--/ Edit Permission Modal -->

        </div>
    </div>
    
    
    @section('js')
    
    <script src="adm/js/dataTables.bootstrap5.min.js"></script>
    <script src="adm/js/dataTables.responsive.min.js"></script>
    <script src="adm/js/responsive.bootstrap5.js"></script>
    <script src="adm/js/datatables.buttons.min.js"></script>
    <script src="adm/js/buttons.bootstrap5.min.js"></script>
    <script src="adm/js/jquery.validate.min.js"></script>
    <script src="adm/js/components-modals.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
    <!-- END: Page JS-->
    @endsection
@endsection