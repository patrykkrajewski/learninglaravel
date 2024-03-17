
@extends('layouts.app')

@section('content')
    <style>

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

        .invoices_table{
            width: 100vw;
            height: 80vh;
        }
        .create_btn{
            width: 100vw;
            height: 5vh;
        }
        .scroll{
            width: 100vw;
            height: 5vh;
        }
        body {
            font-family: 'figtree', sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
        }
        .title {
            display: flex;
        }
        .logo_img{
            width: 20vw;
            height: 20vh;
        }
        .strong{
            text-align: center;
            color: #1f2937;
            margin-left: 25vw;
            margin-top: 5vh;
        }

        .search{
            width: 100vw;
            height: 5vh;
            margin: 0px;
        }


    </style>
    <div class="title">
        <img src="{{ asset('logo.svg') }}" alt="logo" class="logo_img">
        <h1 class="strong">Invoice List</h1>

    </div>
    <div class="search">
        <nav class="navbar navbar-light bg-light">
            <div class="d-flex justify-content-center w-75">
                <form method="GET" action="{{ route('invoices.search') }}">
                    <input name="search" class="form-control mr-sm-2 w-100" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
    </div>
    <!--

    <div class="invoices_table">
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
                    <a  href="{{route('invoices.destroy',['id'=>$invoice->id])}}" class="btn btn-danger">Delate</a>
                    <form  method="POST" action="{{route('invoices.move',['id'=>$invoice->id])}}">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-secondary">Move</button>

                    </form>

                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
    </div>
    <div class="create_btn">
        <button type="submit" class="">Move</button>

    </div>
    <div class="scroll"></div>

-->
    <!--  <button type="submit" class="btn-primary btn-lg">Create invoice</button> -->



{{--{{$invoices -> links()}}--}}

@endsection
