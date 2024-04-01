@extends('layouts.app')

@section('content')
    <!--Edit panel-->
    <div class="row justify-content-center mt-3 mb-3">
        <!--Edit panel frame-->
        <div class="col-md-5">
            <!--Title-->
            <h1 class="text-center">Edytujesz Fakture nr {{ $stock->invoice_id }}</h1>
            <!--Add card style-->
            <div class="card " style="color: white">
                <div class="card-body rounded " style="background-color: #111E2B;">
                    <!--Edit form-->
                    <form action="{{ route('stock_controls.update', ['id' => $stock->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Edit invoice_number -->
                        <div class="form-group mb-3">
                            <label for="inputInvoiceNumber">Nazwa operacji</label>
                            <input value="{{ $stock->title }}" type="text"
                                   class="form-control @error('invoice_number') is-invalid @enderror"
                                   id="inputInvoiceNumber" name="invoice_number">
                            <div class="invalid-feedback">
                                @error('invoice_number')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <!-- Edit invoice_number -->
                        <div class="form-group mb-3">
                            <label for="inputInvoiceNumber">Numer faktury</label>
                            <input value="{{ $stock->invoice_id }}" type="text"
                                   class="form-control @error('invoice_number') is-invalid @enderror"
                                   id="inputInvoiceNumber" name="invoice_number">
                            <div class="invalid-feedback">
                                @error('invoice_number')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <!-- Edit invoice_number -->
                        <div class="form-group mb-3">
                            <label for="inputInvoiceNumber">Ilość</label>
                            <input value="{{ $stock->quantity }}" type="number"
                                   class="form-control @error('invoice_number') is-invalid @enderror"
                                   id="inputInvoiceNumber"  name="invoice_number">
                            <div class="invalid-feedback">
                                @error('invoice_number')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="form-group p-14 mb-3">
                            <label for="inputInvoiceDate">Data operacji</label>
                            <input value="{{ $stock->operation_date->format('Y-m-d') }}" type="date"
                                   class="form-control @error('invoice_date') is-invalid @enderror"
                                   id="inputInvoiceDate" name="invoice_date">
                            <div class="invalid-feedback">
                                @error('invoice_date')
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
