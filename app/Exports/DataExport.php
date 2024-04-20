<?php
namespace App\Exports;

use App\Models\StockControl;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Pobierz dane z modelu StockControl
        $stocks = StockControl::all();

        // Przekształć dane na kolekcję z dostosowanymi nagłówkami kolumn
        $data = $stocks->map(function ($stock) {
            return [
                'LP.' => $stock->id, // Zakładając, że 'id' jest numerem porządkowym
                'NAZWA TOWARU' => $stock->product_name,
                'Faktura' => $stock->invoice_number,
                'JM' => 'szt.',
                'CENA(netto)' => $stock->net_price,
                'Stan końcowy' => $stock->final_stock,
            ];
        });

        // Zwróć kolekcję danych
        return $data;
    }

    /**
     * Define column headings
     */
    public function headings(): array
    {
        return [
            'LP.',
            'NAZWA TOWARU',
            'Faktura',
            'JM',
            'CENA(netto)',
            'Stan Stan końcowy',
        ];
    }
}
