@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 10vh">
        <!-- Header -->
        <div class="row">
            <!-- Header name -->
            <h1 class="strong d-flex justify-content-center mt-4">Archiwum</h1>
        </div>
        <!-- Search bar -->
        @include('components.stock_controls_search')
        @include('components.alert')

        <!-- Table style -->
        <div class="row justify-content-center">
            <div class="col-8">
                <!-- Table -->
                <table class="table text-white text-center" style="background-color: #1E2F47;">
                    <!-- Table head style -->
                    <thead class="thead-dark">
                    <!-- Table head writing -->
                    <tr style="background-color: #111E2B;" class="text-white">
                        <th scope="col">Tytuł</th>
                        <th scope="col">Numer faktury</th>
                        <th scope="col">Nazwa produktu</th>
                        <th scope="col">Data operacji</th>
                        <th scope="col">Ilość</th>
                        <th scope="col">Przenieśenie</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <!-- Table content -->
                    <tbody>
                    <!-- Printing all records from the stock_controls table -->
                    @foreach ($results as $result)
                        <!-- Table content writing -->
                        <tr class="border-0">
                            <td>{{ $result->title }}</td>
                            <td>{{ $result->invoice_id }}</td>
                            <td>{{ $result->product_name }}</td>
                            <td>{{ $result->operation_date->format('Y-m-d') }}</td>
                            <td>{{ $result->quantity }}szt.</td>
                            <td>{{ $result->move_to }}</td>
                            <td class="col d-flex justify-content-start">
                                <!-- Edit button -->
                                <a href=" " data-toggle="modal"
                                   data-target="#edit-modal-{{$result->id}}"
                                   class="btn btn-primary m-auto">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Scrolling tables -->
            <div class="col-8 d-flex justify-content-center">
                @if ($results->previousPageUrl())
                    <!-- Left scroll -->
                    <a href="{{ $results->previousPageUrl() }}" class="px-5"><img
                            src="{{ asset('img/arrow_l.png') }}" alt=""></a>
                @endif
                @if ($results->nextPageUrl())
                    <!-- Right scroll -->
                    <a href="{{ $results->nextPageUrl() }}" class="px-5"><img
                            src="{{ asset('img/arrow_p.png') }}" alt=""></a>
                @endif
            </div>
        </div>
    </div>
    @foreach($results as $result)
        @include('modals.edit_stock_controls_search_modal', ['id' => $result->id])
    @endforeach
    <!--Script links -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection

