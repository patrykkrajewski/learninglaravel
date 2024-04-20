<?php

namespace App\Exports;

use App\Models\Invoice;
use App\Models\StockControl;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class DataExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $invoices = Invoice::all();
        $lp = 0;
        $data = $invoices->map(function ($invoice) use (&$lp) {
            return [
                'LP.' => ++$lp,
                'Nazwa towaru' => $invoice->product_name,
                'Faktura' => $invoice->invoice_number,
                'CENA(netto)' => $invoice->price,
                'Stan na start' => $invoice->invoice_quantity,
                'Wartość stanu na start' => $invoice->invoice_quantity * $invoice->price,
                'Rozchody' => '',
                'Wartość na sprzedanych' => '',
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
            'Nazwa towaru',
            'Faktura',
            'CENA(netto)',
            'Stan na start',
            'Wartość stanu na start',
            'Rozchody',
            'Wartość na sprzedanych'
        ];
    }

    /**
     * Export data to Excel file.
     */

}
