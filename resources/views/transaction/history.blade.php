@extends('theme.theme')
@section('title','Transaksi')
@section('content')
<div class="my-3 flex justify-between items-center space-x-0">
    <div class="order-flex">
        <a href="{{route('app.transaction')}}">Order</a>
    </div>
    <div class="order-flex active">
        <a href="#">History</a>
    </div>
</div>
<div id="transaction">
    <x-transaction-card></x-transaction-card>
</div>
@endsection
