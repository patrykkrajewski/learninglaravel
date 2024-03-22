@extends('layouts.app')
@section('content')
    <!--Add panel-->
    <div class="row justify-content-center mt-3 mb-3">
        <!--Add panel frame-->
        <div class="col-md-5">
            <!--Title-->
            <h1 class="text-center">Dodaj Fakture</h1>
            <!--Add card style-->
            <div class="card " style="color: white">
                <div class="card-body rounded" style="background-color: #111E2B;">
                    <!--Add form-->
                    <form action="{{route('invoices.store')}}" method="POST">
                        {{csrf_field()}}
                        <!--Add invoice_number-->
                        <div class="form-group p-10">
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
                        <!--Add product_name-->
                        <div class="form-group p-14 mb-3 mt-3">
                            <label for="inputProductName">Nazwa produktu</label>
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
                            <!--Add invoice_date-->
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
                            <!--Add quantity-->
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
                            <!--Add price-->
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
                                <!--Add vat_rate-->
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
                            <!--Add place-->
                            <div class="form-group col-6 mb-3">
                                <label for="inputPlace">Miejsce</label>
                                <select id="inputPlace" class="form-control" name="place">
                                    <option value='Wydawnictwo'>Wydawnictwo</option>
                                    <option value='Sklepik'>Sklepik</option>
                                </select>
                            </div>
                        </div>
                        <!--Add button-->
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary col-md-3 mt-3 ">Dodaj</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
