@extends('theme.theme')
@section('title','Transaksi')
@section('content')
<div class="my-3 flex justify-between items-center space-x-0">
    <div class="order-flex active">
        <a href="#">Order</a>
    </div>
    <div class="order-flex">
        <a href="{{route('app.transaction.history')}}">History</a>
    </div>
</div>
<div id="order" class="flex flex-col md:flex-row space-y-2 md:space-y-0">
    @foreach ($orders as $order)
        <x-transaction-card :order="$order"></x-transaction-card>
    @endforeach
</div>
@endsection
