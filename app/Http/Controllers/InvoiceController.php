<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceController\AddStockRequest;
use App\Http\Requests\RemoveStockRequest;
use App\Http\Requests\InvoiceController\EditStockRequest;
use App\Http\Requests\InvoiceController\MoveStockRequest;
use App\Http\Requests\InvoiceController\StoreRequest;
use App\Models\Invoice;
use App\Models\StockControl;
use App\Traits\MergeRecordsByTitle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{
    use MergeRecordsByTitle;

    public function index(Request $request)
    {
        $sortBy = $request->input('sortBy', 'asc');
        $sortDirection = $request->input('sortDirection');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $query = Invoice::query();

        if (!empty($start_date)) {
            $query->where('invoice_date', '>=', $start_date);
        }

        if (!empty($end_date)) {
            $query->where('invoice_date', '<=', $end_date);
        }

        if ($sortBy && $sortDirection) {
            $query->orderBy($sortBy, $sortDirection);
        }

        // Dodaj sortowanie, aby faktury z ilością równą zero były na końcu
        //

        $invoices = $query->paginate(20);

        return view('invoice_list', compact('invoices', 'sortBy', 'sortDirection'));
    }

    public function create()
    {
        return view('invoice_create');
    }

    public function store(StoreRequest $request)
    {
        $invoice = new Invoice($request->validated());
        $validatedData = $request->validated();
        $invoice->invoice_quantity = $validatedData['quantity'];
        $invoice->save();
        return redirect()->route('invoices.index');
    }

    public function edit($id)
    {
        $invoice = Invoice::find($id);
        return view('invoice_edit', ['invoice' => $invoice]);
    }

    /**
     * @param EditStockRequest $requset
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'invoice_id' => 'required|exists:invoices,id',
            'product_name' => 'required|string',
            'operation_date' => 'required|date',
            'quantity' => 'required|integer|min:1',
            'move_to' => 'nullable|string',
        ]);

        $stock = StockControl::findOrFail($id);
        $stock->title = $request->input('title');
        $stock->invoice_id = $request->input('invoice_id');
        $stock->operation_date = $request->input('operation_date');
        $stock->quantity = $request->input('quantity');
        $stock->move_to = $request->input('move_to') ?? '';
        $stock->save();

        return redirect()->route('stock_controls.index')->with('success', 'Rekord zaktualizowany.');
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


    public function deleteStock(RemoveStockRequest $request)
    {
        $validated = $request->validated();

        $id = $validated['id'];
        $invoice_number = $validated['invoice_number'];
        $product_name = $validated['product_name'];
        $quantityToRemove = $validated['quantityToRemove'];
        $invDate = $validated['invDate'];
        $saleType = $validated['sale_type']; // Get the sale type from the form

        $invoice = Invoice::find($id);
        $invoice->quantity = $invoice->quantity - $quantityToRemove;
        $invoice->save();

        // Check if a similar record exists
        $existingStock = StockControl::where('title', $saleType)
            ->where('invoice_id', $id)
            ->where('operation_date', $invDate)
            ->where('move_to', '')
            ->first();

        if ($existingStock) {
            // Update the existing record's quantity
            $existingStock->quantity += $quantityToRemove;
            $existingStock->save();
        } else {
            // Create a new record if no similar record exists
            StockControl::create([
                'title' => $saleType,
                'invoice_id' => $id,
                'quantity' => $quantityToRemove, // ujemna ilość oznacza odejmowanie z zapasów
                'operation_date' => $invDate, // lub inna data operacji
                'move_to' => '',
            ]);
        }

        if ($validated['search']) {
            return redirect()->back();
        }

        return redirect()->route('invoices.index')->with('success', 'Liczbe sztuk pomyślnie odjęto.');
    }



    public function addStock(AddStockRequest $req)
    {
        $req = $req->validated();
        $id = $req ['id'];
        $invoice_number = $req ['invoice_number'];
        $quantityToAdd = $req['quantityToAdd'];
        $product_name = $req ['product_name'];
        $invDate = $req ['invDate'];
        $invoice = Invoice::find($id);
        $invoice->quantity = $invoice->quantity + $quantityToAdd;
        $invoice->save();
        StockControl::create([
            'title' => 'Dodaj',
            'invoice_id' => $id,
            //'product_name' => $product_name,
            'quantity' => $quantityToAdd, // ujemna ilość oznacza odejmowanie z zapasów
            'operation_date' => $invDate, // lub inna data operacji
            'move_to' => '', // Możesz dostosować to pole do swoich potrzeb
        ]);
        if ($req ['search']) {
            return redirect()->back();
        }
        return redirect()->route('invoices.index')->with('success', 'Liczbe sztuk pomyślnie dodano.');
    }

    public function moveStock(MoveStockRequest $request)
    {
        // Pobierz zwalidowane dane z żądania
        $validatedData = $request->validated();

        // Pobierz potrzebne dane z żądania
        $id = $validatedData['id'];
        $invoiceNumber = $validatedData['invoice_number'];
        $productName = $validatedData['product_name'];
        $quantityToMove = $validatedData['quantityToMove'];
        $operationDate = $validatedData['operationDateToMove'];
        $placeToMove = $validatedData['placeToMove'];

        // Znajdź fakturę do aktualizacji
        $invoice = Invoice::find($id);

        // Dodaj ilość do faktury
        $invoice->quantity -= $quantityToMove;
        $invoice->save();

        // Stwórz nowy rekord w StockControl
        StockControl::create([
            'title' => 'Przeniesienie',
            'invoice_id' => $id,
            'quantity' => $quantityToMove,
            'operation_date' => $operationDate,
            'move_to' => $placeToMove,
        ]);
        if ($request ['search']) {
            return redirect()->back();
        }

        // Przekieruj użytkownika po zakończeniu operacji
        return redirect()->route('invoices.index')->with('success', 'Pomyślnie przeniesiono sztuki.');
    }
}

