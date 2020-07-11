<?php

namespace App\Http\Controllers\Backend;

use App\Models\Branch;
use App\Models\Category;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Tax;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Toastr;

class TrashController extends Controller
{
    public function categories()
    {
        return view('backend.trash.categories',[
            'categories' => Category::where('deleted_at', '!=', NULL)->withTrashed()->get()
        ]);
    }

    public function categoryRestore(Request $request)
    {
        $category =   Category::where('id', $request->category_id)->withTrashed()->firstOrFail();
        $category->deleted_at = null;
        $category->save();

        Toastr::success('Category successfully Restore', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->back();
    }


    public function taxes()
    {
        return view('backend.trash.taxes',[
            'taxes' => Tax::where('deleted_at', '!=', NULL)->withTrashed()->get()
        ]);
    }

    public function taxRestore(Request $request)
    {
        $tax =   Tax::where('id', $request->id)->withTrashed()->firstOrFail();
        $tax->deleted_at = null;
        $tax->save();

        Toastr::success('Tax successfully Restore', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->back();
    }

    public function expenseCategories()
    {
        return view('backend.trash.expense-categories',[
            'categories' => ExpenseCategory::where('deleted_at', '!=', NULL)->withTrashed()->get()
        ]);
    }

    public function expenseCategoryRestore(Request $request)
    {
        $category =   ExpenseCategory::where('id', $request->id)->withTrashed()->firstOrFail();
        $category->deleted_at = null;
        $category->save();

        Toastr::success('Expense Category successfully Restore', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->back();
    }

    public function department()
    {
        return view('backend.trash.departments',[
            'departments' => Department::where('deleted_at', '!=', NULL)->withTrashed()->get()
        ]);
    }

    public function departmentRestore(Request $request)
    {
        $department =  Department::where('id', $request->id)->withTrashed()->firstOrFail();
        $department->deleted_at = null;
        $department->save();

        Toastr::success('Department successfully Restore', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->back();
    }

    public function designation()
    {
        return view('backend.trash.designations',[
            'designations' => Designation::where('deleted_at', '!=', NULL)->withTrashed()->get()
        ]);
    }

    public function designationRestore(Request $request)
    {
        $designation =  Designation::where('id', $request->id)->withTrashed()->firstOrFail();
        $designation->deleted_at = null;
        $designation->save();

        Toastr::success('Designation successfully Restore', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->back();
    }

    public function branches()
    {
        return view('backend.trash.branches',[
            'branches' => Branch::where('deleted_at', '!=', NULL)->withTrashed()->get()
        ]);
    }
    public function branchRestore(Request $request)
    {
        $branch =  Branch::where('id', $request->id)->withTrashed()->firstOrFail();
        $branch->deleted_at = null;
        $branch->save();

        Toastr::success('Branch successfully Restore', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->back();
    }


}
