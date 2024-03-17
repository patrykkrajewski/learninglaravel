
@extends('layouts.app')

@section('content')
    <style>
        body {
            font-family: 'figtree', sans-serif;
            background-color: #f9fafb;
            color: #1f2937;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 3rem;
            margin-bottom: 0px;
            height: 5vh;
            margin-left: 33%;
        }
        table {
            border-collapse: collapse;
            margin: auto;
            width: 80%;
            border: 0.4vw solid #111E2B; /* Dodaj obramowanie */
            margin-top: -40vh;
            margin-left: 10vw;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1vh solid #111E2B; /* Zmień kolor linii */
        }
        th {
            background-color: #111E2B;
            color: #ffffff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .container{
            margin-left: 25%;
            margin-top: -13%;
            padding: 0;
        }
        .btn-success{
            float: left;
            margin-right: 0.1vw;
        }
        .btn-danger{
            float: left;


        }
        .btn-secondary{
            clear: both;
            margin-left: 0.1vw;
        }
        .btn-lg{
            height: 5vh;
            width: 8vw;
            font-size: 0.8vw;
            background-color: #111E2B;
        }


    </style>

<h1 class="strong">Invoice List</h1>

<div class="container">
    <nav class="navbar navbar-light bg-light">
        <div class="d-flex justify-content-center w-75">
            <input class="form-control mr-sm-2 w-100" type="search" placeholder="Search" aria-label="Search"> <!-- Ustawienie 100% szerokości -->
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </div>
    </nav>
</div>
    <table>
        <thead>
        <tr>
            <th scope="col">Invoice Number</th>
            <th scope="col">Product Name</th>
            <th scope="col">Invoice Date</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">VAT Rate</th>
            <th scope="col">Place</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoices as $invoice)
            <tr>

                <td>{{$invoice -> invoice_number}}</td>
                <td>{{$invoice -> product_name}}</td>
                <td>{{$invoice -> invoice_date}}</td>
                <td>{{$invoice -> quantity}}</td>
                <td>{{$invoice -> price}}</td>
                <td>{{$invoice -> vat_rate}}</td>
                <td>{{$invoice -> place}}</td>
                <td>
                    <a  href="{{route('invoices.edit',['id'=>$invoice->id])}}" class="btn btn-success">Edit</a>
                    <a href="{{route('invoices.destroy',['id'=>$invoice->id])}}" class="btn btn-danger">Delate</a>
                    <form  method="POST" action="{{route('invoices.move',['id'=>$invoice->id])}}">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-secondary">Move </button>

                    </form>

                </td>
            </tr>
        @endforeach
        </tbody>

    </table>

      <!--  <button type="submit" class="btn-primary btn-lg">Create invoice</button> -->



{{--{{$invoices -> links()}}--}}

@endsection
