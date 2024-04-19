<?php

namespace App\Exports;

use App\Models\StockControl;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Pobierz dane z modelu StockControl
        $stocks = StockControl::all();

        // Przekształć dane na kolekcję
        $data = $stocks->map(function ($stock) {
            return [
                'Operacja' => $stock->title,
                'Numer faktury' => $stock->invoice_id,
                'Nazwa produktu' => $stock->product_name,
                'Data operacji' => $stock->operation_date->format('Y-m-d'),
                'Ilość' => $stock->quantity,
                'Przeniesione do' => $stock->move_to,
            ];
        });

        // Zwróć kolekcję danych
        return $data;
    }
}
