<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\SupplierRequest;
use App\Models\Branch;
use App\Models\PaymentToSupplier;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Toastr;
use File;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->can('manage_supplier')) {
            return redirect('home')->with(denied());
        } // end permission checking

        return view('backend.supplier.index',[
            'suppliers' => Supplier::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->can('manage_supplier')) {
            return redirect('home')->with(denied());
        } // end permission checking


        return view('backend.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {
        if (!Auth::user()->can('manage_supplier')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $supplier = new Supplier();
        $supplier->fill($request->all());
        if($request->hasFile('logo')){
            $supplier->logo = $request->logo->move('uploads/supplier/', str_random(20) . '.' . $request->logo->extension());;
        }
        $supplier->save();
        Toastr::success('Supplier successfully created', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->route('supplier.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Auth::user()->can('manage_supplier')) {
            return redirect('home')->with(denied());
        } // end permission checking

        if (Auth::user()->can('access_to_all_branch')) {
            $purchases = Purchase::where('supplier_id', $id)->paginate(50);
        }else{
            $purchases = Purchase::where('branch_id', auth()->user()->employee->branch_id)->where('supplier_id', $id)->paginate(50);
        }

        $supplier = Supplier::findOrFail($id);
        $branches = Branch::all();
        $purchase_by_branches = [];

        foreach ($branches as $key => $branch) {
            $purchase_by_branches[$key]['branch_name'] = $branch->title;
            $purchase_by_branches[$key]['total_purchase'] = Purchase::where('supplier_id', $id)->where('branch_id', $branch->id)->get();
            $purchase_by_branches[$key]['payment'] = PaymentToSupplier::where('supplier_id', $id)->where('branch_id', $branch->id)->get();
        }


        return view('backend.supplier.show',[
            'supplier' => $supplier,
            'purchases' => $purchases,
            'purchase_by_branches' => $purchase_by_branches,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->can('manage_supplier')) {
            return redirect('home')->with(denied());
        } // end permission checking


        return view('backend.supplier.edit',[
            'supplier' => Supplier::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierRequest $request, $id)
    {
        if (!Auth::user()->can('manage_supplier')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $supplier = Supplier::findOrFail($id);
        $supplier->fill($request->all());
        if($request->hasFile('logo')){
            File::delete($supplier->logo);
            $supplier->logo = $request->logo->move('uploads/supplier/', str_random(20) . '.' . $request->logo->extension());;
        }
        $supplier->save();
        Toastr::success('Supplier successfully updated', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->back();
    }

    public function changeStatus($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->status = $supplier->status == 0 ? 1 : 0;
        $supplier->save();

        Toastr::success('Supplier status changed', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
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
        if (!Auth::user()->can('manage_supplier')) {
            return redirect('home')->with(denied());
        } // end permission checking


        Supplier::destroy($id);
        Toastr::error('Supplier deleted', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->back();

    }
}
