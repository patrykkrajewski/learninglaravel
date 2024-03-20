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
<div class="blue-bar text-white" style="background-color: #111E2B">
    <a href="https://umg.edu.pl/biuro-promocji-i-komunikacji" target="_blank" class="text-decoration-none text-white mr-auto">Biuro Promocji i Komunikacji</a>
    <div class="d-flex align-items-center" >
        <a href="" class="text-decoration-none text-white">Lista faktur</a>
        <a href="" class="text-decoration-none text-white">Archiwum</a>
        <a href="" class="text-decoration-none text-white">Generator XML</a>
    </div>
</div>


<div class="row white-bar">
    @yield('content')
</div>
<div class="footer fixed-bottom " style="background-color: #111E2B">
    footer <br>
    footer
</div>


<!-- Plik JavaScript Bootstrapa (opcjonalny) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
