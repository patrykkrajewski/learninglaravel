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

        <div class="container rounded text-white w-75 p-1 " style="background-color: #1E2F47">
            <div class="container d-flex ">
                <div class="col text-center">
                    <button class="btn btn-outline-light m-auto" type="button" data-bs-toggle="collapse" data-bs-target="#toggleContent"
                            aria-expanded="false" aria-controls="toggleContent">
                        <i id="arrowIcon" class="fas fa-arrow-down"></i>
                    </button>
                </div>
                <div class="col text-center h4 m-auto">Grudzień</div>
                <div class="col h4 text-center m-auto">01/31.12.2024</div>
            </div>

            <div class="rounded mt-2 collapse" id="toggleContent" style="background-color: #2B466B;">
                <!-- Table style -->
                <div class="row justify-content-center ">
                    <div class="col-8">
                        <!-- Table -->
                        <table class="table table-bordered text-white text-center mt-3 " style="background-color: #1E2F47;">
                            <!-- Table head style -->
                            <thead class="thead-dark">
                            <!-- Table head writing -->
                            <tr style="background-color: #111E2B;" class="text-white">
                                <th scope="col">Operacja</th>
                                <th scope="col">Numer faktury</th>
                                <th scope="col">Nazwa produktu</th>
                                <th scope="col">Data operacji</th>
                                <th scope="col">Ilość</th>
                                <th scope="col">Przeniesione do</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <!-- Table content -->
                            <tbody>
                            <!-- Printing all records from the invoice table -->
                            @foreach($stocks as $stock)
                                <!-- Table content writing -->
                                <tr>
                                    <td>{{$stock->title}}</td>
                                    <td>{{$stock->invoice_id}}</td>
                                    <td>{{$stock->product_name}}</td>
                                    <td>{{$stock->operation_date->format('Y-m-d')}}</td>
                                    <td>{{$stock->quantity}}szt.</td>
                                    <td>{{$stock->move_to}}</td>
                                    <td class="col d-flex justify-content-start">
                                        <!-- Edit button -->
                                        <a href="{{ route('stock_controls.edit',['id'=>$stock->id]) }}"
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
        </div>
    </div>

    <!-- Bootstrapa -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript -->
    <script>
        document.getElementById("toggleContent").addEventListener('show.bs.collapse', function () {
            document.getElementById("arrowIcon").classList.remove("fa-arrow-down");
            document.getElementById("arrowIcon").classList.add("fa-arrow-up");
        });

        document.getElementById("toggleContent").addEventListener('hide.bs.collapse', function () {
            document.getElementById("arrowIcon").classList.remove("fa-arrow-up");
            document.getElementById("arrowIcon").classList.add("fa-arrow-down");
        });
    </script>
@endsection
