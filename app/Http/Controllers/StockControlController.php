<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\StockControl;
use App\Traits\MergeRecordsByTitle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\DataExport;
use Maatwebsite\Excel\Facades\Excel;

// Teraz możesz używać klasy VtifulExcel zamiast Excel


class StockControlController extends Controller
{
    use MergeRecordsByTitle;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all stock controls sorted by operation date
        $stocks = StockControl::with('invoice')->orderBy('operation_date')->get();

        // Initialize arrays to store different types of records
        $changedStocks = [];
        $removedStocks = [];
        $transferredStocks = [];

        // Iterate through each stock control record
        foreach ($stocks as $stock) {
            // Determine the type of operation and store the record accordingly
            if ($stock->title == 'Dodaj') {
                $changedStocks[] = $stock;
            } elseif ($stock->title == 'Sprzedaż internetowa' || $stock->title == 'Sprzedaż stacjonarna') {
                $removedStocks[] = $stock;
            } elseif ($stock->title == 'Przeniesienie') {
                $transferredStocks[] = $stock;
            }
        }
        $allStocks = array_merge($changedStocks, $removedStocks, $transferredStocks);

        $allStocks = $this->mergeRecordsByTitle(collect($allStocks));
        //$removedStocks = $this->mergeRecordsByTitle(collect($removedStocks), "Usuń");

        // Merge all types of records into a single array

        //  $allStocks = $this->mergeRecordsByTitle(collect($allStocks), "Usuń");
        // Group the merged records by month
        $groupedStocks = collect($allStocks)->groupBy(function ($item) {
            return $item['operation_date'] = Carbon::parse($item['operation_date'])->format('Y-m');
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stock = StockControl::findOrFail($id);
        return view('stock_controls_edit', compact('stock'));
    }

    public function export(Request $request)
    {
        return Excel::download(new DataExport($request->get('dateStart'), $request->get('dateEnd')), 'data.xlsx');
    }


    public function operation($month)
    {
        // Parsuj przekazany miesiąc do obiektu Carbon
        $date = Carbon::parse($month);

        // Pobierz rekordy StockControl dla danego miesiąca
        $stocks = StockControl::whereYear('operation_date', $date->year)
            ->whereMonth('operation_date', $date->month)
            ->get();

        // Przekazujemy dane do widoku archiwe_edit, który wyświetli rekordy z danego miesiąca
        return view('archive_edit', ['stocks' => $stocks, 'month' => $month]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

//        $request->validate([
//            'title' => 'required',
//            'invoice_id' => 'required|exists:invoices,id',
//            'product_name' => 'required',
//            'operation_date' => 'required|date',
//            'quantity' => 'required|numeric',
//            'move_to' => '',
//        ]);


        $stock = StockControl::findOrFail($id);
        $stock->title = $request->input('title');

        $oldQuantity = $stock->quantity;
        $stock->quantity = $request->input('quantity');
        $stock->operation_date = $request->input('operation_date');

        // Optional: Check and set move_to
        $move_to = $request->input('move_to');
        $stock->move_to = $move_to !== null ? $move_to : '';

        $invoice = Invoice::findOrFail($stock->invoice_id);

        $invoice->invoice_number = $request->input('invoice_id');
        $stock->save();
        $totalDelete = StockControl::where('invoice_id',$invoice->id)->get()->filter(function ($item,$key){return strpos($item->title,'Sprzedaż') !== false;})->sum('quantity');
        $totalaAdd = StockControl::where('invoice_id',$invoice->id)->get()->filter(function ($item,$key){return strpos($item->title,'Dodaj') !== false;})->sum('quantity');
        $totalaMove = StockControl::where('invoice_id',$invoice->id)->get()->filter(function ($item,$key){return strpos($item->title,'Przenies') !== false;})->sum('quantity');
        $validAmount = $invoice->invoice_quantity + $totalaAdd - $totalDelete - $totalaMove;
        $dif = $request->quantity - $oldQuantity;

        if($stock->quantity != 0) {
            if ($stock->title == 'Sprzedaż internetowa' || $stock->title == 'Sprzedaż stacjonarna') {
                if ($oldQuantity <= $request->quantity) {

                    $invoice->quantity = $invoice->quantity - $dif;
                } else {
                    $invoice->quantity = $invoice->quantity + $dif;
                }
            }

            if ($stock->title == 'Dodaj') {
                if ($oldQuantity <= $request->quantity) {

                    $invoice->quantity = $invoice->quantity + $dif;
                } else {
                    $invoice->quantity = $invoice->quantity - $dif;
                }
            }

            if ($stock->title == 'Przeniesienie') {
                if ($oldQuantity <= $request->quantity) {

                    $invoice->quantity = $invoice->quantity - $dif;
                } else {
                    $invoice->quantity = $invoice->quantity + $dif;
                }
            }
        }
        $invoice->product_name = $request->input('product_name');

        $invoice->quantity = $validAmount;

        $invoice->save();
        // Log for debugging
        logger()->info('Stock Control Updated:', ['stock_id' => $stock->id, 'invoice_id' => $stock->invoice_id]);

        // Redirect with success message
        return redirect()->route('stock_controls.index')->with('success', 'Rekord zaktualizowany.');
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
