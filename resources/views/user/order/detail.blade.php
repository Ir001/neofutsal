@extends('theme.theme')
@section('title','Booking Online Futsal')
@section('content')
<div class="flex justify-between {{ $imageExist ? 'space-x-2' : 'flex-col' }} mb-3" id="images">
    <div class="{{ $imageExist ? 'w-2/3' : 'w-full' }}">
        <img src="{{ asset($field->img) }}" class="object-cover rounded w-full h-32 md:h-64 transition-all duration-300" id="previewImg" alt="Foto Lapangan Futsal">
    </div>
    <div class="{{ $imageExist ? 'w-1/3' : 'hidden' }}">
        <div class="flex flex-col space-y-4 h-32 md:h-64 overflow-y-auto overflow-x-hidden">
            @foreach ($images as $image)
                <img src="{{ asset($image->img) }}" class="object-cover rounded w-full img-detail cursor-pointer transition-all duration-300" alt="Foto Lapangan Futsal">
            @endforeach
        </div>

    </div>
</div>
<h1 class="text-md text-black font-semibold border-b-2 pb-3 mb-2">Informasi Lapangan</h1>
<div id="description" class="my-3">
    <p>
        <i class="fas fa-money-bill"></i> Sewa per jam : Rp. {{number_format($field->price)}}
    </p>
    <p>
        <i class="fas fa-ruler-combined"></i> Luas Lapangan : {{$field->width}}m x {{$field->height}}m
    </p>
    <p>
        <i class="fas fa-list"></i> Jenis Lapangan : {{$field->field_type->name}}
    </p>
    <p>
        <i class="fas fa-futbol"></i> Bola Tersedia :
        @foreach ($ball_types as $ball)
        <span class="badge-ball">{{$ball->name}}</span>
        @endforeach
    </p>
</div>
<h1 class="text-md text-black font-semibold border-b-2 border-primary pb-3">Pilih Jadwal</h1>
<form action="{{route('check-schedule',['field' => $field->id])}}" method="post">
    @csrf
    <div class="w-full">
        <label>Hari, Tanggal</label>
        <input type="date" class="bg-white" name="day" placeholder="Hari, Tanggal">
    </div>
    <div class="flex justify-between my-3 space-x-2">
        <div class="w-1/2">
            <label>Jam Mulai</label>
            <input type="text" class="bg-white timepicker" name="start_at" placeholder="Jam Mulai" class="timepicker">
        </div>
        <div class="w-1/2">
            <label>Jam Selesai</label>
            <input type="text" class="bg-white timepicker" name="end_at" placeholder="Jam Selesai" class="timepicker">
        </div>
    </div>
    <button type="submit" class="btn-primary">
        Cek Ketersediaan
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
        direction: 'vertical',
        delay : 2000,
        spaceBetween: 15,
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
                    return toastr('success',data?.message, `<a href='{{url("order/$field->id")}}?schedule=${data?.data}'> Booking</a>`);
                }
                if(data?.error){
                    return toastr('error', data?.message, `Saya Paham`);
                }
                return toastr('error', data?.message, `Cari Jadwal Lain`);
            },
            error : function(xhr, status,err){
                toastr('error',err);
            }
        })
    })

    // Image Preview

    $('.img-detail').click(function(e){
        e.preventDefault();
        const src = $(this).attr('src');
        $('.img-detail').removeClass('border-2')
        $(this).addClass('border-2');
        $("#previewImg").attr('src',src);
    })


})
</script>
@endsection