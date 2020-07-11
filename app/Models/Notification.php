<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use SoftDeletes;

    public function messageTo()
    {
        return $this->belongsTo(User::class, 'message_to')->withTrashed();
    }
}
