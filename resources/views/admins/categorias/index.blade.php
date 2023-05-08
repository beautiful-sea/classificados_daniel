@extends('layouts.adm.app_dashboard')
@section('title','Categorias')
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
    <admin-categorias></admin-categorias>


    @section('js')

    <script src="adm/js/dataTables.bootstrap5.min.js"></script>
    <script src="adm/js/dataTables.responsive.min.js"></script>
    <script src="adm/js/responsive.bootstrap5.js"></script>
    <script src="adm/js/datatables.buttons.min.js"></script>
    <script src="adm/js/buttons.bootstrap5.min.js"></script>
    <script src="adm/js/jquery.validate.min.js"></script>
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
