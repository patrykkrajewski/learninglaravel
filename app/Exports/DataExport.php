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
    private $dateStart;
    private $dateEnd;

    public function __construct($dateStart = null, $dateEnd = null)
    {
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $invoices = Invoice::when($this->dateStart, function ($q) {
            $q->whereHas('stockControls', function ($q){
                $q->where('operation_date', '>=', $this->dateStart);
            });
        })
            ->when($this->dateEnd, function ($q) {
                $q->whereHas('stockControls', function ($q){
                    $q->where('operation_date', '<=', $this->dateEnd);
                });
            })
            ->get();

        $lp = 0;
        $data = $invoices->map(function ($invoice) use (&$lp) {
            return [
                'LP.' => ++$lp,
                'Nazwa towaru' => $invoice->product_name,
                'Faktura' => $invoice->invoice_number,
                'CENA(netto)' => number_format($invoice->price, 2, ',', '.') . ' zł', // Format price in zł
                'Vat' => $invoice->vat_rate . '%',
                'Stan na start' => $invoice->invoice_quantity. 'szt.',
                'Wartość stanu na start' => number_format($invoice->invoice_quantity * $invoice->price, 2, ',', '.') . ' zł', // Format price in zł
                'Rozchody' => $invoice->stockControls->where('title', 'Usuń')->sum('quantity') - $invoice->stockControls->where('title', 'Dodaj')->sum('quantity'). 'szt.',
                'Wartość sprzedanych [Netto]' => number_format(($invoice->stockControls->where('title', 'Usuń')->sum('quantity') - $invoice->stockControls->where('title', 'Dodaj')->sum('quantity')) * $invoice->price, 2, ',', '.') . ' zł',
                'Wartość sprzedanych [Brutto]' => number_format(($invoice->stockControls->where('title', 'Usuń')->sum('quantity') - $invoice->stockControls->where('title', 'Dodaj')->sum('quantity')) * $invoice->price + (($invoice->stockControls->where('title', 'Usuń')->sum('quantity') - $invoice->stockControls->where('title', 'Dodaj')->sum('quantity')) * $invoice->price) * $invoice->vat_rate * 0.01 , 2, ',', '.') . ' zł',
            ];
        });

        // Return the data collection
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
            'Vat',
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

