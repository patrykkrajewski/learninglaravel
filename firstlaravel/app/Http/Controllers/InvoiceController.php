<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceController\AddStockRequest;
use App\Http\Requests\InvoiceController\DeleteStockRequest;
use App\Http\Requests\InvoiceController\StoreRequest;
use App\Models\Invoice;
use App\Models\StockControl;
use Illuminate\Http\Request;
class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::paginate(20) ?? [];
        return view('invoice_list', ['invoices' => $invoices]);
    }
    public function create()
    {
        return view('invoice_create');
    }
    public function store(StoreRequest $request)
    {
        $invoice = new Invoice($request->validated());
        $validatedData = $request->validated();
        $invoice->invoice_quantity = $validatedData['invoice_quantity'];
        $invoice->save();
        return redirect()->route('invoices.index');
    }
    public function edit($id)
    {
        $invoice = Invoice::find($id);
        return view('invoice_edit', ['invoice' => $invoice]);
    }
    public function update(Request $request, $id)
    {
        // Walidacja danych wejściowych
        $request->validate([
            'invoice_number' => 'required',
            'product_name' => 'required',
            'invoice_date' => 'required',
            'quantity' => 'required|numeric',
            'invoice_quantity' => 'required|numeric',
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
        $invoice->invoice_quantity = $request->input('invoice_quantity');
        $invoice->quantity = $request->input('quantity');
        $invoice->price = $request->input('price');
        $invoice->vat_rate = $request->input('vat_rate');
        $invoice->place = $request->input('place');

        // Zapisz zmiany w bazie danych
        $invoice->save();

        // Przekieruj użytkownika po zapisaniu
        return redirect()->route('invoices.index')->with('success', 'Faktura została zaktualizowana pomyślnie.');
    }


    public function destroy(Request $request)
    {
    }
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
    public function deleteStock(DeleteStockRequest $request)
    {
        $request = $request->validated();
        $id = $request ['id'];
        $invoice_number = $request ['invoice_number'];
        $product_name = $request ['product_name'];
        $quantityToRemove = $request ['quantityToRemove'];
        $invoice = Invoice::find($id);
        $invoice->quantity = $invoice->quantity - $quantityToRemove;
        $invoice->save();
        StockControl::create([
            'title' => 'Usuń',
            'invoice_id' => $invoice_number,
            'product_name' => $product_name,
            'quantity' => $quantityToRemove, // ujemna ilość oznacza odejmowanie z zapasów
            'operation_date' => now(), // lub inna data operacji
            'move_to' => '',
        ]);
        return redirect()->route('invoices.index');
    }
    public function addStock(AddStockRequest $req)
    {
        $req = $req->validated();
        $id = $req ['id'];
        $invoice_number = $req ['invoice_number'];
        $quantityToAdd = $req['quantityToAdd'];
        $product_name = $req ['product_name'];

        $invoice = Invoice::find($id);
        $invoice->quantity = $invoice->quantity + $quantityToAdd;
        $invoice->save();
        StockControl::create([
            'title' => 'Dodaj',
            'invoice_id' => $invoice_number,
            'product_name' => $product_name,
            'quantity' => $quantityToAdd, // ujemna ilość oznacza odejmowanie z zapasów
            'operation_date' => now(), // lub inna data operacji
            'move_to' => '', // Możesz dostosować to pole do swoich potrzeb
        ]);
        return redirect()->route('invoices.index');
    }
    public function moveStock(AddStockRequest $req)
    {
        $req = $req->validated();
        $id = $req ['id'];
        $quantityToMove = $req['quantityToMove'];
        $placeToMove = $req['placeToMove'];
        $invoice = Invoice::find($id);
        //co ma to robić
        $invoice->save();
        return redirect()->route('invoices.index');
    }
}

