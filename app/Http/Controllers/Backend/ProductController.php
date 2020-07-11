<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\ProductRequest;
use App\Models\Branch;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Requisition;
use App\Models\RequisitionProduct;
use App\Models\Sell;
use App\Models\SellProduct;
use App\Models\Tax;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Toastr;
use Milon\Barcode\DNS1D;
use PDF;

class ProductController extends Controller
{

    protected $search_key;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->can('manage_product')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $data['products'] = Product::orderBy('id', 'DESC')->paginate(24);
        $data['categories'] = Category::all();

        return view ('backend.product.index', $data);
    }

    public function filter(Request $request){

        if (!Auth::user()->can('manage_product')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $category_id = $request->category_id ? [$request->category_id] : Product::select('category_id')->distinct()->get();
        if($request->search_key)
        {
            $this->search_key = $request->search_key;
            $data['products'] = Product::whereIn('category_id', $category_id)
                ->where(function($query){
                    $query->where('title',  'like', '%'.$this->search_key.'%');
                    $query->orWhere('sku', 'like', '%'.$this->search_key.'%');
                })
                ->paginate(50);
        } else {
            $data['products'] = Product::whereIn('category_id', $category_id)->paginate(50);
        }

        $data['categories'] = Category::all();
        return view ('backend.product.index', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->can('manage_product')) {
            return redirect('home')->with(denied());
        } // end permission checking

        return view('backend.product.create', [
            'categories' => Category::where('status', '1')->orderBy('title', 'asc')->get(),
            'taxes' => Tax::orderBy('title', 'asc')->get(),
            'new_sku' => str_pad(Product::withTrashed()->count()+1,get_option('invoice_length'),0,STR_PAD_LEFT),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        if (!Auth::user()->can('manage_product')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $sku_prifix = get_option('product_sku_prefix');
        $request->merge([
            'sku' => $sku_prifix.$request->get('sku')
        ]);

        $this->validate($request, [
            'sku' => 'required|max:255|unique:products',
        ]);

        $product = new Product();
        $product->fill($request->all());
        if($request->hasFile('thumbnail')){
            $product->thumbnail = $request->thumbnail->move('uploads/product/', str_random(40) . '.' . $request->thumbnail->extension());
        }
        if ($product->save()){
            Toastr::success('Product Successfully Created', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Auth::user()->can('manage_product')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $last_30_days_sell = [];
        $key = 0;
        for ($i=30; $i >= 0 ; $i--)
        {
            $date_info = Carbon::now()->subDay($i)->format('Y-m-d');
            $last_30_days_sell[$key]['sell_date'] = $date_info;

            if (Auth::user()->can('access_to_all_branch')){
                $last_30_days_sell[$key]['total_sell_amount'] = SellProduct::where('product_id', $id)->where('sell_date', $date_info)->sum('total_price');
            }else{
                $last_30_days_sell[$key]['total_sell_amount'] = SellProduct::where('product_id', $id)->where('branch_id', auth()->user()->employee->branch->id)->where('sell_date', $date_info)->sum('total_price');
            }
            $key++;
        }

        $product = Product::findOrFail($id);
        $branches = Branch::all();
        $branches_product = [];

        foreach ($branches as $key => $branch) {
            $branches_product[$key]['branch_name'] = $branch->title;
            $branches_product[$key]['current_stock'] = $this->branchWiseProductStock($branch->id, $product);
        }

        return view('backend.product.show', [
            'product' => $product,
            'last_30_days_sell' => $last_30_days_sell,
            'branches_product' => $branches_product,
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
        if (!Auth::user()->can('manage_product')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $data['product'] = Product::findOrFail($id);
        $data['categories'] = Category::where('status', '1')->orderBy('title', 'asc')->get();
        $data['taxes'] = Tax::orderBy('title', 'asc')->get();

        return view('backend.product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        if (!Auth::user()->can('manage_product')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $product = Product::findOrFail($id);
        $product->fill($request->all());
        if($request->hasFile('thumbnail')){
            $product->thumbnail = $request->thumbnail->move('uploads/product/', str_random(40) . '.' . $request->thumbnail->extension());
        }
        if ($product->save()){
            Toastr::success('Product Successfully Updated', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
            return redirect()->back();
        }
    }

    public function changeStatus($id)
    {
        $product = Product::findOrFail($id);
        $product->status = $product->status == 0 ? 1 : 0;
        $product->save();

        Toastr::success('Product status changed', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
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
        if (!Auth::user()->can('manage_product')) {
            return redirect('home')->with(denied());
        } // end permission checking

        Product::destroy($id);
        Toastr::error('Product Successfully Deleted', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->back();
    }


    private function branchWiseProductStock($branch_id, $product)
    {
        $total_sell_qty =   $product->sellProducts->where('branch_id', $branch_id)->sum('quantity');
        $total_purchase_qty =  $product->purchaseProducts->where('branch_id', $branch_id)->sum('quantity');


        $branch_requisitions_from = Requisition::where('requisition_from', $branch_id)
            ->where('status', 2)
            ->select('id')
            ->distinct()
            ->get();

        $branch_requisitions_from_qty = RequisitionProduct::whereIn('requisition_id', $branch_requisitions_from)
            ->where('product_id', $product->id)
            ->select('id')
            ->sum('quantity');


        $branch_requisitions_to = Requisition::where('requisition_to', $branch_id)
            ->where('status', 2)
            ->select('id')
            ->distinct()
            ->get();

        $branch_requisitions_to_qty = RequisitionProduct::whereIn('requisition_id', $branch_requisitions_to)
            ->where('product_id', $product->id)
            ->select('id')
            ->sum('quantity');

        $debit = $total_purchase_qty + $branch_requisitions_from_qty;
        $credit = $total_sell_qty + $branch_requisitions_to_qty;

        return $debit - $credit;
    }

    public function downloadBarcode(Request $request, $id)
    {
        $product = Product::find($id);
        $customPaper = array(0, 0, 280.00, 1024.00);
        $numberOfCode = $request->quantity;
        $pdf = PDF::loadView('backend.pdf.barcode-for-product', ['product' => $product, 'numberOfCode' => $numberOfCode])->setPaper($customPaper, 'portrait');
        return $pdf->download('barcode-' . $product->id . '.pdf');
    }


}
