<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- Extra details for Live View on GitHub Pages -->
    <title>
        Neofutsal - @yield('title')
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="{{ asset('assets') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/now-ui-dashboard.css?v=1.3.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('assets') }}/demo/demo.css" rel="stylesheet" />
</head>

<body class="{{ $class ?? '' }}">
    <div class="wrapper">
        @auth
        @include('layouts.page_template.auth')
        @endauth
        @guest
        @include('layouts.page_template.guest')
        @endguest
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('assets') }}/js/core/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('assets') }}/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chart JS -->
    <script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="{{ asset('assets') }}/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets') }}/js/now-ui-dashboard.min.js?v=1.3.0" type="text/javascript"></script>
    <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{ asset('assets') }}/demo/demo.js"></script>
    {{-- Sweetalert2 --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let toastr = (type, msg, btn=null)=>{
            Swal.fire({
                icon : type,
                html : msg,
                showConfirmButton : (btn == null ? false : true),
                confirmButtonText : btn,
            })
        }
    </script>
    <script>
        //show Errors
        let showErrors = (errors) => {
            if (errors != undefined && data?.success == false && Object.keys(errors).length > 0) {
                let html = `<ul>`;
                Object.keys(errors).forEach(key => {
                    html+=errors[key];
                });
                html+=`</ul>`;
                toastr('error',html,'Saya Paham');
            }
        }
        let submitForm = (req)=>{
            let htmlButton = req?.button?.html();
            req?.button?.html(`Menunggu <i class='fas fa-spin fa-spinner'></i>`);
            req?.button?.attr('disabled',true);
            let resetButton = ()=>{
                req?.button?.attr('disabled',false);
                req?.button?.html(htmlButton);
            }
            $.ajax({
                url : req?.url,
                type : req?.type,
                data : req?.data,
                dataType : 'json',
                success : function(res){
                    resetButton();
                    if(res?.success){
                        req?.successCallback();
                        return toastr('success',res?.message);
                    }
                    toastr('error',res?.message);
                    if(res?.error){
                        showErrors('error',res?.errors);
                    }
                },
                error : function(xhr,status,err){
                    toastr('error',err,'Kembali');
                    resetButton();
                }
            })
        }
    </script>
    @stack('js')
</body>

</html>
