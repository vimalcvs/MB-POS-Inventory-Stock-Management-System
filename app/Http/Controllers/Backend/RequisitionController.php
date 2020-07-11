<?php

namespace App\Http\Controllers\Backend;

use App\Models\Branch;
use App\Models\Notification;
use App\Models\Requisition;
use App\Models\RequisitionProduct;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class RequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->can('manage_requisition')) {
            return redirect('home')->with(denied());
        } // end permission checking

        if (Auth::user()->can('access_to_all_branch')){
            $requisitions = Requisition::orderBy('id', 'DESC')->paginate(20);
        }else{
            $requisitions = Requisition::where('requisition_from', auth()->user()->employee->branch_id)
                ->orWhere('requisition_to', auth()->user()->employee->branch_id)
                ->orderBy('id', 'DESC')
                ->paginate(20);
        }
        return view('backend.requisition.index',[
            'requisitions' => $requisitions,
            'branches' => Branch::all(),
        ]);
    }

    public function pendingRequisition()
    {
        if (!Auth::user()->can('manage_requisition')) {
            return redirect('home')->with(denied());
        } // end permission checking

        if (Auth::user()->can('access_to_all_branch')){
            $requisitions = Requisition::orderBy('id', 'DESC')->where('status', 0)->paginate(50);
        }else{
            $requisitions = Requisition::where('status', 0)
                ->where(function($query){
                    $query->where('requisition_from',  auth()->user()->employee->branch_id);
                    $query->orWhere('requisition_to', auth()->user()->employee->branch_id);
                })
                ->orderBy('id', 'DESC')
                ->paginate(50);
        }

        return view('backend.requisition.index',[
            'requisitions' => $requisitions,
            'branches' => Branch::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->can('manage_requisition')) {
            return redirect('home')->with(denied());
        } // end permission checking


        return view('backend.requisition.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::user()->can('manage_requisition')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $requisition = new Requisition();
        $requisition->requisition_to = $request->branch['id'];
        $requisition->save();

        $notification = new Notification();
        $notification->message_to = $requisition->requisition_to;
        $notification->message_from = $requisition->requisition_from;
        $notification->message = 'You have 1 Requisition from <b>'. auth()->user()->employee->branch->title .'</b>';
        $notification->target_url = $requisition->id;
        $notification->type = 1;
        $notification->save();

        $this->saveRequisitionProducts($request, $requisition);
        $data = Requisition::where('id', $requisition->id)->with('requisitionProducts')->with('requisitionTo')->with('requisitionFrom')->first();
        return response($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Auth::user()->can('manage_requisition')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $requisition = Requisition::findOrFail($id);
        if (!Auth::user()->can('access_to_all_branch')) {
            $result = 0;
            if ($requisition->requisition_to == auth()->user()->employee->branch_id){
                $result = 1;
            }
            if ($requisition->requisition_from == auth()->user()->employee->branch_id){
                $result = 1;
            }

            if ($result == 0){
                return redirect()->back()->with(denied());
            }
        }

        return view('backend.requisition.show',[
            'requisition' => Requisition::findOrFail($id)
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
        if (!Auth::user()->can('manage_requisition')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $requisition = Requisition::findOrFail($id);
        if (!Auth::user()->can('access_to_all_branch')) {
            $result = 0;
            if ($requisition->requisition_to == auth()->user()->employee->branch_id){
                $result = 1;
            }
            if ($requisition->requisition_from == auth()->user()->employee->branch_id){
                $result = 1;
            }

            if ($result == 0){
                return redirect()->back()->with(denied());
            }
        }

        return view('backend.requisition.edit',[
            'requisition' => $requisition
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRequisition(Request $request)
    {

        if (!Auth::user()->can('manage_requisition')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $requisition = Requisition::findOrFail($request->requisition_id);
        $requisition->requisition_to = $request->branch['id'];
        $requisition->save();

        RequisitionProduct::where('requisition_id', $requisition->id)->delete();
        $this->saveRequisitionProducts($request, $requisition);

        $data = Requisition::where('id', $requisition->id)->with('requisitionProducts')->with('requisitionTo')->with('requisitionFrom')->first();
        return response($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->can('manage_requisition')) {
            return redirect('home')->with(denied());
        } // end permission checking

        RequisitionProduct::where('requisition_id', $id)->delete();
        Requisition::destroy($id);
        return redirect()->back()->with('success','Requisition has been deleted successfully');
    }

    public function getRequisitionDetails($id){
        return Requisition::where('id', $id)->with('requisitionProducts')->with('requisitionTo')->first();
    }

    public function updateRequisitionToConfirm(Request $request)
    {
        if (!Auth::user()->can('manage_requisition')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $requisition = Requisition::findOrFail($request->requisition['id']);
        $requisition->status = 1;
        $requisition->save();

        $notification = new Notification();
        $notification->message_to = $requisition->requisition_from;
        $notification->message_from = $requisition->requisition_to;
        $notification->message = '</b>'.$requisition->requisitionTo->title .'</b>'.' Confirmed your  Requisition';
        $notification->target_url = $requisition->id;
        $notification->type = 1;
        $notification->save();

        RequisitionProduct::where('requisition_id', $requisition->id)->delete();
        $this->saveRequisitionProducts($request, $requisition);

        $data = Requisition::where('id', $requisition->id)->with('requisitionProducts')->with('requisitionFrom')->with('requisitionTo')->first();
        return response($data);

    }

    public function updateRequisitionToReject($id)
    {
        if (!Auth::user()->can('manage_requisition')) {
            return redirect('home')->with(denied());
        } // end permission checking



        $requisition = Requisition::findOrFail($id);
        $requisition->status = 3;
        $requisition->save();

        $notification = new Notification();
        $notification->message_to = $requisition->requisition_from;
        $notification->message_from = $requisition->requisition_to;
        $notification->message = '<b>'.$requisition->requisitionTo->title .'</b>'.' Reject your  Requisition';
        $notification->target_url = $requisition->id;
        $notification->type = 1;
        $notification->save();

        $data = Requisition::where('id', $requisition->id)->with('requisitionProducts')->with('requisitionFrom')->with('requisitionTo')->first();
        return response($data);
    }

    public function statuaChgangeToReceived($id){
        if (!Auth::user()->can('manage_requisition')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $requisition = Requisition::findOrFail($id);
        $requisition->status = 2;
        $requisition->complete_date = Carbon::now();
        $requisition->save();

        $notification = new Notification();
        $notification->message_to = $requisition->requisition_to;
        $notification->message_from = $requisition->requisition_from;
        $notification->message = '</b>'.$requisition->requisitionFrom->title .'</b>'.' Received your Product';
        $notification->target_url = $requisition->id;
        $notification->type = 1;
        $notification->save();

        return redirect()->back()->with('success', 'Requisition Received');
    }

    public function statuaChgangeToCanceled($id){
        if (!Auth::user()->can('manage_requisition')) {
            return redirect('home')->with(denied());
        } // end permission checking


        $requisition = Requisition::findOrFail($id);
        $requisition->status = 4;
        $requisition->save();

        $notification = new Notification();
        $notification->message_to = $requisition->requisition_to;
        $notification->message_from = $requisition->requisition_from;
        $notification->message = '<b>'.$requisition->requisitionFrom->title .'</b>'.' Returned  your  Products';
        $notification->target_url = $requisition->id;
        $notification->type = 1;
        $notification->save();

        return redirect()->back()->with('success', 'Requisition Canceled');
    }

    public function filter(Request $request){
        if (!Auth::user()->can('manage_requisition')) {
            return redirect('home')->with(denied());
        } // end permission checking



        if ($request->status == 0){
            $status =  [$request->status];
        }else{
            $status = [$request->status];
        }

        if ($request->status == null){
            $status =  Requisition::select('status')->distinct()->get();
        }

        $requisition_from = $request->requisition_from ? [$request->requisition_from] : Requisition::select('requisition_from')->distinct()->get();
        $requisition_to = $request->requisition_to ? [$request->requisition_to] : Requisition::select('requisition_to')->distinct()->get();
        $start_date = $request->start_date ? $request->start_date : Requisition::oldest()->pluck('requisition_date')->first();
        $end_date = $request->end_date ? $request->end_date : Requisition::latest()->pluck('requisition_date')->first();


        $requisitions = Requisition::whereIn('requisition_from', $requisition_from)
            ->whereIn('requisition_to', $requisition_to)
            ->whereIn('status', $status)
            ->whereBetween('requisition_date', [$start_date, $end_date])
            ->get();

        return view('backend.requisition.filter-result',[
            'requisitions' => $requisitions,
            'branches' => Branch::all(),
        ]);
    }

    public function pdf($requisition_id, $action_type){
        if (!Auth::user()->can('manage_requisition')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $requisition = Requisition::findOrFail($requisition_id);
        if (!Auth::user()->can('access_to_all_branch')) {
            $result = 0;
            if ($requisition->requisition_to == auth()->user()->employee->branch_id){
                $result = 1;
            }
            if ($requisition->requisition_from == auth()->user()->employee->branch_id){
                $result = 1;
            }

            if ($result == 0){
                return redirect()->back()->with(denied());
            }
        }

        $pdf = PDF::loadView('backend.pdf.requisition.invoice', compact('requisition'))->setPaper('a4');

        if ($action_type == 'pdf'){
            return $pdf->download($requisition->invoice_id . '.pdf');
        }else{
            $pdf->save('pdf/requisition/' . $requisition->requisition_id . '.pdf');
            return redirect('pdf/requisition/' . $requisition->requisition_id .'.pdf');
        }
    }

    private function saveRequisitionProducts($request, $requisition){
        foreach ($request->carts as $cart_product) {
            $requisition_product = new RequisitionProduct();
            $requisition_product->requisition_id = $requisition->id;
            $requisition_product->product_id = $cart_product['id'];
            $requisition_product->requisition_date = $requisition->requisition_date;
            $requisition_product->fill($cart_product);
            $requisition_product->save();
        }
    }
}
