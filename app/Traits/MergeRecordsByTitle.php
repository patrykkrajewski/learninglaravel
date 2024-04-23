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
                return $record['invoice']['product_name'] . '-' . $record['invoice']['invoice_number'];
            })
            ->map(function ($group) {
                $filterRecords = $group->where('title')->whereIn('title', ['Dodaj', 'Usuń']);
                if ($filterRecords->isEmpty()) {
                    return $group;
                }
                $filterRecords->map(function ($item) {
                    if ($item['title'] == 'Dodaj') {
                        $item['quantity'] = -$item['quantity'];
                    }
                });
                $totalQuantity = $filterRecords->sum('quantity');

                $newestDate = $filterRecords->max('operation_date');
                $lastOperation = $filterRecords->sortByDesc('id')->first()['title'];

                $group = $group->reject(function ($record) {
                    return in_array($record['title'], ['Usuń', 'Dodaj']);
                });

                if ($filterRecords->count() > 0) {
                    $mergedRecord = $filterRecords->first();
                    if($totalQuantity<0){
                        $mergedRecord['title'] = 'Dodaj';
                        $mergedRecord['quantity'] = - $totalQuantity;
                    } else {
                        $mergedRecord['quantity'] = $totalQuantity;
                        $mergedRecord['title'] = 'Usuń';
                    }
                    $mergedRecord['operation_date'] = $newestDate;

                    $group->prepend($mergedRecord);
                }

                return $group;
            })
            ->flatten()
            ->unique()
            ->toArray();
    }
}
