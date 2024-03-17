<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menadżer Faktur</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'figtree', sans-serif;
            background-color: #f9fafb;
            color: #1f2937;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 3rem;
            margin-bottom: 2rem;
            font-size: 2.5rem;
            font-weight: 600;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 0.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group label {
            font-weight: 600;
        }

        .btn-primary {
            background-color: #6366f1;
            border-color: #6366f1;
            font-weight: 600;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #4338ca;
            border-color: #4338ca;
        }
    </style>
</head>
<body>
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
</body>
</html>
