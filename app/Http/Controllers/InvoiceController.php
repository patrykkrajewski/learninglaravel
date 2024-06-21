<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceController\AddStockRequest;
use App\Http\Requests\InvoiceController\DeleteStockRequest;
use App\Http\Requests\InvoiceController\EditStockRequest;
use App\Http\Requests\InvoiceController\MoveStockRequest;
use App\Http\Requests\InvoiceController\StoreRequest;
use App\Models\Invoice;
use App\Models\StockControl;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = $request->input('sortBy', 'created_at'); // Sortowanie po dacie dodania
        $sortDirection = $request->input('sortDirection', 'desc'); // Sortowanie malejące
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $query = Invoice::query();

        if (!empty($start_date)) {
            $query->where('invoice_date', '>=', $start_date);
        }

        if (!empty($end_date)) {
            $query->where('invoice_date', '<=', $end_date);
        }

        // Sortowanie z uwzględnieniem warunku ilości
        $query->orderByRaw("CASE WHEN quantity = 0 THEN 1 ELSE 0 END, $sortBy $sortDirection");

        $invoices = $query->paginate(20);

        return view('invoice_list', compact('invoices', 'sortBy', 'sortDirection'));
    }

    public function create()
    {
        return view('invoice_create');
    }

    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();

        // Sprawdzenie, czy istnieje faktura z takim samym numerem i nazwą produktu
        $existingInvoice = Invoice::where('invoice_number', $validatedData['invoice_number'])
            ->where('product_name', $validatedData['product_name'])
            ->first();

        if ($existingInvoice) {
            return redirect()->back()->withErrors(['duplicate' => 'Faktura o tym numerze i nazwie produktu już istnieje.']);
        }

        $invoice = new Invoice($validatedData);
        $invoice->invoice_quantity = $invoice->quantity;
        $invoice->save();

        return redirect()->route('invoices.index');
    }

    public function edit($id)
    {
        $invoice = Invoice::find($id);
        return view('invoice_edit', ['invoice' => $invoice]);
    }

    public function update(EditStockRequest $request, $id)
    {
        $validatedData = $request->validated();
        $invoice = Invoice::findOrFail($id);
        $invoice->invoice_number = $validatedData['invNumber'];
        $invoice->product_name = $validatedData['invProductName'];
        $invoice->quantity = $validatedData['invQuantity'];
        $invoice->place = $validatedData['invPlace'];
        $invoice->invoice_date = $validatedData['invDate'];
        $invoice->vat_rate = $validatedData['quantityToRemove'];
        $invoice->save();
        if ($validatedData['search']) {
            return redirect()->back();
        }
        return redirect()->route('invoices.index')->with('success', 'Faktura została zaktualizowana pomyślnie.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $sortBy = $request->input('sortBy', 'asc');
        $sortDirection = $request->input('sortDirection');
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

        if ($sortBy && $sortDirection) {
            $query->orderBy($sortBy, $sortDirection);
        }

        $results = $query->paginate(20);

        return view('invoice_search', compact('results', 'sortBy', 'sortDirection'));
    }

    public function deleteStock(DeleteStockRequest $request)
    {
        $validatedData = $request->validated();
        $action = $validatedData['s_type'];
        $id = $validatedData['id'];
        $invoice_number = $validatedData['invoice_number'];
        $product_name = $validatedData['product_name'];
        $quantityToRemove = $validatedData['quantityToRemove'];
        $invDate = $validatedData['invDate'];

        $invoice = Invoice::find($id);
        $invoice->quantity = $invoice->quantity - $quantityToRemove;
        $invoice->save();

        StockControl::create([
            'title' => $action,
            'invoice_id' => $id,
            'quantity' => -$quantityToRemove,
            'operation_date' => $invDate,
            'move_to' => '',
        ]);

        if ($validatedData['search']) {
            return redirect()->back();
        }

        return redirect()->route('invoices.index')->with('success', 'Liczba sztuk pomyślnie odjęto.');
    }

    public function addStock(AddStockRequest $request)
    {
        // Walidacja danych wejściowych
        $validatedData = $request->validated();

        // Pobierz dane z formularza
        $invoiceId = $validatedData['id'];
        $quantityToAdd = $validatedData['quantityToAdd'];
        $invDate = $validatedData['invDate'];
        $search = $validatedData['search'];
        $invoiceNumber = $validatedData['invoice_number'];
        $productName = $validatedData['product_name'];

        try {
            // Sprawdź, czy istnieje już taka faktura
            $existingInvoice = Invoice::where('invoice_number', $invoiceNumber)
                ->where('product_name', $productName)
                ->first();

            if ($existingInvoice) {
                // Jeśli istnieje, przekieruj z komunikatem
                return redirect()->back()->with('error', 'Taka faktura już istnieje.')->withInput();
            }

            // Jeśli faktura nie istnieje, utwórz nową
            $invoice = Invoice::findOrFail($invoiceId);
            $invoice->invoice_date = $invDate;
            $invoice->quantity += $quantityToAdd;
            $invoice->save();

            // Przekieruj użytkownika z powrotem do poprzedniej strony z dodanym komunikatem sukcesu
            return redirect()->back()->with('success', 'Liczba sztuk została pomyślnie dodana do faktury.');
        } catch (\Exception $e) {
            // Jeśli wystąpi inny rodzaj wyjątku, przekieruj z odpowiednim komunikatem błędu
            return redirect()->back()->with('error', 'Wystąpił błąd podczas dodawania liczby sztuk do faktury.')->withInput();
        }
    }

    public function moveStock(MoveStockRequest $request)
    {
        $validatedData = $request->validated();
        $id = $validatedData['id'];
        $invoiceNumber = $validatedData['invoice_number'];
        $productName = $validatedData['product_name'];
        $quantityToMove = $validatedData['quantityToMove'];
        $operationDate = $validatedData['operationDateToMove'];
        $placeToMove = $validatedData['placeToMove'];

        $invoice = Invoice::find($id);
        $invoice->quantity -= $quantityToMove;
        $invoice->save();

        StockControl::create([
            'title' => 'Przeniesienie',
            'invoice_id' => $id,
            'quantity' => $quantityToMove,
            'operation_date' => $operationDate,
            'move_to' => $placeToMove,
        ]);

        if ($validatedData['search']) {
            return redirect()->back();
        }

        return redirect()->route('invoices.index')->with('success', 'Pomyślnie przeniesiono sztuki.');
    }
}

