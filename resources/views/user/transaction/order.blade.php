@extends('theme.theme')
@section('title','Transaksi')
@section('content')
<div class="bg-white shadow-lg px-3 py-2 rounded">
    <div class="flex justify-between items-center mb-3">
        <h1 class="font-bold text-xl text-gray-600">
            Detail Order
        </h1>
        <a href="{{ route('app.transaction') }}" class="text-sm text-gray-400"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="py-2">
        <div class="flex items-start mb-4 flex-col space-y-1">
            <p class="text-sm text-gray-600"><i class="fas fa-futbol"></i> Info Lapangan</p>
            <p class="text-sm text-gray-500">{{ $order->futsal_field->name }} ({{ $order->futsal_field->field_type->name }})</p>
        </div>
        <div class="flex items-start mb-4 flex-col space-y-1">
            <p class="text-sm text-gray-600"><i class="fas fa-calendar"></i> Jadwal Sewa Lapangan</p>
            <p class="text-sm text-gray-500">{{ $timeStart }} - {{ $timeEnd }} WIB ({{ $order->hours }} Jam)</p>
            <p class="text-sm text-gray-500">{{ $schedule }}</p>
        </div>
        <div class="flex items-start mb-3 flex-col space-y-1">
            <p class="text-sm text-gray-600"><i class="fas fa-calendar-alt"></i> Waktu Booking</p>
            <p class="text-sm text-gray-500">{{ $order->created_at->format('H:i:s') }} WIB {{ $order->created_at->locale('id')->translatedFormat('l, F j Y') }}</p>
        </div>
    </div>
</div>
<div id="transaction" class="flex flex-col md:flex-row space-y-0 md:space-x-2 md:space-y-2">
    @foreach ($transactions as $transaction)
    <div class="card-transaction md:w-1/2 w-full">
        <div class="flex justify-start items-start flex-col">
            <p class="text-gray-500 font-medium"> Status </p>
            <span>
                @if ($transaction->is_valid == 1)
                    <p class="py-1 px-3 text-white text-xs font-medium bg-green-500 rounded-md">
                      Lunas
                    </p>
                @else
                    <p class="py-1 px-3 text-white text-xs font-medium {{ $transaction->order->status_transaction->color }} rounded-md">
                        {{ $transaction->order->status_transaction->name_user }}
                    </p>
                @endif
            </span>
        </div>
        <div class="flex justify-start items-start flex-col">
            <p class="text-gray-500">
                Jenis Pembayaran
            </p>
            <p class="py-1 px-3 text-white text-xs  {{ $transaction->transaction_type->id == 2 ? 'bg-green-500' : 'bg-blue-500' }} rounded-md">
                {{ $transaction->transaction_type->name }}
            </p>
        </div>
        <div class="flex justify-start items-start flex-col">
            <p class="text-gray-500 ">
                Expired
            </p>
            <p class="text-gray-400">
                {{ \Carbon\Carbon::parse($transaction->expired_payment)->locale('id')->diffForHumans() }}
            </p>
        </div>  
        <span>
            <p class="text-gray-500 font-medium">
                Jumlah Tagihan
            </p>
            <span class="flex justify-end">
                <p class="text-indigo-500 font-bold text-3xl">
                    Rp. {{ number_format($transaction->amount+$transaction->code) }}
                </p>
            </span>
        </span>  
        {{-- Footer --}}
        <div class="card-footer">
            <div class="flex-auto">
                <a href="{{ url("transaction/{$transaction->id}") }}" class="btn-primary block">Pembayaran</a>
            </div>
    
        </div>
    </div>

    @endforeach    
</div>
@endsection
