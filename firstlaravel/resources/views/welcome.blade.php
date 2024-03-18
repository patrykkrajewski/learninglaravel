@extends('layouts.app')
@section('content')
    <div class="text-center">
        <h1>Dodaj fakture</h1>
        <form action="{{route('invoices.store')}}" method="POST">
            {{csrf_field()}}
            <div class="form-group">
                <label for="inputInvoiceNumber">Numer faktury</label>
                <input type="text" class="form-control @error('invoice_number') is-invalid @enderror"
                       id="inputInvoiceNumber"
                       placeholder="Numer faktury" name="invoice_number">
                <div class="invalid-feedback">
                    @error('vat_rate' )
                    {{$message}}
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="inputProductName">Nazwa prduktu</label>
                <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                       id="inputProductName"
                       placeholder="Nazwa produktu" name="product_name">
                <div class="invalid-feedback">
                    @error('vat_rate' )
                    {{$message}}
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="inputInvoiceDate">Data wystawienia</label>
                <input type="date" class="form-control @error('invoice_date') is-invalid @enderror"
                       id="inputInvoiceDate"
                       placeholder="Data wystawienia" name="invoice_date">
                <div class="invalid-feedback">
                    @error('vat_rate' )
                    {{$message}}
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="inputQuantity">Ilość</label>
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
                    <label for="inputPrice">Cena</label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" id="inputPrice"
                           name="price">
                    <div class="invalid-feedback">
                        @error('vat_rate' )
                        {{$message}}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputVateRate">Podatek VAT</label>
                    <input type="text" class="form-control @error('vat_rate') is-invalid @enderror" id="inputVateRate"
                           name="vat_rate">
                    <div class="invalid-feedback">
                        @error('vat_rate' )
                        {{$message}}
                        @enderror
                    </div>
                </div>
                <div class="form-group col-md-4 container text-center ">
                    <label for="inputPlace">Miejsce</label>
                    <select id="inputPlace" class="form-control" name="place">
                        <option value='Wydawnictwo'>Wydawnictwo</option>
                        <option value='Sklepik'>Sklepik</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Dodaj</button>
        </form>
    </div>
@endsection
