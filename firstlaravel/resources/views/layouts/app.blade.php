<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Layout</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>
<!--100% width-->
<div class="container-fluid max-vw-100 min-vh-100">
    <!--Header and navigation-->
    <div class="text-white row p-2 sticky-top rounded-bottom-4" style="background-color: #111E2B">
        <!--Left part of header-->
        <div class="col">
            <!--Logo and name-->
            <a href="{{route('invoices.index')}}"
               class="text-decoration-none text-white fs-5">
                <img src="{{asset('img/logo_umg.svg') }}" alt="" class="img-fluid px-2" style="height: 9vh;">Biuro
                Promocji
                i Komunikacji</a>
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
                <a href="" class="text-decoration-none text-white fs-5">Generuj Excel</a></div>
        </div>
    </div>
    <!--Page content -->
    <div class="row white-bar">
        @yield('content')
    </div>
    <!-- Footer -->
    <a href="https://umg.edu.pl" class="rounded-top-4  footer fixed-bottom p-3 text-white text-center mt-2 text-decoration-none"
       style="background-color: #111E2B" target="_blank">© Uniwersytet Morski w Gdyni 2024</a>
</div>

</body>
</html>
