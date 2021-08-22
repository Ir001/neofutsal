<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.order.summary.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('admin.order.summary.detail', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
    
    
    public function datatable(){
        $query = Order::with(['user:id,name','futsal_field:id,name','status_transaction:id,name_admin']);
        return DataTables::eloquent($query)
        ->editColumn('total',function($query){
            return ($query->hours * $query->price);
        })
        ->editColumn('play_date',function($query){
            return Carbon::parse($query->play_date)->locale('id')->translatedFormat('l, d F Y');
        })
        ->editColumn('start_at', function($query){
            return Carbon::parse($query->start_at)->format('H:i');
        })
        ->editColumn('end_at',function($query){
            return Carbon::parse($query->end_at)->format('H:i');
        })
        ->editColumn('created_at', function($query){
            return Carbon::parse($query->created_at)->locale('id')->translatedFormat('l, d F Y | H:i')." WIB";
        })
        ->editColumn('updated_at', function($query){
            return Carbon::parse($query->updated_at)->locale('id')->diffForHumans();
        })
        ->make(true)
        ;
        
    }
}
