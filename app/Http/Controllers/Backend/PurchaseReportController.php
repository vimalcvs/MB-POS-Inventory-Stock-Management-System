<?php

namespace App\Http\Controllers\Backend;

use App\Models\Branch;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseProduct;
use App\Models\Sell;
use App\Models\Supplier;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Database\Eloquent\Collection;
use League\Csv\Writer;
use Schema;
use SplTempFileObject;
use Auth;

class PurchaseReportController extends Controller
{
    /**
     * Purchase Summary Reports
     */
    public function summary()
    {
        if (!Auth::user()->can('view_purchase_report')) {
            return redirect('home')->with(denied());
        } // end permission checking


        if (Auth::user()->can('access_to_all_branch')) {
            $purchases = Purchase::where('purchase_date', '>', Carbon::now()->subDay(30))->orderBy('purchase_date', 'DESC')->get()->groupBy(function($data) {
                return Carbon::parse($data->purchase_date)->format('Y-m-d');
            });
        }else{
            $purchases = Purchase::where('branch_id', auth()->user()->employee->branch_id)->where('purchase_date', '>', Carbon::now()->subDay(30))->orderBy('purchase_date', 'DESC')->get()->groupBy(function($data) {
                return Carbon::parse($data->purchase_date)->format('Y-m-d');
            });
        }


        return view('backend.report.purchase.summary.index',[
            'branches' => Branch::orderBy('id', 'DESC')->get(),
            'suppliers' => Supplier::orderBy('id', 'DESC')->get(),
            'purchases' => $purchases
        ]);
    }

