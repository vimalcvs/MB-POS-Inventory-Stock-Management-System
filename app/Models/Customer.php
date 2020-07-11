<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','phone','email','address'];

    public function sells()
    {
        return $this->hasMany(Sell::class);
    }

    public function payments()
    {
        return $this->hasMany(PaymentFromCustomer::class);
    }
}
