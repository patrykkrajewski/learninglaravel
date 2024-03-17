<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Layout</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>

        body{
            margin: 0;
            padding: 0;
        }
        /* Dodatkowe style dla dostosowania pasków */
        .blue-bar {
            background-color: #111E2B; /* Niebieski kolor */
            height: 5vh; /* Wysokość 5% widoku */
            width: 100vw;
        }
        .white-bar {
            height: 85vh; /* Wysokość 85% widoku */
            width: 100vw;

        }
        .bottom-blue-bar {
            background-color: #111E2B; /* Niebieski kolor */
            height: 10vh; /* Wysokość 10% widoku */
            width: 100vw;
        }
        .ovner_name {
            color: #ffffff; /* Biały kolor */
            font-size: 2.1vh; /* Rozmiar tekstu */
            font-weight: bold; /* Pogrubienie tekstu */
        }



    </style>
</head>
<body>
<div class="container-fluid">
    <!-- Górny pasek niebieski -->
    <div class="row blue-bar">
        <div class="">
            <span class="brand-text .float-md-end ovner_name">Biuro Promocji i Komunikacji</span>
        </div>
        <div class="col-10 d-flex justify-content-end">
            <a href="" class="brand-text">Invoice List</a>
            <a href="" class="brand-text">Archives</a>
            <a href="" class="brand-text">Generate XML</a>
        </div>
    </div>

    <!-- Pasek biały -->
    <div class="row white-bar">
            <!-- Logo umieszczone w prawej kolumnie -->
            <img src="{{ asset('logo.svg') }}" alt="logo" class="logo-img">

            @yield('content')
            <!-- Tutaj możesz dodać treść dla głównego obszaru -->
        </div>
    </div>

    <!-- Dolny pasek niebieski -->
    <div class="row bottom-blue-bar">
    </div>
</div>

<!-- Plik JavaScript Bootstrapa (opcjonalny) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
