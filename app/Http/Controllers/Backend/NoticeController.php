<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\NoticeRequest;
use App\Models\Employee;
use App\Models\Notice;
use App\Models\Notification;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Arr;
use Toastr;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->can('manage_notice')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $notice_1 = Notification::where('message_to', auth()->user()->id)
                    ->where('message_from', '!=', auth()->user()->id)
                    ->where('status', 1)
                    ->where('type', 2)
                    ->pluck('target_url')->toArray();

        $notice_2 = Notice::orderBy('id', 'DESC')->where('created_by', auth()->user()->id)->pluck('id')->toArray();

        $ids = array_unique(array_merge($notice_1, $notice_2));


        return view('backend.notice.index',[
            'notices' => Notice::whereIn('id', $ids)->orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->can('manage_notice')) {
            return redirect('home')->with(denied());
        } // end permission checking

        return view('backend.notice.create',[
            'users' => User::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoticeRequest $request)
    {
        if (!Auth::user()->can('manage_notice')) {
            return redirect('home')->with(denied());
        } // end permission checking

       if ($request->notify_time == ''){
           $notify_time = Carbon::now()->toTimeString();
       }else{
           $notify_time = Carbon::parse($request->notify_time)->toTimeString();
       }


       $notice = new Notice();
       $notice->fill($request->all());
       $notice->notify_time = $notify_time;
       $notice->created_by = auth()->user()->id;
       $notice->save();
     $this->saveNotifications($request, $notice);

       Toastr::success('Notice successfully created', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
       return redirect()->route('notice.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Auth::user()->can('manage_notice')) {
            return redirect('home')->with(denied());
        } // end permission checking

       $check_notification = Notification::where('message_to', auth()->user()->id)->where('target_url', $id)->count();
       $check_notice = Notice::where('created_by', auth()->user()->id)->where('id', $id)->count();

       if ($check_notification == 1 || $check_notice == 1){
           return view('backend.notice.show',[
               'notice' => Notice::findOrFail($id),
           ]);
       }else{
           Toastr::warning('Permission denied', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
           return redirect()->back();
       }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::user()->can('manage_notice')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $notice = Notice::findOrFail($id);
        $selectedUser = [];
        foreach($notice->notifications as $key => $notification)
        {
            $selectedUser[$key] = $notification->messageTo->id;
        }

        return view('backend.notice.edit',[
            'users' => User::orderBy('id', 'DESC')->get(),
            'notice' => $notice,
            'selectedUser' => $selectedUser
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NoticeRequest $request, $id)
    {
        if (!Auth::user()->can('manage_notice')) {
            return redirect('home')->with(denied());
        } // end permission checking

        if ($request->notify_time == ''){
            $notify_time = Carbon::now()->toTimeString();
        }else{
            $notify_time = Carbon::parse($request->notify_time)->toTimeString();
        }

        $notice = Notice::findOrFail($id);
        $notice->fill($request->all());
        $notice->notify_time = $notify_time;
        $notice->created_by = auth()->user()->id;
        $notice->save();

        Notification::where('type', 2)->where('target_url', $notice->id)->delete();
        $this->saveNotifications($request, $notice);

        Toastr::success('Notice successfully updated', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->route('notice.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::user()->can('manage_notice')) {
            return redirect('home')->with(denied());
        } // end permission checking

        $notice = Notice::findOrFail($id);
        Notification::where('type', 2)->where('target_url', $notice->id)->delete();
        $notice->delete();

        Toastr::success('Notice successfully deleted', '', ['progressBar' => true, 'closeButton' => true, 'positionClass' => 'toast-bottom-right']);
        return redirect()->route('notice.index');
    }

    private function saveNotifications($request, $notice) {

        $notifyDate = Carbon::parse($notice->notify_date)->toDateString() . ' '. $notice->notify_time;
        $notify_date_time = Carbon::parse($notifyDate)->toDateTimeString();


        if ($request->user_id){
            if ($request->user_id[0] == 'all'){
                $users = User::all();
                foreach ($users as $user){
                    $notification = new Notification();
                    $notification->message_to = $user->id;
                    $notification->message_from = $notice->created_by;
                    $notification->message = $notice->title;
                    $notification->target_url = $notice->id;
                    $notification->type = 2;
                    $notification->notify_date_time = $notify_date_time;
                    if ($notify_date_time > Carbon::now()->toDateTimeString())
                    {
                        $notification->status = 0;
                    }
                    $notification->save();
                }
            }else{
                foreach ($request->user_id as $user){
                    $notification = new Notification();
                    $notification->message_to = $user;
                    $notification->message_from = $notice->created_by;
                    $notification->message = $notice->title;
                    $notification->target_url = $notice->id;
                    $notification->type = 2;
                    $notification->notify_date_time = $notify_date_time;
                    if ($notify_date_time > Carbon::now()->toDateTimeString())
                    {
                        $notification->status = 0;
                    }
                    $notification->save();
                }
            }
        }else{
            $users = User::all();
            foreach ($users as $user){
                $notification = new Notification();
                $notification->message_to = $user->id;
                $notification->message_from = $notice->created_by;
                $notification->message = $notice->title;
                $notification->target_url = $notice->id;
                $notification->type = 2;
                $notification->notify_date_time = $notify_date_time;
                if ($notify_date_time > Carbon::now()->toDateTimeString())
                {
                    $notification->status = 0;
                }
                $notification->save();
            }
        }
    }
}
