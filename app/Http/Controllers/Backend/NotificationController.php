<?php

namespace App\Http\Controllers\Backend;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function getNotification($id)
    {
         $notification = Notification::findOrFail($id);
         $notification->is_click = 1;
         $notification->save();

        if ($notification->type == 1){
            return redirect()->route('requisition.show', $notification->target_url);
        }elseif($notification->type == 2){
            return redirect()->route('notice.show', $notification->target_url);
        }
        else{
            return redirect()->back();
        }
    }
}
