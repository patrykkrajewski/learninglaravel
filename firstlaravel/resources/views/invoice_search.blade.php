@extends('layouts.app')
@section('content')
    <div style="margin-bottom: 10vh">
    <div class="row">
        <h1 class="strong d-flex justify-content-center mt-4">Lista Faktur</h1>
    </div>
    <div class="d-flex justify-content-center mb-4">
        <nav class="navbar navbar-light bg-light">
            <form method="GET" action="{{ route('invoices.search') }}" class="form-inline d-flex">
                <input name="search"  class="form-control w-5" type="search" placeholder="Nazwa/Numer" aria-label="Search">
                <input name="start_date" class="form-control w-3" type="date" placeholder="Start Date" aria-label="Start Date">
                <input name="end_date" class="form-control w-3" type="date" placeholder="End Date" aria-label="End Date">
                <button class="btn btn-outline-success" type="submit">Wyszukaj</button>
            </form>
        </nav>
    </div>


    <div class="row justify-content-center">
        <div class="col-8">
            <table class="table table-bordered text-white text-center" style="background-color: #1E2F47;">
                <thead class="thead-dark">
                <tr style="background-color: #111E2B;" class="text-white">
                    <th scope="col">Numer</th>
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
                @foreach ($results as $result)
                    <tr>
                        <td>{{ $result->invoice_number }}</td>
                        <td>{{ $result->product_name }}</td>
                        <td>{{ $result->invoice_date->format('Y-m-d')}}</td>
                        <td>{{ $result->quantity }}</td>
                        <td>{{ $result->price }}</td>
                        <td>{{ $result->vat_rate }}</td>
                        <td>{{ $result->place }}</td>
                        <td>
                            <a href="{{route('invoices.edit',['id'=>$result->id])}}"
                               class="btn btn-primary">Edytuj</a>
                            <a href="{{route('invoices.destroy',['id'=>$result->id])}}"
                               class="btn btn-danger">Usuń</a>
                            <!--    <form method="POST" action="{{route('invoices.move',['id'=>$result->id])}}">
                                @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-secondary">Przenieś</button>
                        </form>
-->
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <div class="col-8 d-flex justify-content-center">
            @if($results->previousPageUrl())
                <a href="{{$results->previousPageUrl()}}" class="px-5"><img src="{{asset('arrow_l.png') }}" alt=""></a>
            @endif

            @if($results->nextPageUrl())
                <a href="{{$results->nextPageUrl()}}" class="px-5"><img src="{{asset('arrow_p.png') }}" alt=""></a>
            @endif
        </div>
@endsection
