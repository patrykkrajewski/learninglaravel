<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use PhpParser\Node\Expr\Cast\Array_;

trait MergeRecordsByTitle
{
    public function mergeRecordsByTitle( $records, string $title)
    {
        return $records

            ->groupBy(function ($record) {
                $record = collect($record);
                return $record ['product_name'] . '-' . $record['invoice_id'];
            })
            ->map(function ($group) use ($title) {
                $filterRecords = $group->where('title', $title);

                if ($filterRecords->isEmpty()) {
                    return $group;
                }

                $totalQuantity = $filterRecords->sum('quantity');
                $newestDate = $filterRecords->max('operation_date');

                $group = $group->reject(function ($record) use ($title) {
                    return $record['title'] === $title;
                });

                $mergedRecord = $filterRecords->first();
                $mergedRecord['quantity'] = $totalQuantity;
                $mergedRecord['operation_date'] = $newestDate;

                return $group->prepend($mergedRecord);
            })
            ->flatten()
            ->toArray();
    }
}
