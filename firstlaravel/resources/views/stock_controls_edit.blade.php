@extends('layouts.app')

@section('content')
    <!-- Edit panel -->
    <div class="row justify-content-center mt-3 mb-3">
        <!-- Edit panel frame -->
        <div class="col-md-5">
            <!-- Title -->
            <h1 class="text-center">Edytujesz Fakturę nr {{ $stockControl->invoice->invoice_number }}</h1>
            <!-- Add card style -->
            <div class="card" style="color: white">
                <div class="card-body rounded" style="background-color: #111E2B;">
                    <!-- Edit form -->
                    <form action="{{ route('stock-controls.edit', ['id' => $stockControl->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Edit title -->
                        <div class="form-group mb-3">
                            <label for="inputTitle">Operacja</label>
                            <input value="{{ $stockControl->title }}" type="text"
                                   class="form-control @error('title') is-invalid @enderror"
                                   id="inputTitle" placeholder="Title" name="title">
                            <div class="invalid-feedback">
                                @error('title')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <!-- Edit invoice_id -->
                        <div class="form-group mb-3">
                            <label for="inputInvoiceId">Numer faktury</label>
                            <input value="{{ $stockControl->invoice_id }}" type="text"
                                   class="form-control @error('invoice_id') is-invalid @enderror"
                                   id="inputInvoiceId" placeholder="Invoice ID" name="invoice_id">
                            <div class="invalid-feedback">
                                @error('invoice_id')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <!-- Edit product_name -->
                        <div class="form-group mb-3">
                            <label for="inputProductName">Nazwa produktu</label>
                            <input value="{{ $stockControl->invoice->product_name }}" type="text"
                                   class="form-control @error('product_name') is-invalid @enderror"
                                   id="inputProductName" placeholder="Product name" name="product_name">
                            <div class="invalid-feedback">
                                @error('product_name')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <!-- Edit quantity -->
                        <div class="form-group mb-3">
                            <label for="inputQuantity">Ilość</label>
                            <input value="{{ $stockControl->quantity }}" type="number"
                                   class="form-control @error('quantity') is-invalid @enderror"
                                   id="inputQuantity" placeholder="Quantity" name="quantity">
                            <div class="invalid-feedback">
                                @error('quantity')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>


                        <!-- Edit button -->
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary col-md-3 mt-3 mb-3">Zapisz</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
