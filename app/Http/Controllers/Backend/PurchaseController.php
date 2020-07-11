<?php

namespace App\Http\Controllers\Backend;

use App\Models\Branch;
use App\Models\PaymentToSupplier;
use App\Models\Purchase;
use App\Models\PurchasePayment;
use App\Models\PurchaseProduct;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Barryvdh\DomPDF\Facade as PDF;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->can('manage_purchase_invoice')) {
            return redirect('home')->with(denied());
        } // end permission checking


        if (Auth::user()->can('access_to_all_branch')) {
            $purchases = Purchase::orderBy('id', 'DESC')->paginate(50);
        }else{
            $purchases = Purchase::where('branch_id', auth()->user()->employee->branch_id)->orderBy('id', 'DESC')->paginate(50);
        }


        return view('backend.purchase.index',[
            'purchases' => $purchases,
            'suppliers' => Supplier::all(),
            'branches' => Branch::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->can('create_purchase_invoice')) {
            return redirect('home')->with(denied());
        } // end permission checking


        return view('backend.purchase.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::user()->can('create_purchase_invoice')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $purchase = new Purchase();
        $purchase->supplier_id = $request->supplier['id'];
        $purchase->total_amount = $request->summary['total_amount'];
        $purchase->paid_amount = $request->summary['paid_amount'];
        $purchase->due_amount = $request->summary['due_amount'];
        $purchase->save();

        $this->savePurchaseProducts($request, $purchase);

        if ($purchase->paid_amount > 0){
            $payment = new PaymentToSupplier();
            $payment->supplier_id = $purchase->supplier_id;
            $payment->purchase_id = $purchase->id;
            $payment->payment_date = $purchase->purchase_date;
            $payment->amount = $purchase->paid_amount;
            $payment->save();
        }

        $data['purchase'] = Purchase::where('id', $purchase->id)->with('purchaseProducts')->with('supplier')->first();
        $data['custom_purchase_date'] = Carbon::parse($purchase->created_at)->format(get_option('app_date_format'). ', h:ia');
        return response($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Auth::user()->can('manage_purchase_invoice')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $purchase = Purchase::findOrFail($id);
        if (!Auth::user()->can('access_to_all_branch')) {
            if ($purchase->branch_id != auth()->user()->employee->branch_id){
                return redirect()->back()->with(denied());
            }
        }

        return view('backend.purchase.show', [
            'purchase' => $purchase
        ]);
    }

    public function pdf($purchase_id, $action_type){
        if (!Auth::user()->can('manage_purchase_invoice')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $purchase = Purchase::findOrFail($purchase_id);
        if (!Auth::user()->can('access_to_all_branch')) {
            if ($purchase->branch_id != auth()->user()->employee->branch_id){
                return redirect()->back()->with(denied());
            }
        }

        $pdf = PDF::loadView('backend.pdf.purchase.invoice', compact('purchase'))->setPaper('a4');

        if ($action_type == 'pdf'){
            return $pdf->download($purchase->invoice_id . '.pdf');
        }else{
            $pdf->save('pdf/purchase/' . $purchase->invoice_id . '.pdf');
            return redirect('/pdf/purchase/' . $purchase->invoice_id .'.pdf');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->can('manage_purchase_invoice')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $purchase = Purchase::findOrFail($id);
        if (!Auth::user()->can('access_to_all_branch')) {
            if ($purchase->branch_id != auth()->user()->employee->branch_id){
                return redirect()->back()->with(denied());
            }
        }

        return view('backend.purchase.edit', [
            'purchase' => $purchase
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
        if (!Auth::user()->can('manage_purchase_invoice')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $purchase = Purchase::findOrFail($id);
        $purchase->supplier_id = $request->supplier['id'];
        $purchase->total_amount = $request->summary['total_amount'];
        $purchase->paid_amount = $request->summary['paid_amount'];
        $purchase->due_amount = $request->summary['due_amount'];
        $purchase->save();

        PurchaseProduct::where('purchase_id', $id)->delete();
        $this->savePurchaseProducts($request, $purchase);

        $check_payment = PaymentToSupplier::where('purchase_id', $purchase->id)->count();
        if ($check_payment > 0){
            $payment = PaymentToSupplier::where('purchase_id', $purchase->id)->first();
            $payment->amount = $purchase->paid_amount;
            $payment->save();
        }else{
            if ($purchase->paid_amount > 0){
                $payment = new PaymentToSupplier();
                $payment->supplier_id = $purchase->supplier_id;
                $payment->purchase_id = $purchase->id;
                $payment->payment_date = $purchase->purchase_date;
                $payment->amount = $purchase->paid_amount;
                $payment->save();
            }
        }

        $data = Purchase::where('id', $purchase->id)->with('purchaseProducts')->with('supplier')->first();
        $data['custom_purchase_date'] = Carbon::parse($purchase->created_at)->format(get_option('app_date_format'). ', h:ia');
        return response($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->can('manage_purchase_invoice')) {
            return redirect('home')->with(denied());
        } // end permission checking


        PurchaseProduct::where('purchase_id', $id)->delete();
        Purchase::destroy($id);
        return redirect()->back()->with('success','Purchase has been deleted successfully');
    }

    public function getPurchaseDetails($id)
    {
        return  Purchase::where('id', $id)->with('purchaseProducts')->with('supplier')->first();
    }


    public function filter(Request $request)
    {
        if (!Auth::user()->can('manage_purchase_invoice')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $invoice_id = $request->invoice_id ? [$request->invoice_id] : Purchase::select('invoice_id')->distinct()->get();
        $supplier_id = $request->supplier_id ? [$request->supplier_id] : Purchase::select('supplier_id')->distinct()->get();
        $branch_id = $request->branch_id ? [$request->branch_id] : Purchase::select('branch_id')->distinct()->get();
        $start_date = $request->start_date ? $request->start_date : Purchase::oldest()->pluck('purchase_date')->first();
        $end_date = $request->end_date ? $request->end_date : Purchase::latest()->pluck('purchase_date')->first();

        $purchases = Purchase::whereIn('invoice_id', $invoice_id)
            ->whereIn('branch_id', $branch_id)
            ->whereIn('supplier_id', $supplier_id)
            ->whereBetween('purchase_date', [$start_date, $end_date])
            ->paginate(50);

        return view('backend.purchase.filter-result',[
            'purchases' => $purchases,
            'suppliers' => Supplier::all(),
            'branches' => Branch::all(),
        ]);
    }

    private function savePurchaseProducts($request, $purchase)
    {
        foreach ($request->carts as $cart_product) {
            $purchase_product = new PurchaseProduct();
            $purchase_product->purchase_id = $purchase->id;
            $purchase_product->product_id = $cart_product['id'];
            $purchase_product->purchase_date = $purchase->purchase_date;
            $purchase_product->branch_id = $purchase->branch_id;
            $purchase_product->fill($cart_product);
            $purchase_product->save();
        }
    }
}
