<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista Faktur</title>
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

        table {
            margin: 0 auto;
            width: 90%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        th, td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #d1d5db;
        }

        th {
            background-color: #f3f4f6;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #f9fafb;
        }

        tr:hover {
            background-color: #f4f4f4;
        }

    </style>
</head>
<body>

<h1>Invoice List</h1>
<div class="container">
    <nav class="navbar navbar-light bg-light">
        <div class="d-flex justify-content-center w-75">
            <form method="GET" action="{{ route('invoices.search') }}">
                <input name="search" class="form-control mr-sm-2 w-100" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
</div>

<div id="datatable">
</div>
<table>
    <thead>
    <tr>
        <th>Invoice Number</th>
        <th>Product Name</th>
        <th>Invoice Date</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>VAT Rate</th>
        <th>Place</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach ($results as $result)
        <tr>
            <td>{{ $result->invoice_number }}</td>
            <td>{{ $result->product_name }}</td>
            <td>{{ $result->invoice_date }}</td>
            <td>{{ $result->quantity }}</td>
            <td>{{ $result->price }}</td>
            <td>{{ $result->vat_rate }}</td>
            <td>{{ $result->place }}</td>
            <td></td>
        </tr>
    @endforeach

    </tbody>
</table>
{{--{{$invoices -> links()}}--}}
</body>
</html>
