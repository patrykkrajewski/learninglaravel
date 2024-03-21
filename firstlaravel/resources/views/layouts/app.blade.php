<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Layout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resourses/css/app.css'])
</head>
<body>

<div class="container-fluid justify-content-start">
    <div class="text-white row p-2 sticky-top" style="background-color: #111E2B">
        <div class="col">
            <a href="https://umg.edu.pl/biuro-promocji-i-komunikacji" target="_blank"
               class="text-decoration-none text-white fs-5">
                <img src="{{asset('logo_umg.svg') }}" alt="" class="img-fluid px-2" style="height: 9vh;">Biuro Promocji
                i Komunikacji</a>
        </div>
        <div class="col-auto d-flex justify-content-end my-auto">
            <div class="px-4"><a href="{{route('invoices.create')}}" class="btn btn-success  text-white fs-5 px-4">Dodaj fakture</a></div>
            <div class="mt-2">
            <a href="{{ route('invoices.index') }}" class="text-decoration-none text-white fs-5  ">Lista faktur</a>
            <a href="" class="text-decoration-none text-white fs-5 px-4">Archiwum</a>
            <a href="" class="text-decoration-none text-white fs-5">Generator XML</a></div>
        </div>
    </div>
    <div class="row white-bar">
        @yield('content')
    </div>
    <div class="footer fixed-bottom p-3 text-white text-center mt-2" style="background-color: #111E2B">
        © Uniwersytet Morski w Gdyni 2024
    </div>

</div>
<!-- Plik JavaScript Bootstrapa (opcjonalny) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
