<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Layout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resourses/css/app.css'])
    <style>


    </style>
</head>
<body>
<div class="container">
    <div class="row blue-bar">
        <p>Biuro Promocji i Komunikacji </p>
        <div class=" text-right">
            <a href="" class="brand-text">Invoice List</a>
            <a href="" class="brand-text">Archives</a>
            <a href="" class="brand-text">Generate XML</a>
        </div>
    </div>
    <div class="row white-bar">
        @yield('content')
    </div>
    <div class="row bottom-blue-bar">

    </div>
</div>


<!-- Plik JavaScript Bootstrapa (opcjonalny) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
