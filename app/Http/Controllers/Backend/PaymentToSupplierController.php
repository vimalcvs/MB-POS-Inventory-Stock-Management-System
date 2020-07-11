<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\PaymentToSupplierRequest;
use App\Models\Branch;
use App\Models\PaymentToSupplier;
use App\Models\Supplier;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Toastr;

class PaymentToSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (!Auth::user()->can('manage_supplier_payment')) {
            return redirect('home')->with(denied());
        } // end permission checking

        if (Auth::user()->can('access_to_all_branch')){
            $payments = PaymentToSupplier::orderBY('id', 'DESC')->paginate(50);
        }else{
            $payments = PaymentToSupplier::where('branch_id', auth()->user()->employee->branch_id)->orderBY('id', 'DESC')->paginate(50);
        }

        return view('backend.payment.supplier.index',[
            'payments' => $payments,
            'branches' => Branch::all(),
            'suppliers' => Supplier::all(),
        ]);
    }

    public function filter(Request $request)
    {
        if (!Auth::user()->can('manage_supplier_payment')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $branch_id = $request->branch_id ? [$request->branch_id] : PaymentToSupplier::select('branch_id')->distinct()->get();
        $supplier_id = $request->supplier_id ? [$request->supplier_id] : PaymentToSupplier::select('supplier_id')->distinct()->get();
        $start_date = $request->start_date ? $request->start_date : PaymentToSupplier::oldest()->pluck('payment_date')->first();
        $end_date = $request->end_date ? $request->end_date : PaymentToSupplier::latest()->pluck('payment_date')->first();

        $payments = PaymentToSupplier::whereIn('branch_id', $branch_id)
            ->whereIn('supplier_id', $supplier_id)
            ->whereBetween('payment_date', [$start_date, $end_date])
            ->orderBY('id', 'DESC')
            ->get();

        return view('backend.payment.supplier.filter',[
            'payments' => $payments,
            'branches' => Branch::all(),
            'suppliers' => Supplier::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->can('manage_supplier_payment')) {
            return redirect('home')->with(denied());
        } // end permission checking

        return view('backend.payment.supplier.create',[
            'suppliers' => Supplier::where('status', 1)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentToSupplierRequest $request)
    {
        if (!Auth::user()->can('manage_supplier_payment')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $payment = new PaymentToSupplier();
        $payment->fill($request->all());
        $payment->save();

        Toastr::success('Payment successfully saved', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
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
        if (!Auth::user()->can('manage_supplier_payment')) {
            return redirect('home')->with(denied());
        } // end permission checking

       $payment = PaymentToSupplier::findOrFail($id);
        if (!Auth::user()->can('access_to_all_branch')) {
            if ($payment->branch_id != auth()->user()->employee->branch_id){
                return redirect('home')->with(denied());
            }
        }

        return view('backend.payment.supplier.edit',[
            'payment' => $payment,
            'suppliers' => Supplier::all(),
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
        $payment = PaymentToSupplier::findOrFail($id);
        if (!Auth::user()->can('access_to_all_branch')) {
            if ($payment->branch_id != auth()->user()->employee->branch_id){
                return redirect('home')->with(denied());
            }
        }

        $payment->fill($request->all());
        $payment->save();

        Toastr::success('Payment successfully updated', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
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
        $payment = PaymentToSupplier::findOrFail($id);
        if (!Auth::user()->can('access_to_all_branch')) {
            if ($payment->branch_id != auth()->user()->employee->branch_id){
                return redirect('home')->with(denied());
            }
        }

        $payment->delete();

        Toastr::error('Payment successfully deleted', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->back();
    }

    public function pdf(Request $request)
    {
        $branch_id = $request->branch_id ? [$request->branch_id] : PaymentToSupplier::select('branch_id')->distinct()->get();
        $supplier_id = $request->supplier_id ? [$request->supplier_id] : PaymentToSupplier::select('supplier_id')->distinct()->get();
        $start_date = $request->start_date ? $request->start_date : PaymentToSupplier::oldest()->pluck('payment_date')->first();
        $end_date = $request->end_date ? $request->end_date : PaymentToSupplier::latest()->pluck('payment_date')->first();

        $payments = PaymentToSupplier::whereIn('branch_id', $branch_id)
            ->whereIn('supplier_id', $supplier_id)
            ->whereBetween('payment_date', [$start_date, $end_date])
            ->orderBY('id', 'DESC')
            ->get();


        if ($request->branch_id != ''){
            $branch =  Branch::findOrFail($request->branch_id);
            $branch_name = $branch->title;
        }else{
            $branch_name = 'All';
        }

        if ($request->supplier_id != ''){
            $supplier =  Supplier::findOrFail($request->supplier_id);
            $supplier_name = $supplier->company_name;
        }else{
            $supplier_name = 'All';
        }


        $filter_by = [];
        $filter_by['branch_name'] = $branch_name;
        $filter_by['supplier_name'] = $supplier_name;
        $filter_by['start_date'] = Carbon::parse($start_date)->format(get_option('app_date_format'));
        $filter_by['end_date'] = Carbon::parse($end_date)->format(get_option('app_date_format'));;

        $random_string = str_random(10);
        $pdf = PDF::loadView('backend.pdf.payment.supplier', compact('payments', 'filter_by'))->setPaper('a4');

        $pdf->save('pdf/payment/supplier/' . 'payment-to-supplier-' . Carbon::now()->format('Y-m-d') . '-'. $random_string . '.pdf');
        return redirect('pdf/payment/supplier/' . 'payment-to-supplier-' . Carbon::now()->format('Y-m-d') . '-'. $random_string .'.pdf');
    }
}
