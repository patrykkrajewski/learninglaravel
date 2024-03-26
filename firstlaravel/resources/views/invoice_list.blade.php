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
                    @forelse($invoices as $invoice)
                        <!--Table content writing-->
                        <tr>
                            <td>{{$invoice->invoice_number}}</td>
                            <td>{{$invoice->product_name}}</td>
                            <td>{{$invoice->invoice_date->format('Y-m-d')}}</td>
                            <td>{{$invoice->invoice_quantity}}szt.</td>
                            <td>{{$invoice->quantity}}szt.</td>
                            <td>{{$invoice->price}}zł</td>
                            <td>{{ intval($invoice->vat_rate) }}%</td>
                            <td>
                                <!-- Move button-->
                                <div class="d-flex justify-content-start text-center">
                                    <a href=""
                                       class="btn btn-secondary " data-toggle="modal"
                                       data-target="#move-modal-{{$invoice->id}}">
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                    <span class="px-3">{{$invoice->place}}</span>
                                </div>

                            </td>
                            <td class="col d-flex justify-content-start">
                                <!-- Delete button-->
                                <a href=""
                                   class="btn btn-danger fw-bold" data-toggle="modal"
                                   data-target="#delete-modal-{{$invoice->id}}">
                                    <i class="fas fa-minus"></i>
                                </a>
                                <!-- Edit button-->
                                <a href="{{ route('invoices.edit',['id'=>$invoice->id]) }}"
                                   class="btn btn-primary m-auto">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- Add button-->
                                <a href="" class="btn btn-success fw-bold" data-toggle="modal"
                                   data-target="#add-modal-{{$invoice->id}}">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Brak faktur do wyświetlenia.</td>
                        </tr>
                    @endforelse
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

    <!-- Modals -->
    @foreach($invoices as $invoice)
        @include('modals.move_invoice_modal', ['id' => $invoice -> id])
        @include('modals.add_invoice_modal', ['id' => $invoice -> id])
        @include('modals.delete_invoice_modal', ['id' => $invoice -> id])
    @endforeach

    <!--Script links -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection

