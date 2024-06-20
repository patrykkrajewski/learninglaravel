<?php

namespace App\Traits;

use Illuminate\Support\Collection;

trait MergeRecordsByTitle
{
    /**
     * Merge records by their titles.
     *
     * @param Collection $records
     * @return array
     */
    public function mergeRecordsByTitle(Collection $records)
    {
        return $records
            ->groupBy(function ($record) {
                $record = collect($record);
                return $record['invoice']['product_name'] . '-' . $record['invoice']['invoice_number'] . '-' . $record['title'];
            })
            ->map(function ($group) {
                // Check if the group contains only the same type of titles
                $filteredRecords = $group->whereIn('title', ['Dodaj', 'Sprzedaż internetowa', 'Sprzedaż stacjonarna']);

                // If no relevant records, return the group as is
                if ($filteredRecords->isEmpty()) {
                    return $group;
                }

                // Adjust quantities for 'Dodaj' operations
                $filteredRecords->transform(function ($item) {
                    if ($item['title'] == 'Dodaj') {
                        $item['quantity'] = -$item['quantity'];
                    }
                    return $item;
                });

                // Sum quantities and get the newest operation date and last operation type
                $totalQuantity = $filteredRecords->sum('quantity');
                $newestDate = $filteredRecords->max('operation_date');
                $lastOperation = $filteredRecords->sortByDesc('id')->first()['title'];

                // Remove the relevant records from the original group
                $group = $group->reject(function ($record) {
                    return in_array($record['title'], ['Dodaj', 'Sprzedaż internetowa', 'Sprzedaż stacjonarna']);
                });

                // If there are any filtered records, create a merged record
                if ($filteredRecords->count() > 0) {
                    $mergedRecord = $filteredRecords->first();
                    if ($totalQuantity < 0) {
                        $mergedRecord['title'] = 'Dodaj';
                        $mergedRecord['quantity'] = -$totalQuantity;
                    } else {
                        $mergedRecord['quantity'] = $totalQuantity;
                        $mergedRecord['title'] = $lastOperation;
                    }
                    $mergedRecord['operation_date'] = $newestDate;

                    // Add the merged record at the beginning of the group
                    $group->prepend($mergedRecord);
                }

                return $group;
            })
            ->flatten()
            ->unique()
            ->toArray();
    }
}
