<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use PhpParser\Node\Expr\Cast\Array_;

trait MergeRecordsByTitle
{
    public function mergeRecordsByTitle($records)
    {
        return $records
            ->groupBy(function ($record) {
                $record = collect($record);
                return $record ['product_name'] . '-' . $record['invoice_id'];
            })
            ->map(function ($group) {
                $filterRecords = $group->where('title');
                if ($filterRecords->isEmpty()) {
                    return $group;
                }
                $filterRecords ->map(function ($item){
                    if ($item['title'] == 'Dodaj'){
                        $item['quantity'] = -$item['quantity'];
                    }
                });
                $totalQuantity = $filterRecords->sum('quantity');

                $newestDate = $filterRecords->max('operation_date');
                $lastOperation = $filterRecords->sortByDesc('id')->first()['title'];

                $group = $group->reject(function ($record) {
                    //return $record['title'] === $title;
                    return in_array($record['title'], ['Usuń', 'Dodaj']);
                });

                $mergedRecord = $filterRecords->first();
                $mergedRecord['quantity'] = $totalQuantity;
                $mergedRecord['operation_date'] = $newestDate;
                $mergedRecord['title'] = $lastOperation;

                return $group->prepend($mergedRecord);
            })
            ->flatten()
            ->unique()
            ->toArray();
    }
}
