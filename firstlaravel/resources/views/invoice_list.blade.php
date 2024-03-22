@extends('layouts.app')

@section('content')

    <div style="margin-bottom: 10vh">
        <div class="row ">
            <h1 class="strong d-flex justify-content-center mt-4">Lista Faktur</h1>
        </div>
        <div class="d-flex justify-content-center mb-4">
            <nav class="navbar navbar-light bg-light">
                <form method="GET" action="{{ route('invoices.search') }}" class="form-inline d-flex">
                    <input name="search" class="form-control w-5" type="search" placeholder="Nazwa/Numer"
                           aria-label="Search">
                    <input name="start_date" class="form-control w-3" type="date" placeholder="Start Date"
                           aria-label="Start Date">
                    <input name="end_date" class="form-control w-3" type="date" placeholder="End Date"
                           aria-label="End Date">
                    <button class="btn btn-outline-success" type="submit">Wyszukaj</button>
                </form>
            </nav>
        </div>

        <div class="row justify-content-center">
            <div class="col-8">
                <table class="table table-bordered text-white text-center " style="background-color: #1E2F47;">
                    <thead class="thead-dark">
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
                    <tbody>
                    @foreach($invoices as $invoice)
                        <tr>
                            <td>{{$invoice->invoice_number}}</td>
                            <td>{{$invoice->product_name}}</td>
                            <td>{{$invoice->invoice_date->format('Y-m-d')}}</td>
                            <td>{{$invoice->quantity}}szt.</td>
                            <td>{{$invoice->price}}zł</td>
                            <td>{{ intval($invoice->vat_rate) }}%</td>
                            <td>
                                <div class="d-flex justify-content-start text-center">
                                    <form method="POST" action="{{ route('invoices.move',['id'=>$invoice->id]) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-secondary">
                                            <i class="fas fa-arrow-right"></i> <!-- Emotikona dla przeniesienia -->
                                        </button>
                                    </form>
                                    <div class="align-items-center">
                                        <span class="px-3">{{$invoice->place}}</span>
                                    </div>
                                </div>
                            </td>



                            <td class="col">
                                <a href="{{ route('invoices.destroy',['id'=>$invoice->id]) }}"
                                   class="btn btn-danger fw-bold" data-toggle="modal" data-target="#delete_model">
                                    <i class="fas fa-minus"></i> <!-- Emotikona dla usuwania -->
                                </a>
                                <a href="{{ route('invoices.edit',['id'=>$invoice->id]) }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> <!-- Emotikona dla edycji -->
                                </a>
                                <a href="" class="btn btn-success fw-bold" data-toggle="modal" data-target="#myModal">
                                    <i class="fas fa-plus"></i> <!-- Emotikona dla dodawania -->
                                </a>


                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-8 d-flex justify-content-center">
                @if($invoices->previousPageUrl())
                    <a href="{{$invoices->previousPageUrl()}}" class="px-5"><img src="{{asset('img/arrow_l.png') }}"
                                                                                 alt=""></a>
                @endif

                @if($invoices->nextPageUrl())
                    <a href="{{$invoices->nextPageUrl()}}" class="px-5"><img src="{{asset('img/arrow_p.png') }}" alt=""></a>
                @endif
            </div>
        </div>


    </div>
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
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
                    <lab>Dodaj </lab>
                    <input type="number" min="0" name="" id="">
                    <lab> szt.</lab>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" form="addQuantityForm" class="btn btn-success">Dodaj</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Zamknij</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete_model">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    @if(isset($invoice->invoice_number))
                        <h5 class="modal-title">Edycja faktury nr {{$invoice->invoice_number}}</h5>
                    @else
                        <h5 class="modal-title">Edycja faktury nr {{$invoice->invoice_number}}</h5>
                    @endif
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <lab>Usuń </lab>
                    <input type="number" min="0" name="" id="">
                    <lab> szt.</lab>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" form="addQuantityForm" class="btn btn-danger">Usuń</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Zamknij</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
