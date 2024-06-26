<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organizer Faktur UMG</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" href="/img/logo_umg_web_icon.png" type="image/x-icon">
    <link rel="shortcut icon" href="/img/logo_umg_web_icon.png" type="image/x-icon">

</head>

<body>
<!--100% width-->
<div class="container-fluid max-vw-100 min-vh-100">
    <!--Header and navigation-->
    <div class="text-white row p-2 mr-0  sticky-top " style="background-color: #111E2B">
        <!--Left part of header-->
        <div class="col">
            <!--Logo and name-->
            <a href="{{route('invoices.index')}}"
               class="text-decoration-none text-white fs-5">
                <img src="{{asset('img/logo_umg.svg') }}" alt="" class="img-fluid px-2" style="height: 9vh;">Biuro
                Promocji / Sklepik UMG</a>
        </div>
        <!--Right part of header-->
        <div class="col-auto d-flex justify-content-end my-auto">
            <!--Button add-->
            <div class="px-4"><a href="{{route('invoices.create')}}" class="btn btn-success  text-white fs-5 px-4">Dodaj
                    fakture</a></div>
            <!--Navigation fields-->
            <div class="mt-2">
                <a href="{{ route('invoices.index') }}" class="text-decoration-none text-white fs-5  ">Lista faktur</a>
                <a href="{{ route('stock_controls.index') }}" class="text-decoration-none text-white fs-5 px-4">Archiwum</a>
                <a href="" data-toggle="modal" data-target="#excel-modal" class="text-decoration-none text-white fs-5">Generuj Excel</a></div>
        </div>
    </div>
    <!--Page content -->
    <div class="row white-bar">
        @yield('content')
    </div>
    <!-- Footer -->
    <a href="https://umg.edu.pl" class="footer fixed-bottom p-3 text-white text-center mt-2 text-decoration-none"
       style="background-color: #111E2B" target="_blank">© Uniwersytet Morski w Gdyni 2024</a>
</div>


</body>
</html>

    @include('modals.excel_modal')

<!--Script links -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