    public function summaryFilter(Request $request)
    {
        if (!Auth::user()->can('view_purchase_report')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $purchases =  $this->summaryFilterQuery($request);
        return view('backend.report.purchase.summary.filter-result',[
            'branches' => Branch::orderBy('id', 'DESC')->get(),
            'suppliers' => Supplier::orderBy('id', 'DESC')->get(),
            'purchases' => $purchases
        ]);
    }

    public function summaryFilterPDF(Request $request)
    {
        if (!Auth::user()->can('view_purchase_report')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $purchases =  $this->summaryFilterQuery($request);
        $filter_by = $this->getFilterByDataTitle($request);

        $random_string = str_random(10);
        $pdf = PDF::loadView('backend.pdf.reports.purchase.purchase-summary', compact('purchases', 'filter_by'))->setPaper('a4');
        $pdf->save('pdf/reports/purchase/' . 'purchase-summary-' . Carbon::now()->format('Y-m-d') . '-'. $random_string . '.pdf');


        if ($request->action_type == 'download'){
            return $pdf->download('purchase-summary-' . Carbon::now()->format('Y-m-d') . '-'. $random_string . '.pdf');
        }else{
            return redirect('pdf/reports/purchase/' . 'purchase-summary-' . Carbon::now()->format('Y-m-d') . '-'. $random_string .'.pdf');
        }
    }



    /**
     * Purchase Statistics Reports
     */

    public function statistics()
    {
        if (!Auth::user()->can('view_purchase_report')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $purchase_info = [];
        $key = 0;
        for ($i=30; $i >= 0 ; $i--)
        {
            $date_info = Carbon::now()->subDay($i)->format('Y-m-d');
            $purchase_info[$key]['purchase_date'] = $date_info;
            if (Auth::user()->can('access_to_all_branch')) {
                $purchase_info[$key]['total_purchase_amount'] = Purchase::where('purchase_date', $date_info)->sum('total_amount');
            }else{
                $purchase_info[$key]['total_purchase_amount'] = Purchase::where('branch_id', auth()->user()->employee->branch_id)
                    ->where('purchase_date', $date_info)
                    ->sum('total_amount');
            }
            $key++;
        }

        return view('backend.report.purchase.statistics.index',[
            'branches' => Branch::orderBy('id', 'DESC')->get(),
            'purchase_info' => $purchase_info
        ]);
    }

    public function statisticsFilter(Request $request){
        if (!Auth::user()->can('view_purchase_report')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $purchase_info = $this->statisticsFilterQuery($request);
        return view('backend.report.purchase.statistics.filter-result',[
            'branches' => Branch::orderBy('id', 'DESC')->get(),
            'purchase_info' => $purchase_info
        ]);
    }

    public function statisticsFilterPDF(Request $request)
    {
        if (!Auth::user()->can('view_purchase_report')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $purchase_info = $this->statisticsFilterQuery($request);

        $random_string = str_random(10);
        $pdf = PDF::loadView('backend.pdf.reports.purchase.statistics', compact('purchase_info'))->setPaper('a4');
        $pdf->save('pdf/reports/purchase/' . 'purchase-statistics-' . Carbon::now()->format('Y-m-d') . '-'. $random_string . '.pdf');


        if ($request->action_type == 'download'){
            return $pdf->download('purchase-statistics-' . Carbon::now()->format('Y-m-d') . '-'. $random_string . '.pdf');
        }else{
            return redirect('pdf/reports/purchase/' . 'purchase-statistics-' . Carbon::now()->format('Y-m-d') . '-'. $random_string .'.pdf');
        }
    }

    public function lastDynamicDaysStatistics($days)
    {
        if (!Auth::user()->can('view_purchase_report')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $purchase_info = $this->lastDynamicDaysStatisticsQuery($days);
        return view('backend.report.purchase.statistics.dynamic-days',[
            'branches' => Branch::orderBy('id', 'DESC')->get(),
            'days' => $days,
            'purchase_info' => $purchase_info
        ]);
    }

    public function lastDynamicDaysStatisticsPDF($days, $action_type)
    {
        if (!Auth::user()->can('view_purchase_report')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $purchase_info = $this->lastDynamicDaysStatisticsQuery($days);

        $random_string = str_random(10);
        $pdf = PDF::loadView('backend.pdf.reports.purchase.statistics', compact('purchase_info'))->setPaper('a4');
        $pdf->save('pdf/reports/purchase/' . 'purchase-statistics-' . Carbon::now()->format('Y-m-d') . '-'. $random_string . '.pdf');


        if ($action_type == 'download'){
            return $pdf->download('statistics-' . Carbon::now()->format('Y-m-d') . '-'. $random_string . '.pdf');
        }else{
            return redirect('pdf/reports/purchase/' . 'purchase-statistics-' . Carbon::now()->format('Y-m-d') . '-'. $random_string .'.pdf');
        }

    }

    /**
     * Purchase Product Wise Reports
     */

    public function productWise()
    {
        if (!Auth::user()->can('view_purchase_report')) {
            return redirect('home')->with(denied());
        } // end permission checking

        if (Auth::user()->can('access_to_all_branch')) {
           $purchase_products = PurchaseProduct::get()->groupBy('product_id');
        }else{
            $purchase_products = PurchaseProduct::where('branch_id', auth()->user()->employee->branch_id)->get()->groupBy('product_id');
        }


        return view('backend.report.purchase.product-wise.index',[
            'branches' => Branch::orderBy('id', 'DESC')->get(),
            'products' => Product::orderBy('title')->get(),
            'purchase_products' => $purchase_products,
        ]);
    }

    public function productWiseFilter(Request $request)
    {
        if (!Auth::user()->can('view_purchase_report')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $purchase_products =  $this->productWiseFilterQuery($request);
        return view('backend.report.purchase.product-wise.filter-result',[
            'branches' => Branch::orderBy('id', 'DESC')->get(),
            'products' => Product::orderBy('title')->get(),
            'purchase_products' => $purchase_products
        ]);
    }

    public function productWiseFilterPDF(Request $request)
    {
        if (!Auth::user()->can('view_purchase_report')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $purchase_products =  $this->productWiseFilterQuery($request);
        $filter_by = $this->getFilterByDataTitle($request);

        $random_string = str_random(10);
        $pdf = PDF::loadView('backend.pdf.reports.purchase.product-wise-purchase', compact('purchase_products', 'filter_by'))->setPaper('a4');
        $pdf->save('pdf/reports/purchase/' . 'product-wise-purchase-' . Carbon::now()->format('Y-m-d') . '-'. $random_string . '.pdf');


        if ($request->action_type == 'download'){
            return $pdf->download('product-wise-purchase-' . Carbon::now()->format('Y-m-d') . '-'. $random_string . '.pdf');
        }else{
            return redirect('pdf/reports/purchase/' . 'product-wise-purchase-' . Carbon::now()->format('Y-m-d') . '-'. $random_string .'.pdf');
        }
    }


    /**
     * Purchase  Reports
     */

    public function purchases()
    {
        if (!Auth::user()->can('view_purchase_report')) {
            return redirect('home')->with(denied());
        } // end permission checking


        if (Auth::user()->can('access_to_all_branch')) {
           $purchases =  Purchase::orderBy('id', 'DESC')->paginate(50);
        }else{
            $purchases =  Purchase::where('branch_id', auth()->user()->employee->branch_id)->orderBy('id', 'DESC')->paginate(50);
        }
        return view('backend.report.purchase.purchases.index',[
            'purchases' => $purchases,
            'suppliers' => Supplier::orderBy('id', 'DESC')->get(),
            'branches' => Branch::orderBy('id', 'DESC')->get(),
        ]);
    }

    public function purchasesFilter(Request $request)
    {
        if (!Auth::user()->can('view_purchase_report')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $purchases = $this->purchasesFilterQuery($request);
        return view('backend.report.purchase.purchases.purchases-filter-result',[
            'purchases' => $purchases,
            'suppliers' => Supplier::orderBy('id', 'DESC')->get(),
            'branches' => Branch::orderBy('id', 'DESC')->get(),
        ]);
    }

    public function purchasesFilterPDF(Request $request)
    {
        if (!Auth::user()->can('view_purchase_report')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $purchases = $this->purchasesFilterQuery($request);
        $filter_by = $this->getFilterByDataTitle($request);

        $random_string = str_random(10);
        $pdf = PDF::loadView('backend.pdf.reports.purchase.purchases', compact('purchases', 'filter_by'))->setPaper('a4');
        $pdf->save('pdf/reports/purchase/' . 'purchase-report-' . Carbon::now()->format('Y-m-d') . '-'. $random_string . '.pdf');


        if ($request->action_type == 'download'){
            return $pdf->download('purchases-report-' . Carbon::now()->format('Y-m-d') . '-'. $random_string . '.pdf');
        }else{
            return redirect('pdf/reports/purchase/' . 'purchase-report-' . Carbon::now()->format('Y-m-d') . '-'. $random_string .'.pdf');
        }
    }

    /**
     * Private functions for this controller
     */

    private function summaryFilterQuery($request)
    {
        if (!Auth::user()->can('view_purchase_report')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $supplier_id = $request->supplier_id ? [$request->supplier_id] : Purchase::select('supplier_id')->distinct()->get();
        $branch_id = $request->branch_id ? [$request->branch_id] : Purchase::select('branch_id')->distinct()->get();
        $start_date = $request->start_date ? $request->start_date : Purchase::oldest()->pluck('purchase_date')->first();
        $end_date = $request->end_date ? $request->end_date : Purchase::latest()->pluck('purchase_date')->first();

        return $purchases = Purchase::whereIn('branch_id', $branch_id)
            ->whereIn('supplier_id', $supplier_id)
            ->whereBetween('purchase_date', [$start_date, $end_date])
            ->get()
            ->groupBy(function($data) use ($request) {
                return Carbon::parse($data->purchase_date)->format($request->by_duration);
            });
    }

    private function statisticsFilterQuery(Request $request){

        $branch_id = $request->branch_id ? [$request->branch_id] : Purchase::select('branch_id')->distinct()->get();

        if ($request->search_type == 'month'){
            $start_date = Carbon::parse($request->month)->startOfMonth($request->month)->format('Y-m-d');
            $end_date = Carbon::parse($request->month)->endOfMonth($request->month)->format('Y-m-d');

            $purchase_info = [];
            foreach (CarbonPeriod::create($start_date, $end_date) as $key => $date) {
                $purchase_info[$key]['purchase_date'] = $date->format('Y-m-d');
                $purchase_info[$key]['total_purchase_amount'] = Purchase::whereIn('branch_id', $branch_id)
                    ->where('purchase_date', $date->format('Y-m-d'))
                    ->sum('total_amount');
            }
        }else{
            $year = $request->year ? $request->year : Carbon::now()->format('Y');
            $purchase_info = [];
            for ($i=0; $i < 12 ; $i++)
            {
                if ($i == 0){
                    $month_name = 'January';
                    $total_purchase_amount = Purchase::whereYear('purchase_date', '=', $year)
                        ->whereIn('branch_id', $branch_id)
                        ->whereMonth('purchase_date', '=', '01')
                        ->sum('total_amount');
                }elseif ($i == 1){
                    $month_name = 'February';
                    $total_purchase_amount = Purchase::whereYear('purchase_date', '=', $year)
                        ->whereIn('branch_id', $branch_id)
                        ->whereMonth('purchase_date', '=', '02')
                        ->sum('total_amount');
                }elseif ($i == 2){
                    $month_name = 'March';
                    $total_purchase_amount = Purchase::whereYear('purchase_date', '=', $year)
                        ->whereIn('branch_id', $branch_id)
                        ->whereMonth('purchase_date', '=', '03')
                        ->sum('total_amount');
                }elseif ($i == 3){
                    $month_name = 'April';
                    $total_purchase_amount = Purchase::whereYear('purchase_date', '=', $year)
                        ->whereIn('branch_id', $branch_id)
                        ->whereMonth('purchase_date', '=', '04')
                        ->sum('total_amount');
                }elseif ($i == 4){
                    $month_name = 'May';
                    $total_purchase_amount = Purchase::whereYear('purchase_date', '=', $year)
                        ->whereIn('branch_id', $branch_id)
                        ->whereMonth('purchase_date', '=', '05')
                        ->sum('total_amount');
                }elseif ($i == 5){
                    $month_name = 'June';
                    $total_purchase_amount = Purchase::whereYear('purchase_date', '=', $year)
                        ->whereIn('branch_id', $branch_id)
                        ->whereMonth('purchase_date', '=', '06')
                        ->sum('total_amount');
                }elseif ($i == 6){
                    $month_name = 'July';
                    $total_purchase_amount = Purchase::whereYear('purchase_date', '=', $year)
                        ->whereIn('branch_id', $branch_id)
                        ->whereMonth('purchase_date', '=', '07')
                        ->sum('total_amount');
                }elseif ($i == 7){
                    $month_name = 'August';
                    $total_purchase_amount = Purchase::whereYear('purchase_date', '=', $year)
                        ->whereIn('branch_id', $branch_id)
                        ->whereMonth('purchase_date', '=', '08')
                        ->sum('total_amount');
                }elseif ($i == 8){
                    $month_name = 'September';
                    $total_purchase_amount = Purchase::whereYear('purchase_date', '=', $year)
                        ->whereIn('branch_id', $branch_id)
                        ->whereMonth('purchase_date', '=', '09')
                        ->sum('total_amount');
                }elseif ($i == 9){
                    $month_name = 'October';
                    $total_purchase_amount = Purchase::whereYear('purchase_date', '=', $year)
                        ->whereIn('branch_id', $branch_id)
                        ->whereMonth('purchase_date', '=', '10')
                        ->sum('total_amount');
                }elseif ($i == 10){
                    $month_name = 'November';
                    $total_purchase_amount = Purchase::whereYear('purchase_date', '=', $year)
                        ->whereIn('branch_id', $branch_id)
                        ->whereMonth('purchase_date', '=', '11')
                        ->sum('total_amount');
                }elseif ($i == 11){
                    $month_name = 'December';
                    $total_purchase_amount = Purchase::whereYear('purchase_date', '=', $year)
                        ->whereIn('branch_id', $branch_id)
                        ->whereMonth('purchase_date', '=', '12')
                        ->sum('total_amount');
                }

                $purchase_info[$i]['purchase_date'] = $month_name;
                $purchase_info[$i]['total_purchase_amount'] = $total_purchase_amount;
            }
        }

        return $purchase_info;
    }

    private function lastDynamicDaysStatisticsQuery($days){

        $purchase_info = [];

        $key = 0;
        for ($i=$days; $i >= 0 ; $i--)
        {
            $date_info = Carbon::now()->subDay($i)->format('Y-m-d');
            $purchase_info[$key]['purchase_date'] = $date_info;
            if (Auth::user()->can('access_to_all_branch')) {
                $purchase_info[$key]['total_purchase_amount'] = Purchase::where('purchase_date', $date_info)->sum('total_amount');
            }else{
                $purchase_info[$key]['total_purchase_amount'] = Purchase::where('branch_id', auth()->user()->employee->branch_id)
                    ->where('purchase_date', $date_info)
                    ->sum('total_amount');
            }
            $key++;
        }

        return $purchase_info;
    }

    private function productWiseFilterQuery(Request $request)
    {
        $product_id = $request->product_id ? [$request->product_id] : PurchaseProduct::select('product_id')->distinct()->get();
        $purchase_id_from_branch_id = $request->branch_id ? Purchase::where('branch_id', $request->branch_id)->select('id')->get() : Purchase::select('id')->get();
        $start_date = $request->start_date ? $request->start_date : PurchaseProduct::oldest()->pluck('purchase_date')->first();
        $end_date = $request->end_date ? $request->end_date : PurchaseProduct::latest()->pluck('purchase_date')->first();

        return $purchase_products = PurchaseProduct::whereIn('product_id', $product_id)
            ->whereIn('purchase_id', $purchase_id_from_branch_id)
            ->whereBetween('purchase_date', [$start_date, $end_date])
            ->get()->groupBy('product_id');
    }

    private function purchasesFilterQuery($request)
    {
        $branch_id = $request->branch_id ? [$request->branch_id] : Purchase::select('branch_id')->distinct()->get();
        $supplier_id = $request->supplier_id ? [$request->supplier_id] : Purchase::select('supplier_id')->distinct()->get();
        $start_date = $request->start_date ? $request->start_date : PurchaseProduct::oldest()->pluck('purchase_date')->first();
        $end_date = $request->end_date ? $request->end_date : PurchaseProduct::latest()->pluck('purchase_date')->first();

        return $purchases = Purchase::whereIn('branch_id', $branch_id)
            ->whereIn('supplier_id', $supplier_id)
            ->whereBetween('purchase_date', [$start_date, $end_date])
            ->get();
    }

    private function getFilterByDataTitle($request){
        $start_date = $request->start_date ? $request->start_date : Purchase::oldest()->pluck('purchase_date')->first();
        $end_date = $request->end_date ? $request->end_date : Purchase::latest()->pluck('purchase_date')->first();

        if ($request->branch_id != ''){
            $branch =  Branch::findOrFail($request->branch_id);
            $branch_name = $branch->title;
        }else{
            $branch_name = 'All';
        }

        if ($request->supplier_id != ''){
            $supplier = Supplier::findOrFail($request->supplier_id);
            $supplier_name = $supplier->company_name;
        }else{
            $supplier_name = 'All';
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
        $filter_by['start_date'] = Carbon::parse($start_date)->format(get_option('app_date_format'));;
        $filter_by['end_date'] = Carbon::parse($end_date)->format(get_option('app_date_format'));;
        $filter_by['branch_name'] = $branch_name;
        $filter_by['supplier_name'] = $supplier_name;
        $filter_by['duration_type'] = $duration_type;
        $filter_by['product_name'] = $product_name;

        return $filter_by;
    }

}
