<?php

use App\Models\Requisition;
use Carbon\Carbon;


function active_if_full_match($path)
{
    return Request::is($path) ? 'active' : '';
}

function active_if_match($path)
{
    return Request::is($path . '*') ? 'show' : '';
}

function show_status($status, $url)
{
    return $status == 1 ?
        '<a href="javascript:void(0)" onclick="$(this).confirm(\'' . $url . '\');" class="label label-success"> Active </a>'
        :
        '<a href="javascript:void(0)" onclick="$(this).confirm(\'' . $url . '\');" class="label label-danger"> Deactive </a>';
}

function toggle_status($status){
    if ($status == 1){
        return 0;
    }else{
        return 1;
    }
}

function monthlySells($branch_id, $key)
{
    $yearMonthArray = explode('-', $key);
    $year = $yearMonthArray[0];
    $month = $yearMonthArray[1];
    return \App\Models\Sell::where('branch_id', $branch_id)->whereYear('sell_date', $year)->whereMonth('sell_date', $month)->sum('grand_total_price');
}

function productAvailableTransactionStockQty($product_id)
{
    $branch_id = auth()->user()->employee->branch_id;

    /**
     * Debit Quantity
     **/
    $total_purchase_products_qty = \App\Models\PurchaseProduct::where('branch_id', $branch_id)
        ->where('product_id', $product_id)
        ->sum('quantity');

    $branch_requisitions_from = \App\Models\Requisition::where('requisition_from', $branch_id)
        ->where('status', 2)
        ->select('id')
        ->distinct()
        ->get();

    $branch_requisitions_from_qty = \App\Models\RequisitionProduct::whereIn('requisition_id', $branch_requisitions_from)
        ->where('product_id', $product_id)
        ->select('id')
        ->sum('quantity');


    /**
     * Credit Quantity
     **/

   $total_sell_products_qty = \App\Models\SellProduct::where('branch_id', $branch_id)
        ->where('product_id', $product_id)
        ->sum('quantity');

    $branch_requisitions_to = \App\Models\Requisition::where('requisition_to', $branch_id)
        ->where('status', 2)
        ->select('id')
        ->distinct()
        ->get();

    $branch_requisitions_to_qty = \App\Models\RequisitionProduct::whereIn('requisition_id', $branch_requisitions_to)
        ->where('product_id', $product_id)
        ->select('id')
        ->sum('quantity');



    $debit = $total_purchase_products_qty + $branch_requisitions_from_qty;
    $credit = $total_sell_products_qty + $branch_requisitions_to_qty;

    return $debit - $credit;
}

function productReceivedFromOthersBranch($product_id)
{
    $branch_id = auth()->user()->employee->branch_id;

    $branch_requisitions_from = \App\Models\Requisition::where('requisition_from', $branch_id)
        ->where('status', 2)
        ->select('id')
        ->distinct()
        ->get();

   return $branch_requisitions_from_qty = \App\Models\RequisitionProduct::whereIn('requisition_id', $branch_requisitions_from)
        ->where('product_id', $product_id)
        ->select('id')
        ->sum('quantity');

}

function productSendToOthersBranch($product_id){
    $branch_id = auth()->user()->employee->branch_id;

    $branch_requisitions_to = \App\Models\Requisition::where('requisition_to', $branch_id)
        ->where('status', 2)
        ->select('id')
        ->distinct()
        ->get();

    return $branch_requisitions_to_qty = \App\Models\RequisitionProduct::whereIn('requisition_id', $branch_requisitions_to)
        ->where('product_id', $product_id)
        ->select('id')
        ->sum('quantity');
}

function pendingRequisition()
{
    if (Auth::user()->can('access_to_all_branch')){
        $requisitions = Requisition::orderBy('id', 'DESC')->where('status', 0)->count();
    }else{
        $requisitions = Requisition::where('status', 0)
            ->where(function($query){
                $query->where('requisition_from',  auth()->user()->employee->branch_id);
                $query->orWhere('requisition_to', auth()->user()->employee->branch_id);
            })
            ->orderBy('id', 'DESC')
            ->count();
    }
    return $requisitions;
}

function notifications()
{
    $notifications = \App\Models\Notification::where('notify_date_time', '<',  Carbon::now()->toDateTimeString())->where('status', 0)->select('id', 'status')->get();
    foreach ($notifications as $notification)
    {
        $notification->status = 1;
        $notification->save();
    }


    return $notifications = \App\Models\Notification::where('message_to', auth()->user()->employee->branch_id)
        ->where('is_click', 0)
        ->where('status', 1)
        ->orderBy('id', 'DESC')
        ->get();
}

function get_option($option_key)
{
    if (\App\Models\Settings::where('option_key', $option_key)->count() > 0)
    {
        $option = \App\Models\Settings::where('option_key', $option_key)->first();
        return $option->option_value;
    } else {
        return '';
    }

}

function languages()
{
    return \App\Models\Language::where('status', 1)->get();
}
function denied()
{
    return array(
        'message' => 'Access Denied',
        'alert-type' => 'warning'
    );
}



?>
