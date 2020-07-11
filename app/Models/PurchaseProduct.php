<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseProduct extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'purchase_price','quantity','total_price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }
}
