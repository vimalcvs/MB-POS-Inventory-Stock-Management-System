<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SellProduct extends Model
{
    use SoftDeletes;

    public function product()
    {
        return $this->belongsTo(Product::class)->with('tax')->withTrashed();
    }

    protected $fillable = [
        'purchase_price','sell_price','tax_percentage','tax_amount','quantity','total_price'
    ];
}
