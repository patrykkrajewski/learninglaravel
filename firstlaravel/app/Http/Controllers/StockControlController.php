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
        // Pobierz wszystkie wpisy dotyczące kontrolowania zapasów posortowane według daty operacji
        $stocks = StockControl::orderBy('operation_date')->get();

        // Utwórz tablicę, która będzie przechowywała połączone wpisy
        $mergedStocks = [];

        // Iteruj przez każdą grupę wpisów
        foreach ($stocks as $stock) {
            // Utwórz unikalny identyfikator dla połączenia faktury i produktu
            $key = $stock->invoice_id . '-' . $stock->product_name;

            // Sprawdź, czy już istnieje wpis o takim identyfikatorze
            if (isset($mergedStocks[$key])) {
                // Jeśli tytuł to 'usun', odejmij ilość
                if ($stock->title == 'Usuń') {
                    $mergedStocks[$key]->quantity -= $stock->quantity;
                }
                // Jeśli tytuł to 'dodaj', dodaj ilość
                elseif ($stock->title == 'Dodaj') {
                    $mergedStocks[$key]->quantity += $stock->quantity;
                }
            } else {
                // Jeśli nie, dodaj nowy wpis do tablicy połączonych wpisów
                $mergedStocks[$key] = $stock;
            }
        }


        // Przekształć tablicę połączonych wpisów na kolekcję
        $mergedStocksCollection = collect($mergedStocks);

        // Grupowanie wpisów według miesiąca
        $groupedStocks = $mergedStocksCollection->groupBy(function($item) {
            return $item->operation_date->format('Y-m');
        });

        // Utwórz tablicę, która będzie przechowywała miesiące i informacje, czy mają faktury
        $months = [];
        foreach ($groupedStocks as $key => $groupedStock) {
            $months[$key] = [
                'hasInvoices' => $groupedStock->whereNotNull('invoice_id')->isNotEmpty(),
                'stocks' => $groupedStock
            ];
        }

        // Zwróć widok z danymi miesięcy
        return view('stock_controls', compact('months'));
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
        $stock->invoice_number = $request->input('invoice_number');
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
