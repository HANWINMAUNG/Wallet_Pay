<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Wallet;
use App\Models\AdminUser;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function home()
    {
        $user = User::count();
        $admin_user = AdminUser::count();
        $wallet = Wallet::count();
        $transaction = Transaction::count();
        return view('backend.home',[
            "user" => $user,
            "admin_user" => $admin_user,
            "wallet" => $wallet,
            "transaction" => $transaction,
        ]);
    }
}
