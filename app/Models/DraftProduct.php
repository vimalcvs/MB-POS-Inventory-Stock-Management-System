<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DraftProduct extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class)->with('tax');
    }

    protected $fillable = [
        'purchase_price','sell_price','tax_percentage','tax_amount','quantity','total_price'
    ];
}
