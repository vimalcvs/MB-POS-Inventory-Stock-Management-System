<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $dates = ['date_of_birth','joining_date'];

    protected $fillable = [
        'department_id',
        'designation_id',
        'branch_id',
        'id_number',
        'blood_group',
        'gender',
        'date_of_birth',
        'address',
        'phone_number',
        'educational_background',
        'joining_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class)->withTrashed();
    }

    public function department()
    {
        return $this->belongsTo(Department::class)->withTrashed();
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class)->withTrashed();
    }
}
