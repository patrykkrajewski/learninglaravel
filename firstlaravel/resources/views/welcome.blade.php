@extends('layouts.app')
@section('content')
<h1>Invoice Manager</h1>
<form action="{{route('invoices.store')}}" method="POST">
    {{csrf_field()}}
    <div class="form-group">
        <label for="inputInvoiceNumber">Invoice number</label>
        <input type="text" class="form-control @error('invoice_number') is-invalid @enderror" id="inputInvoiceNumber"
               placeholder="Invoice number" name="invoice_number">
        <div class="invalid-feedback">
            @error('vat_rate' )
            {{$message}}
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label for="inputProductName">Product name</label>
        <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="inputProductName"
               placeholder="Product name" name="product_name">
        <div class="invalid-feedback">
            @error('vat_rate' )
            {{$message}}
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label for="inputInvoiceDate">Invoice date</label>
        <input type="date" class="form-control @error('invoice_date') is-invalid @enderror" id="inputInvoiceDate"
               placeholder="Invoice date" name="invoice_date">
        <div class="invalid-feedback">
            @error('vat_rate' )
            {{$message}}
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label for="inputQuantity">Quantity</label>
        <input type="number" class="form-control @error('quantity') is-invalid @enderror" placeholder="0"
               name="quantity">
        <div class="invalid-feedback">
            @error('vat_rate' )
            {{$message}}
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="inputPrice">Price</label>
            <input type="text" class="form-control @error('price') is-invalid @enderror" id="inputPrice" name="price">
            <div class="invalid-feedback">
                @error('vat_rate' )
                {{$message}}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="inputVateRate">Vat rate</label>
            <input type="text" class="form-control @error('vat_rate') is-invalid @enderror" id="inputVateRate"
                   name="vat_rate">
            <div class="invalid-feedback">
                @error('vat_rate' )
                {{$message}}
                @enderror
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="inputPlace">Place</label>
            <select id="inputPlace" class="form-control" name="place">
                <option value='Wydawnictwo'>Wydawnictwo</option>
                <option value='Sklepik'>Sklepik</option>
            </select>

        </div>
    </div>
    <br>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
