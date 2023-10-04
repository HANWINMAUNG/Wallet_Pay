<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
  public function index()
  {
    $user = Auth::guard('web')->user();
    $notifications = $user->notifications()->paginate(5);
    return view('frontend.notifications.notification',['notifications' => $notifications]);
  }
}
