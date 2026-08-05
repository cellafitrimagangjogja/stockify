<?php

namespace App\Models;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockOpname extends Model
{
    protected $table = 'stock_opnames';

    protected $fillable = [
        'product_id',
        'user_id',
        'system_stock',
        'physical_stock',
        'difference',
        'opname_date',
        'note',
    ];

     protected $casts = [
        'opname_date' => 'date',
    ];
    /**
     * Stock opname memiliki satu produk.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
}