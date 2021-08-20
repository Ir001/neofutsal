<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
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
    public function show(Transaction $transaction)
    {
        dd($transaction);   
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
        $query = Transaction::with(['payment_type:id,bank_name','transaction_type:id,name','order.user:id,name','order.futsal_field:id,name','order.status_transaction:id,name_admin']);
        return DataTables::eloquent($query)
            ->editColumn('order.status_transaction.color',function($query){
                $status = $query->order->status_transaction->id;
                if(in_array($status,[3,4])){
                    $color = 'bg-info';
                }elseif(in_array($status,[5,6])){
                    $color = 'bg-success';
                }else{
                    $color = 'text-white bg-danger';
                }
                return $color;
            })
            ->editColumn('order.play_date',function($query){
                return Carbon::parse($query->order->play_date)
                        ->locale('id')
                        ->translatedFormat('l, j F Y');
            })
            ->editColumn('order.schedule',function($query){
                $startAt = Carbon::parse($query->order->start_at)->format('H:i');
                $endAt = Carbon::parse($query->order->end_at)->format('H:i');
                return "$startAt - $endAt WIB";
            })
            ->make(true);
    }
}
