<?php

namespace App\Http\Controllers\Backend;

use App\Models\Branch;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;
use Auth;

class StockReportController extends Controller
{
    public function index()
    {
        if (!Auth::user()->can('view_stock')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $products = Product::all();
        return view('backend.report.stock.index',[
            'products' => $products,
            'branches' =>Branch::all()
        ]);
    }

    public function filter(Request $request){
        if (!Auth::user()->can('view_stock')) {
            return redirect('home')->with(denied());
        } // end permission checking

        if ($request->branch_id != ''){
            $products = Product::all();

            $product_requisitions = [];
            foreach ($products as $key => $product){
                $product_requisitions[$key]['product_id'] = $product->id;
                $product_requisitions[$key]['product_title'] = $product->title;
                $product_requisitions[$key]['product_sku'] = $product->sku;
                $product_requisitions[$key]['product_sell_price'] = $product->sell_price;
                $product_requisitions[$key]['purchase_qty'] = $product->purchaseProducts->where('branch_id', $request->branch_id)->sum('quantity');
                $product_requisitions[$key]['branch_requisitions_from_qty'] = $this->branchRequisitionFromQty($request, $product);
                $product_requisitions[$key]['sell_qty'] = $product->sellProducts->where('branch_id', $request->branch_id)->sum('quantity');
                $product_requisitions[$key]['branch_requisitions_to_qty'] =$this->branchRequisitionToQty($request, $product);
                $product_requisitions[$key]['current_stock'] = ($product_requisitions[$key]['purchase_qty'] + $product_requisitions[$key]['branch_requisitions_from_qty']) - ($product_requisitions[$key]['sell_qty'] + $product_requisitions[$key]['branch_requisitions_to_qty']);
            }


            return view('backend.report.stock.filter',[
                'branches' =>Branch::all(),
                'product_requisitions' => $product_requisitions,
            ]);
        }else{
            return redirect(url('report/stock-report'));
        }
    }

    public function stockReportPdf(Request $request){
        if (!Auth::user()->can('view_stock')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $products = Product::all();

        $random_string = str_random(10);
        $pdf = PDF::loadView('backend.pdf.reports.stock.all-branch', compact('products', 'request'))->setPaper('a4');

        if ($request->action_type == 'download'){
            return $pdf->download('stock-report-' . Carbon::now()->format(get_option('app_date_format')) . '-'. $random_string . '.pdf');
        }elseif($request->action_type == 'print'){
            @unlink('pdf/reports/stock/' . 'stock-report.pdf');
            $pdf->save('pdf/reports/stock/' . 'stock-report.pdf');
            return redirect('pdf/reports/stock/' . 'stock-report.pdf');
        }else{

            $headers = [
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0'
                , 'Content-type' => 'text/csv'
                , 'Content-Disposition' => 'attachment; filename=galleries.csv'
                , 'Expires' => '0'
                , 'Pragma' => 'public'
            ];

            $filename = 'download.csv';
            $handle = fopen($filename, 'w');
            fputcsv($handle, [
                __('pages.sl'),
                __('pages.product'),
                __('pages.purchase') . ' '. __('pages.quantity'),
                __('pages.sells') . ' '. __('pages.quantity'),
                __('pages.current_stock_quantity'),
                __('pages.current_stock_value'),
            ]);

            $products = Product::all();
            foreach ($products as $key => $product) {

                if (Auth::user()->can('access_to_all_branch')) {
                   $purchaseQuantity = $product->purchaseProducts->sum('quantity');
                    $sellQuantity = $product->sellProducts->sum('quantity');
                    $current_stock_qty = $product->purchaseProducts->sum('quantity') - $product->sellProducts->sum('quantity');
                } else {
                    $purchaseQuantity = $product->purchaseProducts->where('branch_id', auth()->user()->employee->branch_id)->sum('quantity');
                    $sellQuantity = $product->sellProducts->where('branch_id', auth()->user()->employee->branch_id)->sum('quantity');
                    $current_stock_qty =  productAvailableTransactionStockQty($product->id);
                }

                $product_tax = $product->sell_price * $product->tax->value / 100;
                $current_stock_amount = $current_stock_qty * ($product->sell_price + $product_tax);


                fputcsv($handle, [
                    $key + 1,
                    $product->title . '|'. $product->sku,
                    $purchaseQuantity,
                    $sellQuantity,
                    $current_stock_qty,
                    get_option('app_currency') . number_format($current_stock_amount,2),
                ]);
            }

            fclose($handle);
            return response()->download($filename, 'stock-report-' . Carbon::now()->toDateString() . '.csv', $headers);

        }
    }

    private function branchRequisitionFromQty($request, $product){
        $branch_requisitions_from = \App\Models\Requisition::where('requisition_from', $request->branch_id)
            ->where('status', 2)
            ->select('id')
            ->distinct()
            ->get();

        return $branch_requisitions_from_qty = \App\Models\RequisitionProduct::whereIn('requisition_id', $branch_requisitions_from)
            ->where('product_id', $product->id)
            ->sum('quantity');
    }

    private function branchRequisitionToQty($request, $product){
        $branch_requisitions_to = \App\Models\Requisition::where('requisition_to', $request->branch_id)
            ->where('status', 2)
            ->select('id')
            ->distinct()
            ->get();

      return  $branch_requisitions_to_qty = \App\Models\RequisitionProduct::whereIn('requisition_id', $branch_requisitions_to)
            ->where('product_id', $product->id)
            ->select('id')
            ->sum('quantity');
    }
}
