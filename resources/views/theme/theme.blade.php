<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('css')
    <title>Hijau Bola - @yield('title')</title>
</head>

<body class="bg-gray-100">
    {{-- Navbar --}}
    @include('theme.navbar')
    {{-- End Navbar --}}
    <div class="max-w-3xl mx-auto bg-gray-100 rounded-md min-h-screen overflow-hidden mb-16">
        {{-- Content --}}
        <div id="content" class="px-8 py-4">
            {{-- Header --}}
            <div class="flex justify-between align-middle items-center">
                <div id="logo">
                    <a href="/">
                        <h1 class="text-2xl text-success font-extrabold"><i class="fas fa-xl text-3xl fa-futbol"></i>
                            Hijau
                            Bola</h1>
                    </a>
                </div>
                <div>
                    <a href="" class="text-3xl text-gray-400">
                        <i class="fas fa-xs fa-bell"></i>
                    </a>
                </div>
            </div>
            {{-- End of Header --}}
            {{-- Content --}}
            @yield('content')
            {{-- End of Content --}}
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- Font Awesome --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
        integrity="sha512-RXf+QSDCUQs5uwRKaDoXt55jygZZm2V++WUZduaU/Ui/9EGp3f/2KZVahFZBKGH0s774sd3HmrhUy+SgOFQLVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- Sweetalert2 --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let toastr = (type, msg, btn=null)=>{
            Swal.fire({
                icon : type,
                text : msg,
                showConfirmButton : (btn == null ? false : true),
                confirmButtonText : btn,
            })
        }
    </script>
    @yield('js')
</body>

</html>
