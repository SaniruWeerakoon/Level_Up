<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Exception;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->paginate(5);
//        $notifications = auth()->user()->notifications()->get();
        return view('notifications.index', compact('notifications'));
    }



    public function destroy(Notification $notification)
    {
        try {
            $notification->delete();
            return redirect()->route('notifications.index')->with('success', 'Notification deleted successfully');
        } catch (Exception) {
            return redirect()->route('notifications.index')->with('error', 'Notification could not be deleted');
        }

    }
}
