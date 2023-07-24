<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
class NotificationController extends Controller
{
    public function notifyUpdate(Request $req)
    {
        $user = auth()->user();
        $notification = $user->notifications()->find($req->id);

    if ($notification) {
        // If the notification is unread, set it as read.
        if (!$notification->pivot->is_read) {
            $user->notifications()->updateExistingPivot($notification->id, ['is_read' => true]);
        }
    }

    return redirect()->back();
    }

    public function notifyUpdate2(Request $req)
    {

        auth()->user()->notifications()->where('id', $req->id)->wherePivot('is_read', false)->update(['is_read' => true]);

        return redirect()->back();
    }

    public function allNotification()
    { 
        $user = auth()->user();
        $registrationTimestamp = $user->created_at;
        $notifications = Notification::with('user')->where('user_id', '!=', Auth::id())
               ->where('created_at', '>=', $registrationTimestamp)
               ->orderByDesc('created_at')->get();
        return view('user.notification', compact('notifications'));
    }
}
