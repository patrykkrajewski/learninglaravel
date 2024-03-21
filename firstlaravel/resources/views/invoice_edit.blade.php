@extends('layouts.app')

@section('content')
    <div class="row justify-content-center mt-3 mb-3">
        <div class="col-md-5">
            <h1 class="text-center">Edytujesz Fakture nr {{ $invoice->invoice_number }}</h1>
            <div class="card " style="color: white">
                <div class="card-body rounded mb-3" style="background-color: #111E2B;">

                    <form action="{{ route('invoices.update', ['id' => $invoice->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="inputInvoiceNumber">Numer faktury</label>
                            <input value="{{ $invoice->invoice_number }}" type="text"
                                   class="form-control @error('invoice_number') is-invalid @enderror"
                                   id="inputInvoiceNumber" placeholder="Invoice number" name="invoice_number">
                            <div class="invalid-feedback">
                                @error('invoice_number')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="inputProductName">Nazwa produktu</label>
                            <input value="{{ $invoice->product_name }}" type="text"
                                   class="form-control @error('product_name') is-invalid @enderror"
                                   id="inputProductName" placeholder="Product name" name="product_name">
                            <div class="invalid-feedback">
                                @error('product_name')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group p-14 mb-3 col-6">
                                <label for="inputInvoiceDate">Data wystawienia faktury</label>
                                <input value="{{ $invoice->invoice_date }}" type="date"
                                       class="form-control @error('invoice_date') is-invalid @enderror"
                                       id="inputInvoiceDate" name="invoice_date">
                                <div class="invalid-feedback">
                                    @error('invoice_date')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group p-14 mb-3 col-6">
                                <label for="inputQuantity">Ilość</label>
                                <input value="{{ $invoice->quantity }}" type="number"
                                       class="form-control @error('quantity') is-invalid @enderror" placeholder="0"
                                       name="quantity">
                                <div class="invalid-feedback">
                                    @error('quantity')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group p-14 mb-3 col-6">
                                <label for="inputPrice">Cena</label>
                                <input value="{{ $invoice->price }}" type="text"
                                       class="form-control @error('price') is-invalid @enderror" id="inputPrice"
                                       name="price">
                                <div class="invalid-feedback">
                                    @error('price')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group p-14 mb-3 col-6">
                                <label for="inputPlace">Miejscee</label>
                                <select id="inputPlace" class="form-control" name="place">
                                    <option
                                        value="Wydawnictwo" {{ $invoice->place == 'Wydawnictwo' ? 'selected' : '' }}>
                                        Wydawnictwo
                                    </option>
                                    <option value="Sklepik" {{ $invoice->place == 'Sklepik' ? 'selected' : '' }}>
                                        Sklepik
                                    </option>
                                </select>
                            </div>

                        </div>
                        <div class="form-group p-14 mb-3 col-6">
                            <label for="inputVateRate">Podatek Vat</label>
                            <input value="{{ $invoice->vat_rate }}" type="text"
                                   class="form-control @error('vat_rate') is-invalid @enderror"
                                   id="inputVateRate"
                                   name="vat_rate"
                            >
                            <div class="invalid-feedback">
                                @error('vat_rate')
                                {{ $message }}
                                @enderror

                            </div>

                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary col-md-3 mt-3 mb-3">Zapisz</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
