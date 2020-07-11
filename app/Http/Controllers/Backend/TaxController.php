<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\TaxRequest;
use App\Models\Tax;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->can('manage_tax')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $data['taxes'] = Tax::orderBy('id', 'DESC')->get();
        return view('backend.tax.index', $data);
    }


    public function taxes()
    {
        if (!Auth::user()->can('manage_tax')) {
            return redirect('home')->with(denied());
        } // end permission checking

        return response(Tax::orderBy('id', 'DESC')->get());
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
    public function store(TaxRequest $request)
    {
        if (!Auth::user()->can('manage_tax')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $tax = new Tax();
        $tax->title = $request->tax['title'];
        $tax->value = $request->tax['value'];
        $tax->save();
        return response($tax);
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
    public function update(TaxRequest $request, $id)
    {
        if (!Auth::user()->can('manage_tax')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $tax = Tax::findOrFail($id);
        $tax->title = $request->tax['title'];
        $tax->value = $request->tax['value'];
        $tax->save();
        return response()->json(['success', 'Tax has been updated'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->can('manage_tax')) {
            return redirect('home')->with(denied());
        } // end permission checking

        Tax::destroy($id);
        return response()->json(['success', 'Tax Deleted'], 200);
    }
}
