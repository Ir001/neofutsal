@extends('theme.theme')
@section('title','Transaksi')
@section('content')
<div class="my-3 flex justify-between items-center space-x-0">
    <div class="order-flex active">
        <a href="#">Order</a>
    </div>
</div>
<div id="order" class="flex flex-col md:flex-row space-y-2 md:space-y-0">
    @empty($orders)
        <p class="text-center text-gray-500 bg-white block w-full py-4 rounded shadow-md">
            <span class="text-3xl text-primary block">
                <i class="fas fa-sad-tear"></i>
            </span>
            Anda belum pernah memesan
        </p>
    @else
        @foreach ($orders as $order)
            <x-transaction-card :order="$order"></x-transaction-card>
        @endforeach
        {{ $orders->links() }}
    @endempty
</div>
@endsection
