@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 10vh">
        <div class="row">
            <!-- Header name -->
            <h1 class="strong d-flex justify-content-center mt-4">Archiwum</h1>
        </div>
        @include('components.stock_controls_search')

    @foreach(array_reverse($months) as $month => $data)
            <div class="container rounded text-white w-75 p-1 mb-2" style="background-color: #1E2F47">
                <div class="container d-flex">
                    <div class="col text-center">
                        <button class="btn btn-outline-light m-auto" type="button" data-bs-toggle="collapse" data-bs-target="#toggleContent{{$loop->iteration}}"
                                aria-expanded="false" aria-controls="toggleContent{{$loop->iteration}}">
                            <i id="arrowIcon{{$loop->iteration}}" class="fas fa-arrow-down"></i>
                        </button>
                    </div>
                    <div class="col text-center h4 m-auto">{{ \ucfirst(\Carbon\Carbon::parse($month)->locale('pl')->isoFormat('MMMM')) }}

                    </div>
                    <div class="col h4 text-center m-auto">01/{{ \Carbon\Carbon::parse($month)->endOfMonth()->format('d.m.Y') }}</div>
                </div>
                </button>
                <div class="rounded mt-2 collapse" id="toggleContent{{$loop->iteration}}">
                    <!-- Table style -->
                        <div class="col-8 w-100 ">
                            <!-- Table -->
                            <table class="table text-white text-center  " style="background-color:#1E2F47;">
                                <!-- Table head style -->
                                <thead class="thead-dark">
                                <!-- Table head writing -->
                                <tr style="background-color: #111E2B;" class="text-white border">
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
                                <tbody >
                                <!-- Printing all records from the invoice table -->
                                @foreach($data['stocks'] as $stock)
                                    <!-- Table content writing -->
                                    <tr >
                                        <td class="border">{{$stock->title}}</td>
                                        <td class="border">{{$stock->invoice_id}}</td>
                                        <td class="border">{{$stock->product_name}}</td>
                                        <td class="border">{{$stock->operation_date->format('Y-m-d')}}</td>
                                        <td class="border">{{$stock->quantity}}szt.</td>
                                        <td class="border">{{$stock->move_to}}</td>
                                        <td class="border">
                                            <!-- Edit button -->
                                            <a href="{{ route('stock_controls.edit',['id'=>$stock->id]) }}"
                                               class="btn btn-primary ">
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
        @endforeach
    </div>

    <!-- Bootstrapa -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript -->
    <script>
        @foreach($months as $month => $data)
        document.getElementById("toggleContent{{$loop->iteration}}").addEventListener('show.bs.collapse', function () {
            document.getElementById("arrowIcon{{$loop->iteration}}").classList.remove("fa-arrow-down");
            document.getElementById("arrowIcon{{$loop->iteration}}").classList.add("fa-arrow-up");
        });

        document.getElementById("toggleContent{{$loop->iteration}}").addEventListener('hide.bs.collapse', function () {
            document.getElementById("arrowIcon{{$loop->iteration}}").classList.remove("fa-arrow-up");
            document.getElementById("arrowIcon{{$loop->iteration}}").classList.add("fa-arrow-down");
        });
        @endforeach
    </script>
@endsection
