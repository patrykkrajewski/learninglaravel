@extends('layouts.app')

@section('content')
    <div class="row">
        <h1 class="strong d-flex justify-content-center mt-4">Lista Faktur</h1>
    </div>
    <div class="d-flex justify-content-center">
        <nav class="navbar navbar-light bg-light">
            <form method="GET" action="{{ route('invoices.search') }}" class="form-inline d-flex">
                <input name="search" class="form-control w-4" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </nav>
    </div>


    <div class="row justify-content-center">
        <div class="col-8">
            <table class="table table-bordered text-white text-center" style="background-color: #1E2F47;">
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
                        <td>{{$invoice->quantity}}</td>
                        <td>{{$invoice->price}}</td>
                        <td>{{$invoice->vat_rate}}</td>
                        <td>{{$invoice->place}}</td>
                        <td class="col">
                            <a href="{{route('invoices.edit',['id'=>$invoice->id])}}"
                               class="btn btn-primary">Edytuj</a>
                            <a href="{{route('invoices.destroy',['id'=>$invoice->id])}}"
                               class="btn btn-danger">Usuń</a>
                           <!-- <form method="POST" action="{{route('invoices.move',['id'=>$invoice->id])}}">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-secondary">Przenieś</button>
                            </form> -->
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <div class="row justify-content-center"><a href="{{route('invoices.create')}}" class="btn btn-success col-md-3 mb-4">Dodaj fakture</a></div>
    <div class="row">
        <button type="submit" class="col border-0"><img src="arrow_l.png" alt=""></button>
        <button type="submit" class="col border-0"><img src="arrow_p.png" alt=""></button>
    </div>










    {{--{{$invoices -> links()}}--}}

@endsection
