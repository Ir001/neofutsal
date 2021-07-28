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
    public function create()
    {
        return view('admin.master.field.create');
    }
    public function store(Request $request)
    {
        $data['success'] = true;
        $data['message'] = 'Lapangan berhasil ditambahkan';
        return response()->json($data);
    }
}
