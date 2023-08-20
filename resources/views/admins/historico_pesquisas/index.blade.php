@extends('layouts.adm.app_dashboard')
@section('title','Histórico de pesquisas')
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

    <div class="container">

        <p> Visualize aqui o histórico de pesquisas realizadas pelos usuários do site.</p>
        <table class="table">
            <thead>
            <tr>
                <th>Termo</th>
                <th>IP</th>
            </tr>
            </thead>
            <tbody>
            @foreach($historico_pesquisas as $historico_pesquisa)
                <tr>
                    <td>{{$historico_pesquisa->termo}}</td>
                    <td>{{$historico_pesquisa->ip}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
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
