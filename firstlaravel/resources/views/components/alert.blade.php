@if(session()->has('success'))
    <div id="success-alert" class="alert alert-success w-50 container fade show">
        {{ session()->get('success') }}
    </div>
    <style>
        /* Dodajemy niestandardową animację do alertu */
        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }
        .alert.fade.show {
            animation: fadeOut 7s ease forwards;
        }
    </style>
    <script>
        // Po załadowaniu strony, dodajemy funkcję, która usunie alert po zakończeniu animacji
        document.addEventListener('DOMContentLoaded', function () {
            var alert = document.getElementById('success-alert');
            setTimeout(function () {
                alert.classList.remove('show'); // Usuwamy klasę "show", aby zainicjować animację znikania
                setTimeout(function () {
                    alert.parentNode.removeChild(alert); // Usuwamy alert po zakończeniu animacji
                }, 0); // Czas trwania animacji w milisekundach (tutaj 1000ms = 1s)
            }, 3000); // Czas, po którym alert zacznie znikać (tutaj 9000ms = 9s)
        });
    </script>
@endif
