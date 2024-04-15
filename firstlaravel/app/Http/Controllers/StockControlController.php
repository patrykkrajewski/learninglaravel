<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\StockControl;
use Illuminate\Http\Request;


class StockControlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all stock controls sorted by operation date
        $stocks = StockControl::orderBy('operation_date')->get();

        // Initialize arrays to store different types of records
        $addedStocks = [];
        $removedStocks = [];
        $transferredStocks = [];

        // Iterate through each stock control record
        foreach ($stocks as $stock) {
            // Determine the type of operation and store the record accordingly
            if ($stock->title == 'Dodaj') {
                $addedStocks[] = $stock;
            } elseif ($stock->title == 'Usuń') {
                $removedStocks[] = $stock;
            } elseif ($stock->title == 'Przeniesienie') {
                $transferredStocks[] = $stock;
            }
        }

        // Merge all types of records into a single array
        $allStocks = array_merge($addedStocks, $removedStocks, $transferredStocks);

        // Group the merged records by month
        $groupedStocks = collect($allStocks)->groupBy(function ($item) {
            return $item->operation_date->format('Y-m');
        });

        // Prepare the data to be passed to the view
        $months = [];
        foreach ($groupedStocks as $key => $groupedStock) {
            $months[$key] = [
                'hasInvoices' => $groupedStock->whereNotNull('invoice_id')->isNotEmpty(),
                'stocks' => $groupedStock
            ];
        }

        // Return the view with the grouped stock controls
        return view('stock_controls', compact('months', 'stocks'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stock = StockControl::findOrFail($id);
        return view('stock_controls_edit', compact('stock'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Walidacja danych wejściowych
        $request->validate([
            'invoice_number' => 'required',
            'product_name' => 'required',
            'operation_date' => 'required',
            'quantity' => 'required|numeric'
        ]);
        // Znajdź istniejący rekord w bazie danych
        $stock = StockControl::findOrFail($id);
        // Aktualizuj pola rekordu na podstawie danych z formularza
        $stock->invoice_id = $request->input('invoice_id');
        $stock->product_name = $request->input('product_name');
        $stock->operation_date = $request->input('operation_date');
        $stock->quantity = $request->input('quantity');

        // Zapisz zmiany w bazie danych
        $stock->save();

        // Przekieruj użytkownika po zapisaniu
        return redirect()->route('stock_controls.index')->with('success', 'Rekord został zaktualizowany pomyślnie.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $query = StockControl::query();

        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->where('invoice_id', 'like', "%$search%")
                    ->orWhere('title', 'like', "%$search%");
            });
        }

        if (!empty($start_date)) {
            $query->whereDate('operation_date', '>=', $start_date);
        }

        if (!empty($end_date)) {
            $query->whereDate('operation_date', '<=', $end_date);
        }

        $results = $query->paginate(20);

        return view('stock_controls_search', ['results' => $results]);
    }

}
