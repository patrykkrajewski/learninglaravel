<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Reedware\LaravelCompositeRelations\HasCompositeRelations;

class Invoice extends Model
{
    use HasFactory;
    use HasCompositeRelations;
    /**
     * The name of the table associated with the model.
     *
     * @var string
     */
    protected $table = 'invoices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_number',
        'product_name',
        'invoice_date',
        'quantity',
        'price',
        'vat_rate',
        'place',
        'sale_type',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'invoice_date' => 'date',
        'price' => 'decimal:2',
        'vat_rate' => 'decimal:2',
    ];

    public function stockControls()
    {
        return $this->hasMany(StockControl::class);
    }
}


