<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return view('user.transaction.index');
    }
    public function history()
    {
        return view('user.transaction.history');
    }
    public function detail($id = 1)
    {
        return view('user.transaction.detail');
    }
    public function pay($id = 1)
    {
        return view('user.transaction.pay');
    }
}
