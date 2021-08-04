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
<h1 class="text-md text-dark font-semibold border-b-2 pb-3">Booking Online</h1>
<div class="my-3 grid grid-flow-row grid-cols-1 md:grid-cols-3 gap-4 auto-rows-max">
    @foreach ($futsal_fields as $field)
        <x-product-card :field="$field"/>
    @endforeach
</div>
@endsection
@section('css')
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endsection
@section('js')
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
