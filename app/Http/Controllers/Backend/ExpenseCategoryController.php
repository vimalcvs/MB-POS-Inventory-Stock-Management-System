<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\ExpenseCategoryRequest;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->can('manage_expense_category')) {
            return redirect('home')->with(denied());
        } // end permission checking


        return view('backend.expense-category.index',[
            'categories' => ExpenseCategory::orderBY('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseCategoryRequest $request)
    {
        if (!Auth::user()->can('manage_expense_category')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $category = new ExpenseCategory();
        $category->name = $request->category['name'];
        $category->save();
        return response($category);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseCategoryRequest $request, $id)
    {
        if (!Auth::user()->can('manage_expense_category')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $category = ExpenseCategory::findOrFail($id);
        $category->name = $request->category['name'];
        $category->save();
        return response()->json(['success', 'category Successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->can('manage_expense_category')) {
            return redirect('home')->with(denied());
        } // end permission checking


        ExpenseCategory::destroy($id);
        return response()->json(['success', 'Category deleted']);
    }
}
