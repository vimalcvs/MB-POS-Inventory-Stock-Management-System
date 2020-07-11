<?php

namespace App\Http\Controllers\Backend;

use App\Models\Branch;
use App\Models\SellsTarget;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Toastr;


class SellsTargetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->can('manage_sells_target')) {
            return redirect('home')->with(denied());
        } // end permission checking

        return view('backend.sells-target.index', [
            'sells_targets' => SellsTarget::orderBy('month', 'DESC')->get()->groupBy('month')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->can('manage_sells_target')) {
            return redirect('home')->with(denied());
        } // end permission checking


        return view('backend.sells-target.create',[
            'branches' => Branch::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        if (!Auth::user()->can('manage_sells_target')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $targets = $request->all();
        $month = Carbon::parse($request->month)->format('Y-m');
        if (SellsTarget::where('month', $month)->count() > 0){
            Toastr::error('Already set target for this month', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
            return redirect()->route('branch-sells-target.index');
        }
        foreach ($targets['branch_id'] as $key => $target){
            $sells_target = new SellsTarget();
            $sells_target->branch_id = $target;
            $sells_target->month = $month;
            $sells_target->target_amount = $targets['target_amount'][$key];
            $sells_target->save();
        }

        Toastr::success('Sells Target Created', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->route('branch-sells-target.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($month)
    {
        if (!Auth::user()->can('manage_sells_target')) {
            return redirect('home')->with(denied());
        } // end permission checking


        return view('backend.sells-target.edit',[
            'sell_targets' => SellsTarget::where('month', $month)->get()
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
        if (!Auth::user()->can('manage_sells_target')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $targets = $request->all();
        $month = Carbon::parse($request->month)->format('Y-m');
        SellsTarget::where('month', $month)->delete();
        foreach ($targets['branch_id'] as $key => $target){
            $sells_target = new SellsTarget();
            $sells_target->branch_id = $target;
            $sells_target->month = $month;
            $sells_target->target_amount = $targets['target_amount'][$key];
            $sells_target->save();
        }

        Toastr::success('Sells Target updated', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($month)
    {
        if (!Auth::user()->can('manage_sells_target')) {
            return redirect('home')->with(denied());
        } // end permission checking


        SellsTarget::where('month', $month)->delete();
        Toastr::error('Sells target deleted', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->back();
    }
}
