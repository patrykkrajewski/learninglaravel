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
        @include('components.alert')
        <!--Table style-->
        <div class=" justify-content-center w-75 container">

                <!--Table-->
                <table class="table  text-white text-center rounded" style="background-color: #1E2F47;">
                    <!--Table head style-->
                    <thead class="thead-dark">
                    <!--Table head writing-->
                    <tr style="background-color: #111E2B;" class="text-white">
                        <th scope="col">
                            <a href="{{ route('invoices.search', ['sortBy' => 'invoice_number', 'sortDirection' => ($sortBy== 'invoice_number' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" class="text-decoration-none text-reset">
                                Numer @include('components.sort-icon', ['sortBy' => $sortBy ?? null, 'sortDirection' => $sortDirection ?? null, 'col' => 'invoice_number' ])
                            </a>
                        </th>
                        <th scope="col">
                            <a href="{{ route('invoices.search', ['sortBy' => 'product_name', 'sortDirection' => ($sortBy== 'product_name' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" class="text-decoration-none text-reset">
                                Nazwa produktu @include('components.sort-icon', ['sortBy' => $sortBy ?? null, 'sortDirection' => $sortDirection ?? null, 'col' => 'product_name' ])
                            </a>
                        </th>
                        <th scope="col"><a href="{{ route('invoices.search', ['sortBy' => 'invoice_date', 'sortDirection' => ($sortBy== 'invoice_date' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" class="text-decoration-none text-reset">
                                Data wystawienia @include('components.sort-icon', ['sortBy' => $sortBy ?? null, 'sortDirection' => $sortDirection ?? null, 'col' => 'invoice_date' ])
                            </a>
                        </th>
                        <th scope="col">
                            <a href="{{ route('invoices.search', ['sortBy' => 'invoice_quantity', 'sortDirection' => ($sortBy== 'invoice_quantity' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" class="text-decoration-none text-reset">
                                Ilość na fakturze @include('components.sort-icon', ['sortBy' => $sortBy ?? null, 'sortDirection' => $sortDirection ?? null, 'col' => 'invoice_quantity' ])
                            </a>
                        </th>
                        <th scope="col">
                            <a href="{{ route('invoices.search', ['sortBy' => 'quantity', 'sortDirection' => ($sortBy== 'quantity' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" class="text-decoration-none text-reset">
                                Ilość aktualna @include('components.sort-icon', ['sortBy' => $sortBy ?? null, 'sortDirection' => $sortDirection ?? null, 'col' => 'quantity' ])
                            </a>
                        </th>
                        <th scope="col">
                            <a href="{{ route('invoices.search', ['sortBy' => 'price', 'sortDirection' => ($sortBy== 'price' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" class="text-decoration-none text-reset">
                                Cena [Netto] @include('components.sort-icon', ['sortBy' => $sortBy ?? null, 'sortDirection' => $sortDirection ?? null, 'col' => 'price' ])
                            </a>
                        </th>
                        <th scope="col">Suma</th>
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
                            <td>{{ $result->invoice_quantity }}szt.</td>
                            <td>{{ $result->quantity }}szt.</td>
                            <td>{{ $result->price }}zł</td>
                            <td>{{$result->price * $result->quantity}} zł</td>
                            <td>{{ intval($result->vat_rate) }}%</td>
                            <td>
                                <!-- Move button-->
                                <div class="d-flex justify-content-start text-center">
                                    <a href=""
                                       class="btn btn-secondary border" data-toggle="modal"
                                       data-target="#move-modal-{{$result->id}}">
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                    <span class="px-3">{{$result->place}}</span>
                                </div>

                            </td>
                            <td class="col justify-content-start">
                                <!-- Delete button-->
                                <a href=""
                                   class="btn btn-danger fw-bold" data-toggle="modal"
                                   data-target="#delete-modal-{{$result->id}}">
                                    <i class="fas fa-minus"></i>
                                </a>
                                <!-- Edit button-->
                                <a href=" " data-toggle="modal"
                                   data-target="#edit-modal-{{$result->id}}"
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
            <!--Scrolling tables-->
            <div class="col-12 d-flex justify-content-center">
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
        <!-- Modals -->
    @foreach($results as $invoice)
        @include('modals.move_invoice_modal', ['id' => $invoice -> id, 'search' => 1])
        @include('modals.add_invoice_modal', ['id' => $invoice -> id, 'search' => 1])
        @include('modals.delete_invoice_modal', ['id' => $invoice -> id, 'search' => 1])
        @include('modals.edit_invoive_modal', ['id' => $invoice -> id, 'search' => 1])
    @endforeach
        <!--Script links -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
