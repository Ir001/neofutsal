<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FieldController extends Controller
{
    public function index()
    {
        return view('admin.master.field.index');
    }
}
