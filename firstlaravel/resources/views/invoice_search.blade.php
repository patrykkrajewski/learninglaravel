@extends('layouts.app')
@section('content')
    <div class="row">
        <h1 class="strong d-flex justify-content-center mt-4">Lista Faktur</h1>
    </div>
    <div class="d-flex justify-content-center">
        <nav class="navbar navbar-light bg-light ">
            <form method="GET" action="{{ route('invoices.search') }}" class="form-inline">
                <input name="search" class="form-control" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </nav>
    </div>


    <div class="row justify-content-center">
        <div class="col-10">
            <table class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Numer faktury</th>
                    <th scope="col">Nazwa produktu</th>
                    <th scope="col">Data wystawienia faktury</th>
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
                        <td>{{ $result->invoice_date }}</td>
                        <td>{{ $result->quantity }}</td>
                        <td>{{ $result->price }}</td>
                        <td>{{ $result->vat_rate }}</td>
                        <td>{{ $result->place }}</td>
                        <td>
                            <a href="{{route('invoices.edit',['id'=>$result->id])}}"
                               class="btn btn-primary">Edytuj</a>
                            <a href="{{route('invoices.destroy',['id'=>$result->id])}}"
                               class="btn btn-danger">Usuń</a>
                            <form method="POST" action="{{route('invoices.move',['id'=>$result->id])}}">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-secondary">Przenieś</button>
                            </form>
                        </td>

                    </tr>

                @endforeach

                </tbody>
            </table>
@endsection
