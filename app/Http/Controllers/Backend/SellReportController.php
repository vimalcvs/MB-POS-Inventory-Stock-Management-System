<?php

namespace App\Http\Controllers\Backend;

use App\Models\Branch;
use App\Models\Customer;
use App\Models\Sell;
use App\Models\Product;
use App\Models\SellProduct;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;
use Auth;

class SellReportController extends Controller
{

    /**
     * Sells Summary Reports
     */
    public function sellsSummary()
    {
        if (!Auth::user()->can('view_sells_report')) {
            return redirect('home')->with(denied());
        } // end permission checking

        if (Auth::user()->can('access_to_all_branch')){
            $sells = Sell::where('sell_date', '>', Carbon::now()->subDay(30))->orderBy('sell_date', 'DESC')->get()->groupBy(function($data) {
                return Carbon::parse($data->sell_date)->format('Y-m-d');
            });
        }else{
            $sells = Sell::where('branch_id', auth()->user()->employee->branch_id)->where('sell_date', '>', Carbon::now()->subDay(30))->orderBy('sell_date', 'DESC')->get()->groupBy(function($data) {
                return Carbon::parse($data->sell_date)->format('Y-m-d');
            });
        }

        return view('backend.report.sell.summary.index',[
            'branches' => Branch::orderBy('id', 'DESC')->get(),
            'sells' => $sells
        ]);
    }

