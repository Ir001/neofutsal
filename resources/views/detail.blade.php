@extends('theme.theme')
@section('title','Booking Online Futsal')
@section('content')
{{-- Slider --}}
<div id="slider" class="my-3">
    <div class="swiper-container h-36 md:h-64">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide">
                <img src="https://smktrimulia.sch.id/wp-content/uploads/2020/09/Ilustrasi-futsal-istimewa8f521491d609bc2c.jpg"
                    class="object-cover h-36 md:h-64 w-full rounded" alt="">
            </div>
            <div class="swiper-slide">
                <img src="https://d10dnch8g6iuzs.cloudfront.net/pictures/480x306/picture/92620190718180021549"
                    class="object-cover h-36 md:h-64 w-full rounded" alt="">
            </div>
        </div>
    </div>
</div>
{{-- End of Slider --}}
<h1 class="text-md text-black font-semibold border-b-2 border-primary pb-3">Informasi Lapangan</h1>
<div id="description" class="my-3">
    <p>
        <i class="fas fa-money-bill"></i> Sewa / Jam : Rp. 75,000
    </p>
    <p>
        <i class="fas fa-ruler-combined"></i> Luas Lapangan : 25m x 16m
    </p>
    <p>
        <i class="fas fa-list"></i> Jenis Lapangan : Sintetis
    </p>
    <p>
        <i class="fas fa-futbol"></i> Bola Tersedia : <span class="badge-ball">Kecil</span>, <span
            class="badge-ball">Besar</span>,
        <span class="badge-ball">Original</span>
    </p>
</div>
<h1 class="text-md text-black font-semibold border-b-2 border-primary pb-3">Pilih Jadwal</h1>
<form action="{{route('check-schedule')}}" method="post">
    @csrf
    <div class="w-full">
        <label>Hari, Tanggal</label>
        <input type="date" name="day">
    </div>
    <div class="flex justify-between my-3 space-x-2">
        <div class="w-1/2">
            <label>Jam Mulai</label>
            <input type="text" name="start_at" placeholder="Jam Mulai" class="timepicker">
        </div>
        <div class="w-1/2">
            <label>Jam Selesai</label>
            <input type="text" name="end_at" placeholder="Jam Selesai" class="timepicker">
        </div>
    </div>
    <button type="submit" class="btn-primary">
        Cek Ketersediaan
    </button>
</form>

@endsection
@section('css')
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css" />
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
{{-- jquery timepicker --}}
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
@endsection
@section('js')
<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
{{-- jquery timepicker --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
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
        $('.timepicker').timepicker({
            timeFormat: 'HH:mm',
            interval: 60,
            minTime: '08:00',
            maxTime: '21:00',
            startTime: '08:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true,
            zindex : 9999,
        });
    // on Submit
    $('form').submit(function(e){
        e.preventDefault();
        const URL  = $(this).attr('action');
        const TYPE  = $(this).attr('method');
        const DATA = $(this).serialize();
        $.ajax({
            url : URL,
            type : TYPE,
            data : DATA,
            dataType : 'json',
            success : function(data){
                if(data?.success){
                    return toastr('success',data?.message, `<a href='?schedule=${data?.data}'> Check</a>`);
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


   })
</script>
@endsection
