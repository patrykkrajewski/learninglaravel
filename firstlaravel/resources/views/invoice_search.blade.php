@extends('layouts.app')
@section('content')
    <div style="margin-bottom: 10vh">
        <!--Header-->
        <div class="row">
            <!--Header name-->
            <h1 class="strong d-flex justify-content-center mt-4">Lista Faktur</h1>
        </div>
        <!--Search bar-->
        @include('components.invoice_list_search')
        <!--Table style-->
        <div class="row justify-content-center">
            <div class="col-8">
                <!--Table-->
                <table class="table table-bordered text-white text-center" style="background-color: #1E2F47;">
                    <!--Table head style-->
                    <thead class="thead-dark">
                    <!--Table head writing-->
                    <tr style="background-color: #111E2B;" class="text-white">
                        <th scope="col">Numer</th>
                        <th scope="col">Nazwa produktu</th>
                        <th scope="col">Data wystawienia</th>
                        <th scope="col">Ilość na fakturze</th>
                        <th scope="col">Ilość aktualna</th>
                        <th scope="col">Cena[netto]</th>
                        <th scope="col">Podatek VAT</th>
                        <th scope="col">Miejsce</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <!--Table content-->
                    <tbody>
                    <!--Printing all records from the invoice table-->
                    @foreach ($results as $result)
                        <!--Table content writing-->
                        <tr>
                            <td>{{ $result->invoice_number }}</td>
                            <td>{{ $result->product_name }}</td>
                            <td>{{ $result->invoice_date->format('Y-m-d')}}</td>
                            <td>{{ $result->quantity }}szt.</td>
                            <td>{{ $result->invoice_quantity }}szt.</td>
                            <td>{{ $result->price }}zł</td>
                            <td>{{ intval($result->vat_rate) }}%</td>
                            <td>
                                <!-- Move button-->
                                <div class="d-flex justify-content-start text-center">
                                    <a href=""
                                       class="btn btn-secondary " data-toggle="modal"
                                       data-target="#move-modal-{{$result->id}}">
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                    <span class="px-3">{{$result->place}}</span>
                                </div>
                            <td class="col d-flex justify-content-start">
                                <!-- Delete button-->
                                <a href="{{ route('invoices.edit',['id'=>$result->id]) }}"
                                   class="btn btn-danger fw-bold" data-toggle="modal"
                                   data-target="#delete-modal-{{$result->id}}">
                                    <i class="fas fa-minus"></i>
                                </a>
                                <!-- Edit button-->
                                <a href="{{ route('invoices.edit',['id'=>$result->id]) }}"
                                   class="btn btn-primary m-auto">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- Add button-->
                                <a href="" class="btn btn-success fw-bold" data-toggle="modal"
                                   data-target="#add-modal-{{$result->id}}">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!--Scrolling tables-->
            <div class="col-8 d-flex justify-content-center">
                @if($results->previousPageUrl())
                    <!--Left scroll-->
                    <a href="{{$results->previousPageUrl()}}" class="px-5"><img src="{{asset('img/arrow_l.png') }}"
                                                                                alt=""></a>
                @endif
                @if($results->nextPageUrl())
                    <!--Right scroll-->
                    <a href="{{$results->nextPageUrl()}}" class="px-5"><img src="{{asset('img/arrow_p.png') }}" alt=""></a>
                @endif
            </div>
        </div>
        <!-- Modals czy musze robic dla kazdego nowy szablon ze zmienina zmienna z request na invoice-->

@endsection
