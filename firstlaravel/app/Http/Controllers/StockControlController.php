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
        $stocks = Invoice::all();
        $stocks = StockControl::paginate(20);
        return view('stock_controls', compact('stocks'));
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
    public function update(Request $req, $id)
    {
        // Walidacja danych wejściowych
        $req->validate([
            'invoice_number' => 'required',
            'title' => 'required',
            'product_nmae' => 'required',
            'operation_date' => 'required',
            'quantity' => 'required|numeric'
        ]);
        // Pobierz fakturę do aktualizacji
        $stock = StockControl::findOrFail($id);
        // Aktualizuj pola faktury na podstawie danych z formularza
        $stock->invoice_number = $req->input('invoice_number');
        $stock->title = $req->input('title');
        $stock->product_name = $req->input('product_name');
        $stock->operation_date = $req->input('operation_date');
        $stock->quantity = $req->input('quantity');
        // Zapisz zmiany w bazie danych
        $stock->save();
        // Przekieruj użytkownika po zapisaniu
        return redirect()->route('stock_controls.index')->with('success', 'Faktura została zaktualizowana pomyślnie.');
    }

}
