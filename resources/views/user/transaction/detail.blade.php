@extends('theme.theme')
@section('title','Detail')
@section('content')
<div class="my-3 flex justify-between items-center space-x-2 border-b-2 pb-3">
    <h1 class="text-md text-dark font-semibold">Detail Transaksi</h1>
    <a href="#" onclick="return window.history.go(-1)" class="text-sm text-gray-400">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>
<div class="card-transaction">
    <div class="card-header">
        <h2 class="text-dark text-2xl font-medium">
            Lapangan X
        </h2>
    </div>
    <div>
        <div>
            <button id="btn-barcode" class="text-center text-sm font-medium text-info w-full">
                Tampilkan Barcode
            </button>
            <div id="barcode" class="justify-center hidden"></div>
        </div>
        <h2 class="text-dark text-md font-medium">
            Informasi Jadwal
        </h2>
        <div class="pl-2">
            <p class="my-1 text-gray-600 text-sm font-medium"><i class="fas fa-xs fa-calendar"></i> Kamis, 26 Agustus
                2021
            </p>
            <p class="my-1 text-gray-600 text-sm font-medium"><i class="fas fa-xs fa-clock"></i> 08:00 - 10:00 WIB (2
                jam)
            </p>
        </div>
        <h2 class="text-dark text-md font-medium">
            Informasi Transaksi
        </h2>
        <div class="pl-2">
            <div class="flex justify-between items-center">
                <p class="my-1 text-gray-600 text-sm font-medium">
                    Subtotal
                </p>
                <p class="my-1 text-gray-600 text-sm font-medium">
                    2 jam x Rp. 75,000
                </p>
            </div>
            <div class="flex justify-between items-center">
                <p class="text-gray-600 text-sm font-medium">
                    Status
                </p>
                <span>
                    <p class="py-1 px-3 text-white text-xs font-medium bg-red-500 rounded-md">
                        Menunggu Pelunasan
                    </p>
                </span>
            </div>
            <div class="flex justify-between items-center">
                <p class="text-gray-600 text-sm font-medium">
                    Total
                </p>
                <p class="text-gray-600 text-sm font-medium">
                    150,000
                </p>
            </div>
            <div class="flex justify-between items-center">
                <p class="text-gray-600 text-sm font-medium">
                    Dibayar (DP)
                </p>
                <p class="text-gray-600 text-sm font-medium">
                    Rp. 75,000
                </p>
            </div>
            <div class="flex justify-between items-center">
                <p class="text-gray-600 text-sm font-medium">
                    Tagihan Tersisa
                </p>
                <p class="text-red-500 text-xl font-medium">
                    Rp. 75,000
                </p>
            </div>
            <a href="#" class="btn-primary block">
                Bayar Pelunasan
            </a>

        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/davidshimjs-qrcodejs@0.0.2/qrcode.min.js"></script>
<script>
    $(document).ready(function(){
        let qrcode = new QRCode(document.getElementById('barcode'),{
            text : 'test',
            correctLevel : QRCode.CorrectLevel.H,
        });
        $('#btn-barcode').click(function(){
            $('#barcode').removeClass('hidden').addClass('flex');
            $(this).addClass('hidden');
        });
        $('#barcode').click(function(){
            $('#btn-barcode').removeClass('hidden');
            $(this).addClass('hidden').removeClass('flex');
        });
    })
</script>
@endsection
