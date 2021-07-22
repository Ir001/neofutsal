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
<h1 class="text-md text-black font-semibold border-b-2 border-primary pb-3">Booking Online</h1>
<div class="my-3 grid grid-flow-row grid-cols-1 md:grid-cols-3 gap-2 auto-rows-max">
    @for ($i = 0; $i < 5; $i++) <div class="w-full bg-white shadow-sm rounded-md overflow-hidden" id="fields">
        <div class="img">
            <a href="/detail">
                <img src="https://smktrimulia.sch.id/wp-content/uploads/2020/09/Ilustrasi-futsal-istimewa8f521491d609bc2c.jpg"
                    alt="Foto Lapangan" class="object-cover w-full">
            </a>
        </div>
        <div class="description px-2 py-4">
            <a href="/detail">
                <h2 class="text-success font-medium text-xl">
                    Lapangan X
                </h2>
            </a>
            <div class="caption flex justify-between align-middle items-center">
                <p class="text-info">
                    <i class="fas fa-xs fa-money-bill-wave"></i>
                    <small class="font-light">
                        Rp. 75,000 / Jam
                    </small>
                </p>
                <p class="text-info">
                    <i class="fas fa-xs fa-ruler-combined"></i>
                    <small class="font-light">
                        25m x 16m
                    </small>
                </p>
            </div>
        </div>
        <div class="footer px-2 py-2 flex justify-end border-t-1">
            <a href="/detail" class="px-3 py-2 w-full font-semibold text-xs text-center rounded-md transition duration-500
                 bg-secondary hover:bg-primary text-primary hover:text-white">
                Info Detail
            </a>
        </div>
</div>
@endfor
</div>
@endsection
@section('css')
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css" />
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endsection
@section('js')
<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    const swiper = new Swiper('.swiper-container', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,
        autoplay: true,
        delay : 2000,
        });
</script>
@endsection
