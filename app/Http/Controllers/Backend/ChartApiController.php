<?php

namespace App\Http\Controllers\Backend;

use App\Models\Purchase;
use App\Models\Settings;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\SellProduct;
use App\Models\Sell;
use Auth;

class ChartApiController extends Controller
{
    public function dashboard(){

        $branch_id = auth()->user()->employee->branch_id;
    	$last_30_days_sell = [];
        $key = 0;
        for ($i=30; $i >= 0 ; $i--)
        {
            $date_info = Carbon::now()->subDay($i)->format('Y-m-d');
            $last_30_days_sell[$key]['currency'] = get_option('app_currency') . ' ';
            $last_30_days_sell[$key]['sell_date'] = $date_info;
            if (Auth::user()->can('access_to_all_branch')) {
                $last_30_days_sell[$key]['total_sell_amount'] = Sell::where('sell_date', $date_info)->sum('grand_total_price');
            }else{
                $last_30_days_sell[$key]['total_sell_amount'] = Sell::where('branch_id', $branch_id)->where('sell_date', $date_info)->sum('grand_total_price');
            }
            $key++;
        }

        return response($last_30_days_sell);
    }

    public function product($id)
    {
    	$last_30_days_sell = [];
        $key = 0;
        for ($i=30; $i >= 0 ; $i--)
        {
            $date_info = Carbon::now()->subDay($i)->format('Y-m-d');
            $last_30_days_sell[$key]['currency'] = get_option('app_currency') . ' ';
            $last_30_days_sell[$key]['sell_date'] = $date_info;

            if (Auth::user()->can('access_to_all_branch')){
                $last_30_days_sell[$key]['total_sell_amount'] = SellProduct::where('product_id', $id)->where('sell_date', $date_info)->sum('total_price');
            }else{
                $last_30_days_sell[$key]['total_sell_amount'] = SellProduct::where('product_id', $id)->where('branch_id', auth()->user()->employee->branch->id)->where('sell_date', $date_info)->sum('total_price');
            }
            $key++;
        }

        return response($last_30_days_sell);
    }


    public function saleReportStatisticData()
    {
        $sell_info = [];
        $key = 0;
        for ($i=30; $i >= 0 ; $i--)
        {
            $date_info = Carbon::now()->subDay($i)->format('Y-m-d');
            $sell_info[$key]['currency'] = get_option('app_currency') . ' ';
            $sell_info[$key]['sell_date'] = $date_info;
            if (Auth::user()->can('access_to_all_branch')){
                $sell_info[$key]['total_sell_amount'] = Sell::where('sell_date', $date_info)->sum('grand_total_price');
            }else{
                $sell_info[$key]['total_sell_amount'] = Sell::where('branch_id', auth()->user()->employee->branch_id)->where('sell_date', $date_info)->sum('grand_total_price');
            }
            $key++;
        }

        return response($sell_info);
    }

    public function saleReportStatisticByDay($days)
    {
        $sell_info = [];
        $key = 0;
        for ($i=$days; $i >= 0 ; $i--)
        {
            $number_of_day = $i + 1;
            $date_info = Carbon::now()->subDay($number_of_day)->format('Y-m-d');
            $sell_info[$key]['currency'] = get_option('app_currency') . ' ';
            $sell_info[$key]['sell_date'] = $date_info;
            if (Auth::user()->can('access_to_all_branch')){
                $sell_info[$key]['total_sell_amount'] = Sell::where('sell_date', $date_info)->sum('grand_total_price');
            }else{
                $sell_info[$key]['total_sell_amount'] = Sell::where('branch_id', auth()->user()->employee->branch_id)->where('sell_date', $date_info)->sum('grand_total_price');
            }
            $key++;
        }

        return response($sell_info);
    }

    public function saleReportStatisticsFilter($selected_month, $selected_year, $selected_branch, $search_type)
    {
       if ($selected_month == 'a')
       {
           $selected_month = null;
       }

        if ($selected_year == 'a')
        {
            $selected_year = null;
        }

        if ($selected_branch == 'a')
        {
            $selected_branch = null;
        }


        $branch_id = $selected_branch ? [$selected_branch] : Sell::select('branch_id')->distinct()->get();

        if ($search_type == 'month'){
            $start_date = Carbon::parse($selected_month)->startOfMonth($selected_month)->format('Y-m-d');
            $end_date = Carbon::parse($selected_month)->endOfMonth($selected_month)->format('Y-m-d');


            $sell_info = [];
            foreach (CarbonPeriod::create($start_date, $end_date) as $key => $date) {
                $sell_info[$key]['sell_date'] = $date->format('Y-m-d');
                $sell_info[$key]['currency'] = get_option('app_currency') . ' ';
                $sell_info[$key]['total_sell_amount'] = Sell::whereIn('branch_id', $branch_id)
                    ->where('sell_date', $date->format('Y-m-d'))
                    ->sum('grand_total_price');
            }
        }else{
            $year = $selected_year ? $selected_year : Carbon::now()->format('Y');
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

                $sell_info[$i]['currency'] = get_option('app_currency') . ' ';

                $sell_info[$i]['sell_date'] = $month_name;
                $sell_info[$i]['total_sell_amount'] = $total_sell_amount;
            }
        }

        return response($sell_info);
    }

    public function purchaseReportStatisticData()
    {
        $purchase_info = [];
        $key = 0;
        for ($i=30; $i >= 0 ; $i--)
        {
            $date_info = Carbon::now()->subDay($i)->format('Y-m-d');
            $purchase_info[$key]['currency'] = get_option('app_currency') . ' ';
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

        return response($purchase_info);
    }

    public function purchaseReportStatisticByDay($days)
    {
        $purchase_info = [];

        $key = 0;
        for ($i=$days; $i >= 0 ; $i--)
        {
            $date_info = Carbon::now()->subDay($i)->format('Y-m-d');
            $purchase_info[$key]['currency'] = get_option('app_currency') . ' ';
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


        return response($purchase_info);
    }

    public function purchaseReportStatisticsFilter($selected_month, $selected_year, $selected_branch, $search_type)
    {
        if ($selected_month == 'a')
        {
            $selected_month = null;
        }

        if ($selected_year == 'a')
        {
            $selected_year = null;
        }

        if ($selected_branch == 'a')
        {
            $selected_branch = null;
        }


        $branch_id = $selected_branch ? [$selected_branch] : Purchase::select('branch_id')->distinct()->get();

        if ($search_type == 'month'){
            $start_date = Carbon::parse($selected_month)->startOfMonth($selected_month)->format('Y-m-d');
            $end_date = Carbon::parse($selected_month)->endOfMonth($selected_month)->format('Y-m-d');

            $purchase_info = [];
            foreach (CarbonPeriod::create($start_date, $end_date) as $key => $date) {
                $purchase_info[$key]['purchase_date'] = $date->format('Y-m-d');
                $purchase_info[$key]['currency'] = get_option('app_currency') . ' ';
                $purchase_info[$key]['total_purchase_amount'] = Purchase::whereIn('branch_id', $branch_id)
                    ->where('purchase_date', $date->format('Y-m-d'))
                    ->sum('total_amount');
            }
        }else{
            $year = $selected_year ? $selected_year : Carbon::now()->format('Y');
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
                $purchase_info[$i]['currency'] = get_option('app_currency') . ' ';
                $purchase_info[$i]['total_purchase_amount'] = $total_purchase_amount;
            }
        }

        return response($purchase_info);

    }


}
