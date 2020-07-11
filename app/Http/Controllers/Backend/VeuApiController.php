<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\CustomerRequest;
use App\Models\Branch;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\PaymentToSupplier;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseProduct;
use App\Models\Requisition;
use App\Models\RequisitionProduct;
use App\Models\SellProduct;
use App\Models\Settings;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class VeuApiController extends Controller
{
    public function getAppConfigs()
    {
        return response(Settings::all());
    }

    public function getAppLang()
    {
        $lang = config('app.locale');
        $files   = glob(resource_path('lang/' . $lang . '/*.php'));
        $strings = [];

        foreach ($files as $file) {
            $name  = basename($file, '.php');
            $strings[$name] = require $file;
        }

       return response($strings['pages']);
    }

    public function myBranch(){
       return response(auth()->user()->employee->branch);
    }
    public function products()
    {
        $products = Product::where('status', 1)->with('tax')->get();
        return response($products);
    }

    public function productsWithPaginate(){
        $products = Product::where('status', 1)->with('tax')->paginate(20);
        return response($products);
    }

    public function productAvailableStockQty($product_id)
    {
        $branch_id = auth()->user()->employee->branch_id;

        /**
         * Debit Quantity
         **/
        $total_purchase_products_qty = PurchaseProduct::where('branch_id', $branch_id)
            ->where('product_id', $product_id)
            ->sum('quantity');

        $branch_requisitions_from = Requisition::where('requisition_from', $branch_id)
            ->where('status', 2)
            ->select('id')
            ->distinct()
            ->get();

        $branch_requisitions_from_qty = RequisitionProduct::whereIn('requisition_id', $branch_requisitions_from)
            ->where('product_id', $product_id)
            ->select('id')
            ->sum('quantity');


        /**
         * Credit Quantity
         **/

        $total_sell_products_qty = SellProduct::where('branch_id', $branch_id)
            ->where('product_id', $product_id)
            ->sum('quantity');

        $branch_requisitions_to = Requisition::where('requisition_to', $branch_id)
            ->where('status', 2)
            ->select('id')
            ->distinct()
            ->get();

        $branch_requisitions_to_qty = RequisitionProduct::whereIn('requisition_id', $branch_requisitions_to)
            ->where('product_id', $product_id)
            ->select('id')
            ->sum('quantity');



        $debit = $total_purchase_products_qty + $branch_requisitions_from_qty;
        $credit = $total_sell_products_qty + $branch_requisitions_to_qty;

        return $debit - $credit;
    }

    public function categories()
    {
        $categories = Category::where('status', 1)->orderBy('id', 'DESC')->get();
        return response($categories);
    }

    public function brands()
    {
        $brands = Brand::where('status', 1)->get();
        return response($brands);
    }

    public function suppliers()
    {
        $suppliers = Supplier::where('status', 1)->get();
        return response($suppliers);
    }

    public function supplierDue($id){

        $dueAmount = Purchase::where('branch_id', auth()->user()->employee->branch_id)->where('supplier_id', $id)->sum('due_amount');
        $paidAmount =  PaymentToSupplier::where('branch_id', auth()->user()->employee->branch_id)->where('supplier_id', $id)->sum('amount');

        $due =  $dueAmount - $paidAmount;

        $data['message'] = 'Total Due '. get_option('app_currency'). number_format($due,2);
        $data['due_amount'] = $due;

        return response($data);
    }

    public function customers(){
        $customers = Customer::where('status', 1)->get();
        return response($customers);
    }

    public function branches()
    {
        $branches = Branch::all();
        return response($branches);
    }

    public function branchesWithoutMe()
    {
        $branches = Branch::where('id', '!=', auth()->user()->employee->branch_id)->get();
        return response($branches);
    }

    public function storeCustomer(Request $request){
        $customer = new Customer();
        $customer->name = $request->new_customer['name'];
        $customer->phone = $request->new_customer['phone'];
        $customer->email = $request->new_customer['email'];
        $customer->address = $request->new_customer['address'];
        $customer->save();
        return response($customer);
    }
}
