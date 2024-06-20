<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RemoveStockRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|integer|exists:invoices,id',
            'invoice_number' => 'required|string',
            'product_name' => 'required|string',
            'quantityToRemove' => 'required',
            'invDate' => 'required|date',
            'sale_type' => 'required|string|in:Sprzedaż Stacjonarna,Sprzedaż Internetowa',
            'search' => 'nullable|string'
        ];
    }
}
