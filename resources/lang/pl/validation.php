<?php

return [
    'required' => 'Pole :attribute jest wymagane.',
    'invoice_date.required' => 'Pole data faktury jest wymagane.',
    'numeric' => 'Pole :attribute musi być liczbą.',
    'min' => [
        'numeric' => 'Pole :attribute musi być większe niż :min.',
    ],
    'max' => [
        'numeric' => 'Pole :attribute musi być mniejsze niż :max.',
    ],
    // Dodaj inne komunikaty walidacji, jeśli są potrzebne

    'attributes' => [
        'invoice_number' => 'Numer faktury',
        'product_name' => 'Nazwa produktu',
        'invoice_date' => 'Data faktury',
        'quantity' => 'Ilość',
        'invoice_quantity' => 'Ilość aktualna',
        'price' => 'Cena',
        'vat_rate' => 'Stawka VAT',
        'place' => 'Miejsce'
    ],

];

