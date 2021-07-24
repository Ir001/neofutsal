<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transaction.index');
    }
    public function history()
    {
        return view('transaction.history');
    }
    public function detail($id = 1)
    {
        return view('transaction.detail');
    }
}
