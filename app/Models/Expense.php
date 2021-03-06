<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;

    protected $fillable = ['expense_date', 'expense_category_id', 'amount', 'note'];

    protected $dates = ['expense_date'];

    public function branch()
    {
        return $this->belongsTo(Branch::class)->withTrashed();
    }

    public function expenseCategory()
    {
        return $this->belongsTo(ExpenseCategory::class)->withTrashed();
    }

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        self::creating(function($model){
            $model->branch_id =  auth()->user()->employee->branch_id;
            $model->expense_id = get_option('expense_id_prefix').str_pad(Expense::withTrashed()->count()+1,get_option('invoice_length'),0,STR_PAD_LEFT);
        });
    }
}
