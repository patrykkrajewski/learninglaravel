<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceController\StoreRequest;
use App\Models\Invoice;
use App\Models\StockControl;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::all();
        $invoices = Invoice::paginate(20);
        return view('invoice_list', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('invoice_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $invoice = new Invoice($request->validated());
        $invoice->save();
        return redirect()->route('invoices.index');
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
        $invoice = Invoice::find($id);
        return view('invoice_edit', ['invoice' => $invoice]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Walidacja danych wejściowych
        $request->validate([
            'invoice_number' => 'required',
            'product_name' => 'required',
            'invoice_date' => 'required',
            'quantity' => 'required|numeric', // Dodaj walidację dla pola quantity
            'price' => 'required|numeric',
            'vat_rate' => 'required|numeric',
            'place' => 'required'
        ]);

        // Pobierz fakturę do aktualizacji
        $invoice = Invoice::findOrFail($id);

        // Aktualizuj pola faktury na podstawie danych z formularza
        $invoice->invoice_number = $request->input('invoice_number');
        $invoice->product_name = $request->input('product_name');
        $invoice->invoice_date = $request->input('invoice_date');
        $invoice->quantity = $request->input('quantity');
        $invoice->price = $request->input('price');
        $invoice->vat_rate = $request->input('vat_rate');
        $invoice->place = $request->input('place');

        // Zapisz zmiany w bazie danych
        $invoice->save();

        // Przekieruj użytkownika po zapisaniu
        return redirect()->route('invoices.index')->with('success', 'Faktura została zaktualizowana pomyślnie.');
    }

    public function move(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        if ($invoice->place == 'Wydawnictwo') {
            $invoice->place = $invoice->place = 'Sklepik';
        } else {
            $invoice->place = $request->place = 'Wydawnictwo';
        }
        $invoice->save();
//dodac wiadomość o udałolo sie edytowac na ekran
        return redirect()->route('invoices.index')->with('message', 'Invoice changed');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Request $request)
    {
        // Znajdź fakturę do usunięcia
        $invoice = Invoice::find($id);

        // Stwórz nowy wpis w tabeli stock_controls na podstawie danych faktury
        // $stockControl = new StockControl();
        // $stockControl->invoice_id = $invoice->id;
        // $stockControl->title = $invoice->product_name;
        // $stockControl->quantity = $invoice->quantity;
        // $stockControl->operation_date = date("Y-m-d");
        // $stockControl->save();

        // Usuń fakturę
        $invoice->delete();

        return redirect()->route('invoices.index')->with('message', 'Invoice deleted');
    }

    //z chatu nwm trzeba poprawic i ogarnac praktycznie od nowa
    public function search(Request $request)
    {
        $search = $request->input('search');

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $query = Invoice::query();

        if (!empty($search)) {
            $query->where(function ($query) use ($search) {
                $query->where('product_name', 'like', "%$search%")
                    ->orWhere('invoice_number', 'like', "%$search%");
            });
        }

        if (!empty($start_date)) {
            $query->where('invoice_date', '>=', $start_date);
        }

        if (!empty($end_date)) {
            $query->where('invoice_date', '<=', $end_date);
        }

        $results = $query->paginate(20);

        return view('invoice_search', ['results' => $results]);
    }

    public function update_quantity(Request $request, $id)
    {
        // Walidacja danych wejściowych
        $request->validate([
            'quantity' => 'required|integer',
        ]);

        // Pobierz fakturę z bazy danych
        $invoice = Invoice::findOrFail($id);

        // Dodaj ilość sztuk przekazaną przez użytkownika do istniejącej ilości w bazie danych
        $invoice->quantity += $request->input('quantity');
        $invoice->save();

        return redirect()->back()->with('success', 'Ilość sztuk została zaktualizowana.');
    }


}
