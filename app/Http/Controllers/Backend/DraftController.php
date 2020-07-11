<?php

namespace App\Http\Controllers\Backend;

use App\Models\Draft;
use App\Models\DraftProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class DraftController extends Controller
{
    public function drafts(){
        if (!Auth::user()->can('create_sell_invoice')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $drafts = Draft::where('branch_id', auth()->user()->employee->branch_id)->orderBy('id', 'DESC')->with('draftProducts')->with('customer')->get();
        return response($drafts);
    }
    public function store(Request $request){
        if (!Auth::user()->can('create_sell_invoice')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $draft = new Draft();
        $draft->customer_id = $request->customer['id'];
        $draft->fill($request->summary);
        $draft->save();

        foreach ($request->carts as $cart_product) {
            $draft_product = new DraftProduct();
            $draft_product->draft_id = $draft->id;
            $draft_product->product_id = $cart_product['id'];
            $draft_product->fill($cart_product);
            $draft_product->save();
        }

        $data = Draft::where('id', $draft->id)->with('draftProducts')->with('customer')->first();
        return response($data);

    }

    public function destroy($id)
    {
        if (!Auth::user()->can('create_sell_invoice')) {
            return redirect('home')->with(denied());
        } // end permission checking

        DraftProduct::where('draft_id', $id)->delete();
        Draft::destroy($id);
        return response('Draft has been deleted successfully');

    }
}
