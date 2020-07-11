<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequisitionProduct extends Model
{

    public function product()
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }
    protected $fillable = [
        'quantity'
    ];
}
