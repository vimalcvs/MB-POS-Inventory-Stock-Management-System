<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sell;
use App\Models\SellsTarget;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Toastr;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        if ($request->get('set_lang'))
        {
            session(['local' => get_option('app_language')]);
            \Illuminate\Support\Facades\App::setLocale(session()->get('local'));
            return redirect('home');
        }

        if (Auth::user()->can('access_to_all_branch')){
            $sell_of_this_month = Sell::whereMonth('sell_date', Carbon::now()->format('m-Y'))->sum('grand_total_price');
            $total_sell = Sell::sum('grand_total_price');
            $purchase_of_this_month = Purchase::whereMonth('purchase_date', Carbon::now()->format('m-Y'))->sum('total_amount');
            $total_purchase = Purchase::sum('total_amount');
        }else{
            $branch_id = auth()->user()->employee->branch_id;
            $sell_of_this_month = Sell::where('branch_id', $branch_id)->whereMonth('sell_date', Carbon::now()->format('m-Y'))->sum('grand_total_price');
            $total_sell = Sell::where('branch_id', $branch_id)->sum('grand_total_price');
            $purchase_of_this_month = Purchase::where('branch_id', $branch_id)->whereMonth('purchase_date', Carbon::now()->format('m-Y'))->sum('total_amount');
            $total_purchase = Purchase::where('branch_id', $branch_id)->sum('total_amount');
        }

        $sells_targets = SellsTarget::where('month', Carbon::now()->format('Y-m'))->get();



        $collection = collect(Product::all());

        $low_stock_products = $collection->sortBy('current_stock_quantity')->take(10);
        $trending_products = $collection->sortByDesc('total_sell_qty')->take(10);


        $last_30_days_sell = [];
        $key = 0;
        for ($i=30; $i >= 0 ; $i--)
        {
            $date_info = Carbon::now()->subDay($i)->format('Y-m-d');
            $last_30_days_sell[$key]['sell_date'] = $date_info;
            if (Auth::user()->can('access_to_all_branch')) {
                $last_30_days_sell[$key]['total_sell_amount'] = Sell::where('sell_date', $date_info)->sum('grand_total_price');
            }else{
                $last_30_days_sell[$key]['total_sell_amount'] = Sell::where('branch_id', $branch_id)->where('sell_date', $date_info)->sum('grand_total_price');
            }
            $key++;
        }


        return view('backend/dashboard',[
            'sell_of_this_month' => $sell_of_this_month,
            'total_sell' => $total_sell,
            'purchase_of_this_month' => $purchase_of_this_month,
            'total_purchase' => $total_purchase,
            'last_30_days_sell' => $last_30_days_sell,
            'sells_targets' => $sells_targets,
            'low_stock_products' => $low_stock_products->values()->all(),
            'trending_products' => $trending_products->values()->all(),
        ]);
    }



    public function forms(){
        return view('backend/forms');
    }
}
