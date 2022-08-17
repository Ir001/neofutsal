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
                <img src="{{ asset('images/banner/banner-1.png') }}" class="object-cover h-36 md:h-64 w-full rounded"
                    alt="">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/banner/banner-2.png') }}" class="object-cover h-36 md:h-64 w-full rounded"
                    alt="">
            </div>
        </div>
    </div>
</div>
{{-- End of Slider --}}
<h1 class="text-md text-dark font-semibold border-b-2 pb-3">Booking Now!</h1>
<div class="my-3 grid grid-flow-row grid-cols-1 md:grid-cols-3 gap-4 auto-rows-max">
    @foreach ($futsal_fields as $field)
    <x-product-card :field="$field" />
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