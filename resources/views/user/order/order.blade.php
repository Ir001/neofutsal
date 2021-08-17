@extends('theme.theme')
@section('title','Checkout')
@section('content')
<div class="mt-2 pb-3 mb-2 border-b flex justify-between items-center">
    <h1 class="text-md text-dark font-semibold">Review Order</h1>
    <a href="#" onclick="return window.history.go(-1)" class="py-2 text-xs font-medium text-gray-500"><i
            class="fas fa-xs fa-arrow-left"></i> Kembali</a>
</div>
<div id="description" class="my-3">
    <p>
        <i class="fas mr-2 fa-futbol"></i> {{$field->name}} (Rp. {{number_format($field->price)}} / jam)
    </p>
    <p><i class="fas mr-2 fa-calendar"></i> {{$dateReadable}}</p>
    <p><i class="fas mr-2 fa-clock"></i> {{$schedule->start_at}} - {{$schedule->end_at}} WIB ({{$hours}} jam)</p>
</div>
<h1 class="text-md text-dark font-semibold border-b-2 pb-3 mb-2">Informasi Harga</h1>
<form action="{{route('booking',['field'=>$field->id])}}" method="post">
    @csrf
    <input type="hidden" name="schedule" value="{{request()->schedule}}">
    <div class="w-full mb-3">
        <label>Pilih Jenis Pembayaran</label>
        <input type="hidden" name="transaction_type_id" value="1" id="transaction_type">
        <div class="flex justify-between space-x-2">
            <div class="active payment-radio" data-id="1">
                <p class="text-xl icon"><i class="fas fa-xs fa-check-circle"></i></p>
                <p class="font-medium">Down Payment 50%</p>
            </div>
            <div class="payment-radio" data-id="2">
                <p class="text-xl icon"><i class="far fa-xs fa-circle"></i></p>
                <p class="font-medium">Bayar Full</p>
            </div>
        </div>
    </div>
    <div class="w-full mb-3">
        <label>Pilih Metode Pembayaran</label>
        <select name="payment_type_id" class="form-select bg-white">
            <option value="" selected disabled>Pilih Metode Pembayaran</option>
            @foreach ($paymentTypes as $type)
            <option value="{{$type->id}}">{{$type->bank_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="w-full mb-3">
        <div class="flex justify-between mb-3">
            <p>Harga Sewa</p>
            <p>{{$hours}} x Rp. {{number_format($field->price)}}</p>
        </div>
        <div class="flex justify-between mb-3">
            <p>Total</p>
            <p id="total">Rp. {{number_format($priceTotal)}}</p>
        </div>
        <div class="flex justify-between mb-3 border-t border-gray-400">
            <p>DP</p>
            <p class="text-success text-2xl" id="dp">Rp. {{number_format($downPayment)}}</p>
        </div>
    </div>
    <button type="submit" class="btn-gray transition duration-500" disabled>
        Booking
    </button>
</form>

@endsection
@section('css')
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
{{-- pickdate js --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.4/themes/default.css"
    integrity="sha512-x9ZSPqJJfUhtPuo+fw6331wHeC3vhDpNI3Iu4KC05zJrxx7MWYewaDaASGxAUgWyrwU50oFn6Xk0CrQnTSuoOA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.4/themes/default.date.css"
    integrity="sha512-Ix4qjGzOeoBtc8sdu1i79G1Gxy6azm56P4z+KFl+po7kOtlKhYSJdquftaI4hj1USIahQuZq5xpg7WgRykDJPA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.4/themes/default.time.css"
    integrity="sha512-OVCdZvsw/MeYx12cD+0Cmw/TA5Iw3bJXM4dpSIxXmDK3X5erHyETXkB3OGqnNQ72sL4UOuyTH9kdWds2MGYcBQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('js')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
{{-- pickdate js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.4/picker.js"
    integrity="sha512-VQa5Pmc87GQrifaBaI+ejCQBHkca6yhwKH+iFihubE4Mf3NSj0jVN3cppGHPlFSa2MRmAD7xwuZ8fr9DOHUsgw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.4/picker.date.js"
    integrity="sha512-4UAypxd5+OVqRf2SeJTnkd+W47HoLnpHjwannVikXGsgJxH2Hl+SBDM9UYyi+3hpNc16aaGeOu5RvesbSwlRlA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.4/picker.time.js"
    integrity="sha512-j3HVwMQuwEYegEnNfKlQ/paV3/b7TB4/Ul9bYIjBKiwbIXGQ/mzs3H+wqfvNo/7mKtNXUZnQWHDj3xNrNNA/7w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- Languge ID --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/pickadate.js/3.6.4/translations/id_ID.js"
    integrity="sha512-H0M7Dt6trlnUdVMlngUxUWFoLxaPOn4g3GggDu+pvy72Lx43NyDr+Rwp6kt0/PNYnueVvHYLmvDGxx80YfQ1og=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    const swiper = new Swiper('.swiper-container', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,
        autoplay: true,
        delay : 2000,
        });
</script>
<script>
    $(document).ready(function(){
        //    Timepicker
        $('.timepicker').pickatime({
            clear : 'Hapus',
            format : 'HH:i',
            interval : 60,
            max : [21,0],
            min : [8,0]
        });
        $('input[type=date]').pickadate({
            today : 'Hari ini',
            clear : 'Hapus',
            close : 'Batal',
            min : 0,
            formatSubmit: 'yyyy-mm-dd',
            hiddenSuffix : '',
        });
        //custom radio
        $('.payment-radio').click(function(){
            let id = $(this).attr('data-id');
            let icon = $(this).find('.icon');
            let check = `<i class="fas fa-xs fa-check-circle">`;
            let unCheck = `<i class="far fa-xs fa-circle">`;
            $('.payment-radio').removeClass('active');
            $('.payment-radio').find('.icon').html(unCheck);
            $(this).addClass('active');
            icon.html(check);
            $('#transaction_type').val(id);
            checkPaymentType(id);
        })
        //select on change
        $('select').change(function(){
            $('button[type=submit]').attr('disabled',false);
            $('button[type=submit]').removeClass('btn-gray').addClass('btn-primary');
        })
        // on Submit
        $('form').submit(function(e){
            e.preventDefault();
            $.ajax({
                url : $(this).attr('action'),
                type : $(this).attr('method'),
                data : $(this).serialize(),
                dataType : 'json',
                success : function(data){
                    if(data?.success){
                        return toastr('success',data?.message, `<a href='/transaction/${data?.data?.transactionId}'> Bayar</a>`);
                    }
                    if(data?.error){
                        return toastr('error', data?.message, `Tutup`);
                    }
                    return toastr('error', data?.message, `Tutup`);
                },
                error : function(xhr, status,err){
                    if(xhr?.status == 401){
                        return toastr('error',`Masuk atau Buat Akun terlebih dahulu!`,`<a href='{{route('login')}}'>Masuk</a>`);
                    }
                    toastr('error',err);
                }
            })
        })
    })
    function checkPaymentType(type){
        let activeClass = `text-success text-2xl`;
        let separator = `border-t border-gray-400`;
        let dp = $('#dp');
        let dpParent =  dp.parent();
        let total = $('#total');
        let totalParent =  total.parent();
        if(type == 1){ //DP
            dpParent.removeClass('hidden');
            dpParent.addClass(separator);
            totalParent.removeClass(separator);
            total.removeClass(activeClass);
        }else{
            dpParent.removeClass(separator);
            totalParent.addClass(separator);
            total.addClass(`${activeClass}`);
            dpParent.addClass('hidden');
        }
    }
</script>
@endsection