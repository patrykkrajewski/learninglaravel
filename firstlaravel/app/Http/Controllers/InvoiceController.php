<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceController\StoreRequest;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $invoices = Invoice::paginate(2);
        $invoices = Invoice::all();

        return view('invoice_list', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('welcome');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $invoice = new Invoice($request->validated());
        $invoice->save();

        return redirect()-> route('invoices.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
       $invoice =  Invoice::find($id);
       return view('invoice_edit',['invoice' =>$invoice]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        $invoice->invoice_number = $request->invoice_number;
        $invoice->product_name = $request->product_name;
        $invoice->invoice_date = $request->invoice_date;
        $invoice->quantity = $request->quantity;
        $invoice->price = $request->price;
        $invoice->vat_rate = $request->vat_rate;
        $invoice->place = $request->place;
        $invoice->save();
//dodac wiadomość o udałolo sie edytowac na ekran
        return redirect()-> route('invoices.index')->with('message', 'Invoice changed');
    }
    public function move(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        if ($invoice->place == 'Wydawnictwo') {
        $invoice->place = $invoice->place = 'Sklepik';
        } else {
            $invoice->place = $request->place='Wydawnictwo';
        }


        $invoice->save();
//dodac wiadomość o udałolo sie edytowac na ekran
        return redirect()-> route('invoices.index')->with('message', 'Invoice changed');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Invoice::destroy($id);
        return redirect()-> route('invoices.index')->with('message', 'Invoice deleted');
    }
}
