@extends('layouts.app')

@section('content')
    <div style="margin-bottom: 10vh">
        <!--Header-->
        <div class="row">
            <!--Header name-->
            <h1 class="strong d-flex justify-content-center mt-4">Lista Faktur</h1>
        </div>
        <!--Search bar-->
        <div class="d-flex justify-content-center mb-4">
            <nav class="navbar navbar-light bg-light">
                <!--Search form-->
                <form method="GET" action="{{ route('invoices.search') }}" class="form-inline d-flex">
                    <!--Search by name or number-->
                    <input name="search" class="form-control w-5" type="search" placeholder="Nazwa/Numer"
                           aria-label="Search">
                    <!--Search by start date-->
                    <input name="start_date" class="form-control w-3" type="date" placeholder="Start Date"
                           aria-label="Start Date">
                    <!--Search by end date-->
                    <input name="end_date" class="form-control w-3" type="date" placeholder="End Date"
                           aria-label="End Date">
                    <!--Search button-->
                    <button class="btn btn-outline-success" type="submit">Wyszukaj</button>
                </form>
            </nav>
        </div>
        <!--Table style-->
        <div class="row justify-content-center ">
            <div class="col-8">
                <!--Table-->
                <table class="table table-bordered text-white text-center " style="background-color: #1E2F47;">
                    <!--Table head style-->
                    <thead class="thead-dark">
                    <!--Table head writing-->
                    <tr style="background-color: #111E2B;" class="text-white">
                        <th scope="col ">Numer</th>
                        <th scope="col">Nazwa produktu</th>
                        <th scope="col">Data wystawienia</th>
                        <th scope="col">Ilość</th>
                        <th scope="col">Cena</th>
                        <th scope="col">Podatek VAT</th>
                        <th scope="col">Miejsce</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <!--Table content-->
                    <tbody>
                    <!--Printing all records from the invoice table-->
                    @foreach($invoices as $invoice)
                        <!--Table content writing-->
                        <tr>
                            <td>{{$invoice->invoice_number}}</td>
                            <td>{{$invoice->product_name}}</td>
                            <td>{{$invoice->invoice_date->format('Y-m-d')}}</td>
                            <td>{{$invoice->quantity}}szt.</td>
                            <td>{{$invoice->price}}zł</td>
                            <td>{{ intval($invoice->vat_rate) }}%</td>
                            <td>
                                <!--Table content writing-->
                                <div class="d-flex justify-content-start text-center">
                                    <!-- Move button-->
                                    <a href=""
                                       class="btn btn-secondary " data-toggle="modal" data-target="#move_model">
                                        <i class="fas fa-arrow-right"></i>
                                    </a>

                                    <span class="px-3">{{$invoice->place}}</span>
                                </div>

                            </td>
                            <td class="col d-flex justify-content-start">
                                <!-- Delete button-->
                                <a href=""
                                   class="btn btn-danger fw-bold" data-toggle="modal" data-target="#delete_model">
                                    <i class="fas fa-minus"></i>
                                </a>
                                <!-- Edit button-->
                                <a href="{{ route('invoices.edit',['id'=>$invoice->id]) }}" class="btn btn-primary m-auto">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- Add button-->
                                <a href="" class="btn btn-success fw-bold" data-toggle="modal" data-target="#myModal">
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
                @if($invoices->previousPageUrl())
                    <!--Left scroll-->
                    <a href="{{$invoices->previousPageUrl()}}" class="px-5"><img src="{{asset('img/arrow_l.png') }}"
                                                                                 alt=""></a>
                @endif
                @if($invoices->nextPageUrl())
                    <!--Right scroll-->
                    <a href="{{$invoices->nextPageUrl()}}" class="px-5"><img src="{{asset('img/arrow_p.png') }}" alt=""></a>
                @endif
            </div>
        </div>
    </div>
    <!--Panels pop-up-->
    <!-- Add pop-up panel -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    @if(isset($invoice->invoice_number))
                        <h5 class="modal-title">Edycja faktury nr {{$invoice->invoice_number}}</h5>
                    @else
                        <h5 class="modal-title">Edycja faktury</h5>
                    @endif
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <label for="quantityToAdd">Dodaj:</label>
                    <input type="number" min="0" id="quantityToAdd" name="quantityToAdd" class="form-control"
                           value="0">
                    <small id="quantityHelp" class="form-text text-muted">Podaj liczbę sztuk które chcesz dodać.</small>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" form="addQuantityForm" class="btn btn-success">Dodaj</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Zamknij</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete pop-up panel -->
    <div class="modal fade" id="delete_model">
        <div class="modal-dialog modal-dialog-centered">">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">
                        @if(isset($invoice->invoice_number))
                            Edycja faktury nr {{ $invoice->invoice_number }}
                        @else
                            Edycja faktury
                        @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <label for="quantityToRemove">Liczba do usunięcia:</label>
                    <input type="number" min="0" id="quantityToRemove" name="quantityToRemove" class="form-control"
                           value="{{ $invoice->quantity}}">
                    <small id="quantityHelp" class="form-text text-muted">Podaj liczbę sztuk które chcesz usunąć.</small>

                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="deleteButton" data-invoice-id="{{ $invoice->id }}">
                        Usuń
                    </button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Zamknij</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Move pop-up panel -->
    <div class="modal fade" id="move_model">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    @if(isset($invoice->invoice_number))
                        <h5 class="modal-title">Edycja faktury nr {{$invoice->invoice_number}}</h5>
                    @else
                        <h5 class="modal-title">Edycja faktury</h5>
                    @endif
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="moveInvoiceForm">
                        <div class="form-group">
                            <label for="quantity">Podaj ilość sztuk, które chcesz przenieść:</label>
                            <input type="number" min="0" name="quantity" id="quantity" class="form-control" value="{{$invoice->quantity}}">
                        </div>
                        <div class="form-group">
                            <label for="newPlace">Podaj nowe miejsce:</label>
                            <input type="text" name="newPlace" id="newPlace" class="form-control" value="{{$invoice->place}}">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="moveInvoiceForm" class="btn btn-success">Przenieś</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                </div>
            </div>
        </div>
    </div>


    <!--Script links -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
