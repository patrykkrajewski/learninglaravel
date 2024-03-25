<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockControl extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stock_controls';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'invoice_id',
        'quantity',
        'operation_date',
        'move_to',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'operation_date' => 'date',
    ];

    /**
     * Get the invoice associated with the stock control.
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