    public function sellsSummaryFilter(Request $request)
    {
        if (!Auth::user()->can('view_sells_report')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $sells=  $this->sellsSummaryFilterQuery($request);
        return view('backend.report.sell.summary.filter-result',[
            'branches' => Branch::orderBy('id', 'DESC')->get(),
            'sells' => $sells
        ]);
    }

    public function sellsSummaryFilterPDF(Request $request)
    {
        if (!Auth::user()->can('view_sells_report')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $sells=  $this->sellsSummaryFilterQuery($request);
        $filter_by = $this->getFilterByDataTitle($request);

        $random_string = str_random(10);
        $pdf = PDF::loadView('backend.pdf.reports.sells.sell-summary', compact('sells', 'request', 'filter_by'))->setPaper('a4');
        $pdf->save('pdf/reports/sells/' . 'sells-summary-' . Carbon::now()->format('Y-m-d') . '-'. $random_string . '.pdf');


        if ($request->action_type == 'download'){
            return $pdf->download('sells-summary-' . Carbon::now()->format('Y-m-d') . '-'. $random_string . '.pdf');
        }else{
            return redirect('pdf/reports/sells/' . 'sells-summary-' . Carbon::now()->format('Y-m-d') . '-'. $random_string .'.pdf');
        }
    }


    /**
     * Sells Statistics Reports
     */

    public function sellsStatistics()
    {
        if (!Auth::user()->can('view_sells_report')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $sell_info = [];
        $key = 0;
        for ($i=30; $i >= 0 ; $i--)
        {
            $date_info = Carbon::now()->subDay($i)->format('Y-m-d');
            $sell_info[$key]['sell_date'] = $date_info;
            if (Auth::user()->can('access_to_all_branch')){
                $sell_info[$key]['total_sell_amount'] = Sell::where('sell_date', $date_info)->sum('grand_total_price');
            }else{
                $sell_info[$key]['total_sell_amount'] = Sell::where('branch_id', auth()->user()->employee->branch_id)->where('sell_date', $date_info)->sum('grand_total_price');
            }
            $key++;
        }



        return view('backend.report.sell.statistics.index',[
            'branches' => Branch::orderBy('id', 'DESC')->get(),
            'sell_info' => $sell_info
        ]);
    }

    public function sellsStatisticsFilter(Request $request){
        if (!Auth::user()->can('view_sells_report')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $sell_info = $this->sellsStatisticsFilterQuery($request);
        return view('backend.report.sell.statistics.filter-result',[
            'branches' => Branch::orderBy('id', 'DESC')->get(),
            'sell_info' => $sell_info
        ]);
    }

    public function sellsStatisticsFilterPDF(Request $request){
        if (!Auth::user()->can('view_sells_report')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $sell_info = $this->sellsStatisticsFilterQuery($request);

        $random_string = str_random(10);
        $pdf = PDF::loadView('backend.pdf.reports.sells.statistics', compact('sell_info'))->setPaper('a4');
        $pdf->save('pdf/reports/sells/' . 'sells-statistics-' . Carbon::now()->format('Y-m-d') . '-'. $random_string . '.pdf');


        if ($request->action_type == 'download'){
            return $pdf->download('statistics-' . Carbon::now()->format('Y-m-d') . '-'. $random_string . '.pdf');
        }else{
            return redirect('pdf/reports/sells/' . 'sells-statistics-' . Carbon::now()->format('Y-m-d') . '-'. $random_string .'.pdf');
        }
    }

    public function lastDynamicDaysSellsStatistics($days){
        if (!Auth::user()->can('view_sells_report')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $sell_info = [];
        $key = 0;
        for ($i=$days; $i >= 0 ; $i--)
        {
            $number_of_day = $i + 1;
            $date_info = Carbon::now()->subDay($number_of_day)->format('Y-m-d');
            $sell_info[$key]['sell_date'] = $date_info;
            if (Auth::user()->can('access_to_all_branch')){
                $sell_info[$key]['total_sell_amount'] = Sell::where('sell_date', $date_info)->sum('grand_total_price');
            }else{
                $sell_info[$key]['total_sell_amount'] = Sell::where('branch_id', auth()->user()->employee->branch_id)->where('sell_date', $date_info)->sum('grand_total_price');
            }
            $key++;
        }

        return view('backend.report.sell.statistics.dynamic-days',[
            'branches' => Branch::orderBy('id', 'DESC')->get(),
            'days' => $days,
            'sell_info' => $sell_info
        ]);
    }

    public function lastDynamicDaysSellsStatisticsPDF($days, $action_type){

        if (!Auth::user()->can('view_sells_report')) {
            return redirect('home')->with(denied());
        } // end permission checking


       $sell_info = $this->lastDynamicDaysSellsStatisticsQuery($days);

        $random_string = str_random(10);
        $pdf = PDF::loadView('backend.pdf.reports.sells.statistics', compact('sell_info'))->setPaper('a4');
        $pdf->save('pdf/reports/sells/' . 'sells-statistics-' . Carbon::now()->format('Y-m-d') . '-'. $random_string . '.pdf');


        if ($action_type == 'download'){
            return $pdf->download('statistics-' . Carbon::now()->format('Y-m-d') . '-'. $random_string . '.pdf');
        }else{
            return redirect('pdf/reports/sells/' . 'sells-statistics-' . Carbon::now()->format('Y-m-d') . '-'. $random_string .'.pdf');
        }

    }



    /**
     * Product Wise Sells Reports
     */

    public function productWise(){
        if (!Auth::user()->can('view_sells_report')) {
            return redirect('home')->with(denied());
        } // end permission checking


        if (Auth::user()->can('access_to_all_branch')){
          $sell_products =   SellProduct::get()->groupBy('product_id');
        }else{
          $sell_products =   SellProduct::where('branch_id', auth()->user()->employee->branch_id)->get()->groupBy('product_id');
        }
        return view('backend.report.sell.product-wise.index',[
            'branches' => Branch::orderBy('id', 'DESC')->get(),
            'products' => Product::orderBy('title')->get(),
            'sell_products' => $sell_products,
        ]);
    }

    public function productWiseFilter(Request $request){
        if (!Auth::user()->can('view_sells_report')) {
            return redirect('home')->with(denied());
        } // end permission checking



        $sell_products =  $this->productWiseFilterQuery($request);
        return view('backend.report.sell.product-wise.filter-result',[
            'branches' => Branch::orderBy('id', 'DESC')->get(),
            'products' => Product::orderBy('title')->get(),
            'sell_products' => $sell_products
        ]);
    }

    public function productWiseFilterPDF(Request $request){
        if (!Auth::user()->can('view_sells_report')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $sell_products =  $this->productWiseFilterQuery($request);
        $filter_by = $this->getFilterByDataTitle($request);

        $random_string = str_random(10);
        $pdf = PDF::loadView('backend.pdf.reports.sells.product-wise-sell-report', compact('sell_products', 'filter_by'))->setPaper('a4');
        $pdf->save('pdf/reports/sells/' . 'product-wise-sell-report-' . Carbon::now()->format('Y-m-d') . '-'. $random_string . '.pdf');


        if ($request->action_type == 'download'){
            return $pdf->download('product-wise-sell-report-' . Carbon::now()->format('Y-m-d') . '-'. $random_string . '.pdf');
        }else{
            return redirect('pdf/reports/sells/' . 'product-wise-sell-report-' . Carbon::now()->format('Y-m-d') . '-'. $random_string .'.pdf');
        }
    }


    /**
     * Sells Reports
     */

    public function sells(){
        if (!Auth::user()->can('view_sells_report')) {
            return redirect('home')->with(denied());
        } // end permission checking

        if (Auth::user()->can('access_to_all_branch')){
            $sells =  Sell::orderBy('id', 'DESC')->paginate(30);
        }else{
           $sells =  Sell::where('branch_id', auth()->user()->employee->branch_id)->orderBy('id', 'DESC')->paginate(30);
        }

        return view('backend.report.sell.sells.sells',[
            'sells' => $sells,
            'customers' => Customer::orderBy('id', 'DESC')->get(),
            'branches' => Branch::orderBy('id', 'DESC')->get(),
        ]);
    }

    public function sellsFilter(Request $request){

        if (!Auth::user()->can('view_sells_report')) {
            return redirect('home')->with(denied());
        } // end permission checking



        $sells = $this->sellsFilterQuery($request);
        return view('backend.report.sell.sells.sells-filter-result',[
            'sells' => $sells,
            'customers' => Customer::orderBy('id', 'DESC')->get(),
            'branches' => Branch::orderBy('id', 'DESC')->get(),
        ]);
    }

    public function sellsFilterPDF(Request $request){
        if (!Auth::user()->can('view_sells_report')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $sells = $this->sellsFilterQuery($request);
        $filter_by = $this->getFilterByDataTitle($request);

        $random_string = str_random(10);
        $pdf = PDF::loadView('backend.pdf.reports.sells.sells', compact('sells', 'filter_by'))->setPaper('a4');
        $pdf->save('pdf/reports/sells/' . 'sells-report-' . Carbon::now()->format('Y-m-d') . '-'. $random_string . '.pdf');


        if ($request->action_type == 'download'){
            return $pdf->download('sells-report-' . Carbon::now()->format('Y-m-d') . '-'. $random_string . '.pdf');
        }else{
            return redirect('pdf/reports/sells/' . 'sells-report-' . Carbon::now()->format('Y-m-d') . '-'. $random_string .'.pdf');
        }
    }




    /**
     * Private functions for this controller
     */
    private function getFilterByDataTitle($request){
        $start_date = $request->start_date ? $request->start_date : Sell::oldest()->pluck('sell_date')->first();
        $end_date = $request->end_date ? $request->end_date : Sell::latest()->pluck('sell_date')->first();

        if ($request->branch_id != ''){
            $branch =  Branch::findOrFail($request->branch_id);
            $branch_name = $branch->title;
        }else{
            $branch_name = 'All';
        }

        if ($request->product_id != ''){
            $product =  Product::findOrFail($request->product_id);
            $product_name = $product->title;
        }else{
            $product_name = 'All Products';
        }

        if ($request->by_duration == 'Y-m-d'){
            $duration_type = 'Daily';
        }elseif ($request->by_duration == 'Y-W'){
            $duration_type = 'Weekly';
        }elseif ($request->by_duration == 'Y-M'){
            $duration_type = 'Monthly';
        }else{
            $duration_type = 'Yearly';
        }

        $filter_by = [];
        $filter_by['start_date'] = Carbon::parse($start_date)->format(get_option('app_date_format'));
        $filter_by['end_date'] = Carbon::parse($end_date)->format(get_option('app_date_format'));
        $filter_by['branch_name'] = $branch_name;
        $filter_by['duration_type'] = $duration_type;
        $filter_by['product_name'] = $product_name;

        return $filter_by;
    }

    private function sellsSummaryFilterQuery($request)
    {
        $branch_id = $request->branch_id ? [$request->branch_id] : Sell::select('branch_id')->distinct()->get();
        $start_date = $request->start_date ? $request->start_date : Sell::oldest()->pluck('sell_date')->first();
        $end_date = $request->end_date ? $request->end_date : Sell::latest()->pluck('sell_date')->first();

        return $sells = Sell::whereIn('branch_id', $branch_id)
            ->whereBetween('sell_date', [$start_date, $end_date])
            ->get()
            ->groupBy(function($data) use ($request) {
                return Carbon::parse($data->sell_date)->format($request->by_duration);
            });
    }

    private function sellsFilterQuery($request)
    {
        $branch_id = $request->branch_id ? [$request->branch_id] : Sell::select('branch_id')->distinct()->get();
        $start_date = $request->start_date ? $request->start_date : SellProduct::oldest()->pluck('sell_date')->first();
        $end_date = $request->end_date ? $request->end_date : SellProduct::latest()->pluck('sell_date')->first();

       return $sells = Sell::whereIn('branch_id', $branch_id)
            ->whereBetween('sell_date', [$start_date, $end_date])
            ->get();
    }

    private function productWiseFilterQuery(Request $request)
    {
        $product_id = $request->product_id ? [$request->product_id] : SellProduct::select('product_id')->distinct()->get();
        $sell_id_from_branch_id = $request->branch_id ? Sell::where('branch_id', $request->branch_id)->select('id')->get() : Sell::select('id')->get();
        $start_date = $request->start_date ? $request->start_date : SellProduct::oldest()->pluck('sell_date')->first();
        $end_date = $request->end_date ? $request->end_date : SellProduct::latest()->pluck('sell_date')->first();

        return $sell_products = SellProduct::whereIn('product_id', $product_id)
            ->whereIn('sell_id', $sell_id_from_branch_id)
            ->whereBetween('sell_date', [$start_date, $end_date])
            ->get()->groupBy('product_id');
    }

    private function sellsStatisticsFilterQuery(Request $request)
    {
        $branch_id = $request->branch_id ? [$request->branch_id] : Sell::select('branch_id')->distinct()->get();

        if ($request->search_type == 'month'){
            $start_date = Carbon::parse($request->month)->startOfMonth($request->month)->format('Y-m-d');
            $end_date = Carbon::parse($request->month)->endOfMonth($request->month)->format('Y-m-d');

            $sell_info = [];
            foreach (CarbonPeriod::create($start_date, $end_date) as $key => $date) {
                $sell_info[$key]['sell_date'] = $date->format('Y-m-d');
                $sell_info[$key]['total_sell_amount'] = Sell::whereIn('branch_id', $branch_id)
                    ->where('sell_date', $date->format('Y-m-d'))
                    ->sum('grand_total_price');
            }
        }else{
            $year = $request->year ? $request->year : Carbon::now()->format('Y');
            $sell_info = [];
            for ($i=0; $i < 12 ; $i++)
            {
                if ($i == 0){
                    $month_name = 'January';
                    $total_sell_amount = Sell::whereYear('sell_date', '=', $year)
                        ->whereIn('branch_id', $branch_id)
                        ->whereMonth('sell_date', '=', '01')
                        ->sum('grand_total_price');
                }elseif ($i == 1){
                    $month_name = 'February';
                    $total_sell_amount = Sell::whereYear('sell_date', '=', $year)
                        ->whereIn('branch_id', $branch_id)
                        ->whereMonth('sell_date', '=', '02')
                        ->sum('grand_total_price');
                }elseif ($i == 2){
                    $month_name = 'March';
                    $total_sell_amount = Sell::whereYear('sell_date', '=', $year)
                        ->whereIn('branch_id', $branch_id)
                        ->whereMonth('sell_date', '=', '03')
                        ->sum('grand_total_price');
                }elseif ($i == 3){
                    $month_name = 'April';
                    $total_sell_amount = Sell::whereYear('sell_date', '=', $year)
                        ->whereIn('branch_id', $branch_id)
                        ->whereMonth('sell_date', '=', '04')
                        ->sum('grand_total_price');
                }elseif ($i == 4){
                    $month_name = 'May';
                    $total_sell_amount = Sell::whereYear('sell_date', '=', $year)
                        ->whereIn('branch_id', $branch_id)
                        ->whereMonth('sell_date', '=', '05')
                        ->sum('grand_total_price');
                }elseif ($i == 5){
                    $month_name = 'June';
                    $total_sell_amount = Sell::whereYear('sell_date', '=', $year)
                        ->whereIn('branch_id', $branch_id)
                        ->whereMonth('sell_date', '=', '06')
                        ->sum('grand_total_price');
                }elseif ($i == 6){
                    $month_name = 'July';
                    $total_sell_amount = Sell::whereYear('sell_date', '=', $year)
                        ->whereIn('branch_id', $branch_id)
                        ->whereMonth('sell_date', '=', '07')
                        ->sum('grand_total_price');
                }elseif ($i == 7){
                    $month_name = 'August';
                    $total_sell_amount = Sell::whereYear('sell_date', '=', $year)
                        ->whereIn('branch_id', $branch_id)
                        ->whereMonth('sell_date', '=', '08')
                        ->sum('grand_total_price');
                }elseif ($i == 8){
                    $month_name = 'September';
                    $total_sell_amount = Sell::whereYear('sell_date', '=', $year)
                        ->whereIn('branch_id', $branch_id)
                        ->whereMonth('sell_date', '=', '09')
                        ->sum('grand_total_price');
                }elseif ($i == 9){
                    $month_name = 'October';
                    $total_sell_amount = Sell::whereYear('sell_date', '=', $year)
                        ->whereIn('branch_id', $branch_id)
                        ->whereMonth('sell_date', '=', '10')
                        ->sum('grand_total_price');
                }elseif ($i == 10){
                    $month_name = 'November';
                    $total_sell_amount = Sell::whereYear('sell_date', '=', $year)
                        ->whereIn('branch_id', $branch_id)
                        ->whereMonth('sell_date', '=', '11')
                        ->sum('grand_total_price');
                }elseif ($i == 11){
                    $month_name = 'December';
                    $total_sell_amount = Sell::whereYear('sell_date', '=', $year)
                        ->whereIn('branch_id', $branch_id)
                        ->whereMonth('sell_date', '=', '12')
                        ->sum('grand_total_price');
                }

                $sell_info[$i]['sell_date'] = $month_name;
                $sell_info[$i]['total_sell_amount'] = $total_sell_amount;
            }
        }

        return $sell_info;
    }

    private function lastDynamicDaysSellsStatisticsQuery($days){
        $sell_info = [];
        for ($i=0; $i < $days ; $i++)
        {
            $number_of_day = $i + 1;
            $date_info = Carbon::now()->subDay($number_of_day)->format('Y-m-d');
            $sell_info[$i]['sell_date'] = $date_info;
            $sell_info[$i]['total_sell_amount'] = Sell::where('sell_date', $date_info)->sum('grand_total_price');
        }

        return $sell_info;
    }
}
