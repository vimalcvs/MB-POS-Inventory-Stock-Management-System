<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\DesignationRequest;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->can('manage_designation')) {
            return redirect('home')->with(denied());
        } // end permission checking

        return view('backend.designation.index',[
            'designations' => Designation::orderBy('id', 'DESC')->get()
        ]);
    }

    public function designations()
    {
        return response(Designation::orderBy('id', 'DESC')->get());
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
    public function store(DesignationRequest $request)
    {
        if (!Auth::user()->can('manage_designation')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $designation = new Designation();
        $designation->title = $request->designation['title'];
        $designation->save();
        return response($designation);
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
    public function update(DesignationRequest $request, $id)
    {
        if (!Auth::user()->can('manage_designation')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $designation = Designation::findOrFail($id);
        $designation->title = $request->designation['title'];
        $designation->save();
        return response()->json(['success', 'Designation has been updated'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->can('manage_designation')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $designation = Designation::findOrFail($id);
        if ($designation->employee->count() > 0){
            return response()->json(['error', 'You can not delete this department'], 421);
        }else{
            Designation::destroy($id);
            return response()->json(['success', 'Designation Deleted'], 200);
        }
    }
}
