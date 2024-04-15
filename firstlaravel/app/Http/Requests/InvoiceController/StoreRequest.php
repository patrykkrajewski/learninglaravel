<?php

namespace App\Http\Requests\InvoiceController;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'invoice_number' => ['required', 'string'],
            'product_name' => ['required', 'string'],
            'invoice_date' => ['required'],
            'quantity' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'vat_rate' => ['required', 'numeric','max:100','min:0'],
            'place' => ['required'],
        ];
    }
}
