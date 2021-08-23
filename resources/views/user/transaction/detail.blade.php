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
            {{ $transaction->order->futsal_field->name }}
        </h2>
    </div>
    <div>
        <h2 class="text-dark text-lg font-medium">
            Informasi Jadwal
        </h2>
        <div class="pl-2">
            <p class="mb-3 text-gray-500 text-sm font-medium"><i class="fas fa-xs fa-calendar"></i> {{$schedule}}
            </p>
            <p class="text-gray-500 text-sm font-medium"><i class="fas fa-xs fa-clock"></i> {{ $timeStart }} - {{ $timeEnd }} WIB ({{ $transaction->order->hours }}
                jam)
            </p>
        </div>
        <h2 class="text-dark text-lg font-medium">
            Informasi Transaksi
        </h2>
        <div class="pl-2">
            
            <div class="flex justify-between items-center">
                <p class="text-gray-600 text-sm font-medium">
                    Jenis Pembayaran
                </p>
                <p class="py-1 px-3 text-white text-xs font-medium {{ $transaction->transaction_type_id == 2 ? 'bg-green-500' : 'bg-blue-500' }} rounded-md">
                    {{ $transaction->transaction_type->name }}
                </p>
            </div>
            <div class="flex justify-between items-center">
                <p class="text-gray-600 text-sm font-medium">
                    Status
                </p>
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
            <div class="flex justify-between items-center">
                <p class="my-1 text-gray-600 text-sm font-medium">
                    Subtotal
                </p>
                <p class="my-1 text-gray-500 text-sm font-medium">
                    {{ $transaction->order->hours }} jam x Rp. {{ number_format($transaction->order->price) }}
                </p>
            </div>
            <div class="flex justify-between items-center">
                <p class="text-gray-600 text-sm font-medium">
                    Total
                </p>
                <p class="text-gray-500 text-sm font-medium">
                    Rp. {{ number_format($transaction->order->hours * $transaction->order->price) }}
                </p>
            </div>
            <div class="flex justify-between items-center">
                <p class="text-gray-600 text-sm font-medium">
                    Jumlah Tagihan
                </p>
                <p class="text-green-500 text-xl font-medium">
                    Rp. {{ number_format($transaction->amount+$transaction->code) }}
                </p>
            </div>
            <div class="flex justify-between items-start flex-col space-y-2">
                <p class="text-gray-600 text-sm font-medium">
                    Metode Pembayaran
                </p>
                <p class="text-gray-500 text-sm font-medium">
                   {{$transaction->payment_type->bank_name}} ({{ $transaction->payment_type->bank_code }})
                </p>
            </div>
            <div class="flex justify-between items-start flex-col space-y-2">
                <p class="text-gray-600 text-sm font-medium">
                    Nomor Rekening
                </p>
                <p class="text-gray-500 text-sm font-medium">
                   {{$transaction->payment_type->bank_account}}
                </p>
            </div>
           @if ($transaction->status_transaction_id > 2)
            <div class="flex justify-between items-start flex-col space-y-2">
                <p class="text-gray-600 text-sm font-medium">
                    Instruksi Pembayaran
                </p>
                <div class="text-gray-500 text-sm font-medium leading-8">
                {!! $transaction->payment_type->instruction !!}
                </div>
            </div>
           @endif

            @if ($transaction->order->status_transaction_id < 3)
            <form class="flex flex-col items-center align-middle" action="{{ route('app.transaction.pay',['transaction'=>$transaction->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="proof_file" class="hidden">
                <div class="upload border border-indigo-500 rounded cursor-pointer w-full">
                    <p class="px-3 py-4 text-sm text-indigo-500 text-center">
                        <i class="fas fa-file-alt text-xl mr-3"></i> 
                        <span id="uploadText">Upload Bukti Pembayaran</span>
                        <span class="text-xs block text-gray-400">png/jpg</span>
                    </p>
                </div>
                <img src="{{ asset("images/logo-neofutsal.png") }}" onerror="previewError()" class="object-cover w-56 border rounded upload cursor-pointer hidden" alt="Foto Bukti Pembayaran" id="preview">
                <button type="submit" class="btn-primary block">
                    Verifikasi Pembayaran   
                </button>
            </form>
            @endif

        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function(){
        
        const uploadHtml = $('#upload p').html();
        $('.upload').click(function(){
            $('input[name=proof_file]').click();
        })
        $('input[name=proof_file]').change(function(){
            $('div.upload').addClass('hidden');
            let images = ``;
            const files = document.querySelector('input[name="proof_file"]').files;
            if(files[0]){
                const src = URL.createObjectURL(files[0]);
                $('#preview').attr('src',src);
                $('#preview').removeClass("hidden");
            }else{
                $('.upload').addClass('hidden');
                $('div.upload').removeClass('hidden');
            }
        })
        

    })
    function previewError(){
        toastr("error","Tidak dapat menampilkan preview! Periksa format gambar");
        $('.upload').addClass('hidden');
        $('div.upload').removeClass('hidden');
    }
</script>
@endsection
