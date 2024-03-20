@extends('layouts.app')
@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <h1 class="text-center">Dodaj Fakturę</h1>

            <div class="card " style="color: white">
                <div class="card-body rounded" style="background-color: #111E2B;">

                    <form action="{{route('invoices.store')}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group p-14 mb-3">
                            <label for="inputInvoiceNumber">Numer faktury</label>
                            <input type="text" class="form-control @error('invoice_number') is-invalid @enderror"
                                   id="inputInvoiceNumber"
                                   placeholder="Numer faktury" name="invoice_number">
                            <div class="invalid-feedback">
                                @error('invoice_number' )
                                {{$message}}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group p-14 mb-3">
                            <label for="inputProductName">Nazwa prduktu</label>
                            <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                                   id="inputProductName"
                                   placeholder="Nazwa produktu" name="product_name">
                            <div class="invalid-feedback">
                                @error('product_name' )
                                {{$message}}
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group p-14 mb-3 col-6">
                                <label for="inputInvoiceDate">Data wystawienia</label>
                                <input type="date" class="form-control @error('invoice_date') is-invalid @enderror"
                                       id="inputInvoiceDate"
                                       placeholder="Data wystawienia" name="invoice_date">
                                <div class="invalid-feedback">
                                    @error('invoice_date' )
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group p-14 mb-3 col-6">
                                <label for="inputQuantity">Ilość</label>
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                       placeholder="0"
                                       name="quantity">
                                <div class="invalid-feedback">
                                    @error('quantity' )
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-row col-6">
                                <div class="form-group p-14 mb-3">
                                    <label for="inputPrice">Cena</label>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror"
                                           id="inputPrice"
                                           name="price" placeholder="0">
                                    <div class="invalid-feedback">
                                        @error('price' )
                                        {{$message}}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="inputVateRate">Podatek VAT</label>
                                    <input type="text" class="form-control @error('vat_rate') is-invalid @enderror"
                                           id="inputVateRate"
                                           name="vat_rate" value=23>
                                    <div class="invalid-feedback">
                                        @error('vat_rate' )
                                        {{$message}}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-6 mb-3">
                                <label for="inputPlace">Miejsce</label>
                                <select id="inputPlace" class="form-control" name="place">
                                    <option value='Wydawnictwo'>Wydawnictwo</option>
                                    <option value='Sklepik'>Sklepik</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-center"> <!-- Dodaj klasę text-center -->
                            <button type="submit" class="btn btn-primary col-3">Dodaj</button> <!-- Usuń klasę mx-auto -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
