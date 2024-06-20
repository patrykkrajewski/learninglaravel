<?php

namespace App\Http\Requests\InvoiceController;

use Illuminate\Foundation\Http\FormRequest;

class DeleteStockRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'exists:invoices,id'],
            'quantityToRemove' => ['required'],
            'invDate' => ['required'],
            'invoice_number' => ['required', 'exists:invoices,invoice_number'],
            'product_name' => ['required', 'exists:invoices,product_name'],
            'search' => ['sometimes'],
            's_type' => ['sometimes'],
        ];
    }
}
