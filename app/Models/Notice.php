<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notice extends Model
{
    use SoftDeletes;
    protected $dates = ['notify_date'];

    protected $fillable = ['title','description','notify_date'];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by')->withTrashed();
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'target_url')->where('type', 2);
    }
}
