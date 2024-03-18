@extends('layouts.app')

@section('content')

    <h1>Edytujesz Fakture nr {{$invoice->invoice_number}}</h1>
    <form action="{{route('invoices.update',['id'=>$invoice->id])}}" method="POST">
        {{csrf_field()}}
        @method('PUT')
        <div class="form-group">
            <label for="inputInvoiceNumber">Numer faktury</label>
            <input value="{{$invoice->invoice_number}}" type="text"
                   class="form-control @error('invoice_number') is-invalid @enderror" id="inputInvoiceNumber"
                   placeholder="Invoice number" name="invoice_number">
            <div class="invalid-feedback">
                @error('vat_rate' )
                {{$message}}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="inputProductName">Nazwa produktu</label>
            <input value="{{$invoice->product_name}}" type="text"
                   class="form-control @error('product_name') is-invalid @enderror" id="inputProductName"
                   placeholder="Product name" name="product_name">
            <div class="invalid-feedback">
                @error('vat_rate' )
                {{$message}}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="inputInvoiceDate">Data wystawienia faktury</label>
            <input value="{{$invoice->invoice_date}}" type="date"
                   class="form-control @error('invoice_date') is-invalid @enderror" id="inputInvoiceDate"
                   name="invoice_date">
            <div class="invalid-feedback">
                @error('vat_rate' )
                {{$message}}
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="inputQuantity">Ilość</label>
            <input value="{{$invoice->quantity}}" type="number"
                   class="form-control @error('quantity') is-invalid @enderror" placeholder="0"
                   name="quantity">
            <div class="invalid-feedback">
                @error('vat_rate' )
                {{$message}}
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="inputPrice">Cena</label>
                <input value="{{$invoice->price}}" type="text" class="form-control @error('price') is-invalid @enderror"
                       id="inputPrice" name="price">
                <div class="invalid-feedback">
                    @error('vat_rate' )
                    {{$message}}
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="inputVateRate">Podatek Vat</label>
                <input value="{{$invoice->vat_rate}}" type="text"
                       class="form-control @error('vat_rate') is-invalid @enderror" id="inputVateRate"
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

        <button type="submit" class="btn btn-primary">Zapisz</button>
    </form>
@endsection
