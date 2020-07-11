<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->can('manage_department')) {
            return redirect('home')->with(denied());
        } // end permission checking

        return view('backend.department.index',[
            'departments' => Department::orderBY('id', 'DESC')->get()
        ]);
    }


    public function departments()
    {
        if (!Auth::user()->can('manage_department')) {
            return redirect('home')->with(denied());
        } // end permission checking

        return response(Department::orderBy('id', 'DESC')->get());
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
    public function store(DepartmentRequest $request)
    {
        if (!Auth::user()->can('manage_department')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $department = new Department();
        $department->title = $request->department['title'];
        $department->save();
        return response($department);
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
    public function update(DepartmentRequest $request, $id)
    {

        if (!Auth::user()->can('manage_department')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $department = Department::findOrFail($id);
        $department->title = $request->department['title'];
        $department->save();
        return response()->json(['success', 'Department has been updated'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->can('manage_department')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $department = Department::findOrFail($id);
        if ($department->employee->count() > 0){
            return response()->json(['error', 'You can not delete this department. this department have already '.$department->employee->count().' Employee'], 421);
        }else{
            Department::destroy($id);
            return response()->json(['success', 'Department Deleted'], 200);
        }
    }
}
