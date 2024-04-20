@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 10vh">
        <div class="row">
            <!-- Header name -->
            <h1 class="strong d-flex justify-content-center mt-4">Archiwum dla miesiąca: {{ $month }}</h1>
        </div>
        @include('components.stock_controls_search')
        @include('components.alert')

        <div class="container rounded text-white w-75 p-1 mb-2" style="background-color: #1E2F47">
            <div class="col-8 w-100 rounded">
                <table class="  table text-white text-center" style="background-color:#1E2F47;">
                    <thead class="thead-dark border-0">
                    <tr style="background-color: #111E2B;" class="text-white">
                        <th scope="col">Operacja</th>
                        <th scope="col">Numer faktury</th>
                        <th scope="col">Nazwa produktu</th>
                        <th scope="col">Data operacji</th>
                        <th scope="col">Ilość</th>
                        <th scope="col">Przeniesione</th>
                        <th></th>
                    </tr>
                    </thead>
                    <!-- Table content -->
                    <tbody>
                    <!-- Wyświetlenie rekordów dla danego miesiąca -->
                    @foreach($stocks as $stock)
                        <tr class="border-0">
                            <td>{{ $stock->title }}</td>
                            <td>{{ $stock->invoice_id }}</td>
                            <td>{{ $stock->product_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($stock->operation_date)->format('Y-m-d') }}</td>
                            <td>{{ $stock->quantity }} szt.</td>
                            <td>{{ $stock->move_to }}</td>
                            <td>
                                <a href="" data-toggle="modal" data-target="#edit-modal-{{ $stock->id }}"
                                   class="btn btn-primary m-auto">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    </script>
    @foreach($stocks as $stock)
        @include('modals.archiwe_edit_modal', ['id' => $stock->id])
    @endforeach
    <!--Script links -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
