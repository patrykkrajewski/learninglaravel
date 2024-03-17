
@extends('layouts.app')

@section('content')
<div class="row">
    <h1 class="strong">Invoice List</h1>
</div>
<div class="row">
    <nav class="navbar navbar-light bg-light">
        <div class="d-flex justify-content-center w-75">
            <form method="GET" action="{{ route('invoices.search') }}">
                <input name="search" class="form-control mr-sm-2 w-100" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
</div>
<div class="row"></div>

<div class="row">
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
<div class="row"><button type="submit" class="">Move</button></div>
<div class="row">
    <button type="submit" class="">L</button>
    <button type="submit" class="">P</button>
</div>







    <!--  <button type="submit" class="btn-primary btn-lg">Create invoice</button> -->



{{--{{$invoices -> links()}}--}}

@endsection
