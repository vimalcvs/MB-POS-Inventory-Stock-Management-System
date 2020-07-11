<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->can('manage_category')) {
            return redirect('home')->with(denied());
        } // end permission checking

        return view('backend.category.index',[
            'categories' => Category::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->can('manage_category')) {
            return redirect('home')->with(denied());
        } // end permission checking

        return view('backend.category.create',[
            'categories' => Category::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        if (!Auth::user()->can('manage_category')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $category = new Category();
        $category->title = $request->category['title'];
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
        if (!Auth::user()->can('manage_category')) {
            return redirect('home')->with(denied());
        } // end permission checking

        return view('backend.category.edit',[
            'category' => Category::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        if (!Auth::user()->can('manage_category')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $category = Category::findOrFail($id);
        $category->title = $request->category['title'];
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
        if (!Auth::user()->can('manage_category')) {
            return redirect('home')->with(denied());
        } // end permission checking


        Category::destroy($id);
        return response()->json(['success', 'Category has been deleted successfully']);
    }
}
