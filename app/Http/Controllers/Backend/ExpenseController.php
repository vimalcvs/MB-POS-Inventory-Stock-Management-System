<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\ExpenseRequest;
use App\Models\Branch;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Toastr;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->can('manage_expense')) {
            return redirect('home')->with(denied());
        } // end permission checking

        if (Auth::user()->can('access_to_all_branch')){
            $expenses = Expense::orderBY('id', 'DESC')->paginate(50);
        }else{
            $expenses = Expense::where('branch_id', auth()->user()->employee->branch_id)->orderBY('id', 'DESC')->paginate(50);
        }

        return view('backend.expense.index',[
            'expenses' => $expenses,
            'branches' => Branch::all(),
            'expense_categories' => ExpenseCategory::all(),
        ]);
    }

    public function filter(Request $request)
    {
        if (!Auth::user()->can('manage_expense')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $expense_id = $request->expense_id ? [$request->expense_id] : Expense::select('expense_id')->distinct()->get();
        $branch_id = $request->branch_id ? [$request->branch_id] : Expense::select('branch_id')->distinct()->get();
        $expense_category_id = $request->expense_category_id ? [$request->expense_category_id] : Expense::select('expense_category_id')->distinct()->get();
        $start_date = $request->start_date ? $request->start_date : Expense::oldest()->pluck('expense_date')->first();
        $end_date = $request->end_date ? $request->end_date : Expense::latest()->pluck('expense_date')->first();

        $expenses = Expense::whereIn('expense_id', $expense_id)
            ->whereIn('branch_id', $branch_id)
            ->whereIn('expense_category_id', $expense_category_id)
            ->whereBetween('expense_date', [$start_date, $end_date])
            ->paginate(50);

        return view('backend.expense.index',[
            'expenses' => $expenses,
            'branches' => Branch::all(),
            'expense_categories' => ExpenseCategory::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->can('manage_expense')) {
            return redirect('home')->with(denied());
        } // end permission checking

        return view('backend.expense.create',[
            'branches' => Branch::all(),
            'expense_categories' => ExpenseCategory::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseRequest $request)
    {
        if (!Auth::user()->can('manage_expense')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $expense = new Expense();
        $expense->fill($request->all());
        $expense->save();

        Toastr::success('Expense successfully saved', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->can('manage_expense')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $expenses = Expense::findOrFail($id);
        if (!Auth::user()->can('access_to_all_branch')) {
            if ($expenses->branch_id != auth()->user()->employee->branch_id){
                return redirect()->back()->with(denied());
            }
        }

        return view('backend.expense.edit',[
            'expense' => $expenses,
            'branches' => Branch::all(),
            'expense_categories' => ExpenseCategory::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!Auth::user()->can('manage_expense')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $expenses = Expense::findOrFail($id);
        if (!Auth::user()->can('access_to_all_branch')) {
            if ($expenses->branch_id != auth()->user()->employee->branch_id){
                return redirect()->back()->with(denied());
            }
        }

        $expense = $expenses;
        $expense->fill($request->all());
        $expense->save();

        Toastr::success('Expense successfully updated', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->can('manage_expense')) {
            return redirect('home')->with(denied());
        } // end permission checking

        Expense::destroy($id);
        Toastr::error('Expense successfully deleted', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->back();
    }
}
