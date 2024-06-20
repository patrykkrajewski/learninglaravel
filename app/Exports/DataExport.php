<?php

namespace App\Exports;

use App\Models\Invoice;
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
        $data = new Collection();

        foreach ($invoices as $invoice) {
            $internetSalesQuantity = $invoice->stockControls
                ->where('title', 'Sprzedaż Internetowa')
                ->sum('quantity');

            if ($internetSalesQuantity != 0) {
                $data->push([
                    'LP.' => ++$lp,
                    'Nazwa towaru' => $invoice->product_name,
                    'Faktura' => $invoice->invoice_number,
                    'CENA(netto)' => number_format($invoice->price, 2, ',', '.') . ' zł',
                    'Vat' => $invoice->vat_rate . '%',
                    'Stan na start' => $invoice->invoice_quantity . ' szt.',
                    'Wartość stanu na start' => number_format($invoice->invoice_quantity * $invoice->price, 2, ',', '.') . ' zł',
                    'Rozchody' => $internetSalesQuantity . ' szt.',
                    'Wartość sprzedanych [Netto]' => number_format($internetSalesQuantity * $invoice->price, 2, ',', '.') . ' zł',
                    'Wartość sprzedanych [Brutto]' => number_format($internetSalesQuantity * $invoice->price * (1 + $invoice->vat_rate / 100), 2, ',', '.') . ' zł',
                ]);
            }

            $stationarySalesQuantity = $invoice->stockControls
                ->where('title', 'Sprzedaż Stacjonarna')
                ->sum('quantity');

            if ($stationarySalesQuantity != 0) {
                $data->push([
                    'LP.' => ++$lp,
                    'Nazwa towaru' => $invoice->product_name,
                    'Faktura' => $invoice->invoice_number,
                    'CENA(netto)' => number_format($invoice->price, 2, ',', '.') . ' zł',
                    'Vat' => $invoice->vat_rate . '%',
                    'Stan na start' => $invoice->invoice_quantity . ' szt.',
                    'Wartość stanu na start' => number_format($invoice->invoice_quantity * $invoice->price, 2, ',', '.') . ' zł',
                    'Rozchody' => $stationarySalesQuantity . ' szt.',
                    'Wartość sprzedanych [Netto]' => number_format($stationarySalesQuantity * $invoice->price, 2, ',', '.') . ' zł',
                    'Wartość sprzedanych [Brutto]' => number_format($stationarySalesQuantity * $invoice->price * (1 + $invoice->vat_rate / 100), 2, ',', '.') . ' zł',
                ]);
            }
        }

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
            'Wartość sprzedanych [Netto]',
            'Wartość sprzedanych [Brutto]'
        ];
    }
}
