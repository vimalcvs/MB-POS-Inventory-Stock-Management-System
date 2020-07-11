<?php

namespace App\Http\Controllers\Backend;

use App\Models\Branch;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sell;
use App\Models\SellProduct;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Toastr;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->can('manage_sell_invoice')) {
            return redirect('home')->with(denied());
        } // end permission checking

        if (Auth::user()->can('access_to_all_branch')){
            $sells = Sell::orderBy('id', 'DESC')->paginate(50);
        }else{
            $sells = Sell::where('branch_id', auth()->user()->employee->branch_id)->orderBy('id', 'DESC')->paginate(50);
        }
        return view('backend.sell.index', [
            'sells' => $sells,
            'customers' => Customer::all(),
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
        if (!Auth::user()->can('create_sell_invoice')) {
            return redirect('home')->with(denied());
        } // end permission checking


        return view('backend.sell.create',[
            'categories' => Category::orderBY('id', 'DESC')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::user()->can('create_sell_invoice')) {
            return redirect('home')->with(denied());
        } // end permission checking


        if ($request->summary['change_amount'] > 0){
            $paid_amount = $request->summary['paid_amount'] - $request->summary['change_amount'];
        }else{
            $paid_amount = $request->summary['paid_amount'];
        }

        $sell = new Sell();
        $sell->customer_id = $request->customer['id'];
        $sell->fill($request->summary);
        $sell->paid_amount = $paid_amount;
        $sell->save();

        $this->storeSellProducts($request, $sell);

        $data['sell'] = Sell::where('id', $sell->id)->with('sellProducts')->with('customer')->first();
        $data['sell_date'] = Carbon::parse($sell->created_at)->format(get_option('app_date_format'). ', h:ia');
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
        if (!Auth::user()->can('manage_sell_invoice')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $sell = Sell::findOrFail($id);

        if (!Auth::user()->can('access_to_all_branch')) {
            if ($sell->branch_id != auth()->user()->employee->branch_id){
                return redirect()->back()->with(denied());
            }
        }

        return view('backend.sell.show', [
            'sell' => $sell
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
        if (!Auth::user()->can('manage_sell_invoice')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $sell = Sell::findOrFail($id);
        if (!Auth::user()->can('access_to_all_branch')) {
            if ($sell->branch_id != auth()->user()->employee->branch_id){
                return redirect()->back()->with(denied());
            }
        }

        return view('backend.sell.edit', [
            'sell' => $sell,
            'categories' => Category::orderBY('id', 'DESC')->get(),
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
        if (!Auth::user()->can('manage_sell_invoice')) {
            return redirect('home')->with(denied());
        } // end permission checking

        if ($request->summary['change_amount'] > 0){
            $paid_amount = $request->summary['paid_amount'] - $request->summary['change_amount'];
        }else{
            $paid_amount = $request->summary['paid_amount'];
        }

        $sell = Sell::findOrFail($id);
        $sell->customer_id = $request->customer['id'];
        $sell->sub_total = $request->summary['sub_total'];
        $sell->discount = $request->summary['discount'];
        $sell->grand_total_price = $request->summary['grand_total'];
        $sell->due_amount = $request->summary['due_amount'];
        $sell->paid_amount = $paid_amount;
        $sell->save();

        SellProduct::where('sell_id', $id)->delete();
        $this->storeSellProducts($request, $sell);

        $data['sell'] = Sell::where('id', $sell->id)->with('sellProducts')->with('customer')->first();
        $data['sell_date'] = Carbon::parse($sell->created_at)->format(get_option('app_date_format'). ', h:ia');
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
        Sell::destroy($id);
        Toastr::success('Sell has been successfully Deleted', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->back();
    }

    public function getSellDetails($sell_id)
    {
        if (!Auth::user()->can('manage_sell_invoice')) {
            return redirect('home')->with(denied());
        } // end permission checking

       return $sell = Sell::where('id', $sell_id)->with('sellProducts')->with('customer')->first();

    }

    public function filter(Request $request)
    {
        if (!Auth::user()->can('manage_sell_invoice')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $invoice_id = $request->invoice_id ? [$request->invoice_id] : Sell::select('invoice_id')->distinct()->get();
        $branch_id = $request->branch_id ? [$request->branch_id] : Sell::select('branch_id')->distinct()->get();
        $customer_id = $request->customer_id ? [$request->customer_id] : Sell::select('customer_id')->distinct()->get();
        $start_date = $request->start_date ? $request->start_date : Sell::oldest()->pluck('sell_date')->first();
        $end_date = $request->end_date ? $request->end_date : Sell::latest()->pluck('sell_date')->first();

        $sells = Sell::whereIn('invoice_id', $invoice_id)
            ->whereIn('branch_id', $branch_id)
            ->whereIn('customer_id', $customer_id)
            ->whereBetween('sell_date', [$start_date, $end_date])
            ->paginate(50);

        return view('backend.sell.index',[
            'sells' => $sells,
            'customers' => Customer::all(),
            'branches' => Branch::all(),
        ]);
    }

    public function pdf($sell_id, $action_type){
        if (!Auth::user()->can('manage_sell_invoice')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $sell = Sell::findOrFail(decrypt($sell_id));
        if (!Auth::user()->can('access_to_all_branch')) {
            if ($sell->branch_id != auth()->user()->employee->branch_id){
                return redirect()->back()->with(denied());
            }
        }


        $pdf = PDF::loadView('backend.pdf.sell.invoice', compact('sell'))->setPaper('a4');

        if ($action_type == 1){
            return $pdf->download($sell->invoice_id . '.pdf');
        }else{
            $pdf->save('pdf/sell/' . $sell->invoice_id . '.pdf');
            return redirect('pdf/sell/' . $sell->invoice_id .'.pdf');
        }
    }

    public function printInvoice($sell_id){
        $sell = Sell::findOrFail($sell_id);
        $pdf = PDF::loadView('backend.pdf.sell.invoice', compact('sell'))->setPaper('a4');
        $pdf->save('pdf/sell/' . $sell->invoice_id . '.pdf');
        return redirect('pdf/sell/' . $sell->invoice_id .'.pdf');
    }

    private function storeSellProducts($request, $sell)
    {
        foreach ($request->carts as $cart_product) {
            $sell_product = new SellProduct();
            $sell_product->sell_id = $sell->id;
            $sell_product->product_id = $cart_product['id'];
            $sell_product->sell_date = $sell->sell_date;
            $sell_product->branch_id = $sell->branch_id;
            $sell_product->fill($cart_product);
            $sell_product->save();
        }
    }
}
