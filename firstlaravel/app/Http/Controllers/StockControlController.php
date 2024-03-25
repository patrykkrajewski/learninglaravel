<?php

namespace App\Http\Controllers;

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
        $stockControls = StockControl::all();
        return view('stock_controls', compact('stockControls'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stockControl = StockControl::findOrFail($id);
        return view('stock_controls_edit', compact('stockControl'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // Validate the input data
        $request->validate([
            'title' => 'required|string|max:255',
            'invoice_id' => 'required|exists:invoices,id',
            'quantity' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        // Find the StockControl instance to update
        $stockControl = StockControl::findOrFail($id);

        // Update the data
        $stockControl->update([
            'title' => $request->title,
            'invoice_id' => $request->invoice_id,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);

        // Redirect to the stock controls index view
        return redirect()->route('stock-controls.index');
    }
}
