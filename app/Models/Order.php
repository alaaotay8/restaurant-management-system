<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'table_id',
        'order_products',
        'total_products',
        'total_price',
        'remarks',
        'payment_status',
        'placed_on',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
