<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\BranchRequest;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Toastr;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->can('manage_branch')) {
            return redirect('home')->with(denied());
        } // end permission checking

        return view('backend.branch.index',[
            'branches' => Branch::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->can('manage_branch')) {
            return redirect('home')->with(denied());
        } // end permission checking


        return view('backend.branch.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BranchRequest $request)
    {
        if (!Auth::user()->can('manage_branch')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $branch = new Branch();
        $branch->fill($request->all());
        $branch->save();

        Toastr::success('Branch successfully created', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->route('branch.index');
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
        if (!Auth::user()->can('manage_branch')) {
            return redirect('home')->with(denied());
        } // end permission checking

        return view('backend.branch.edit',[
            'branch' => Branch::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BranchRequest $request, $id)
    {
        if (!Auth::user()->can('manage_branch')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $branch = Branch::findOrFail($id);
        $branch->fill($request->all());
        $branch->save();

        Toastr::success('Branch successfully updated', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->route('branch.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->can('manage_branch')) {
            return redirect('home')->with(denied());
        } // end permission checking


        Branch::destroy($id);
        Toastr::success('Branch has been deleted', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->back();

    }
}
