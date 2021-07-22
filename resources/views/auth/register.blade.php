@extends('theme.theme')
@section('title','Daftar')
@section('content')
<div class="mt-5 h-full align-middle flex justify-center items-center flex-col">
    <div class=" bg-white shadow-xl px-4 py-4 rounded-lg w-full md:max-w-sm">
        <h1 class="text-3xl text-dark font-extrabold text-center">Daftar</h1>
        <form action="" method="post">
            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" class="bg-gray-100" name="fullname" placeholder="Irwan Antonio">
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" class="bg-gray-100" name="email" placeholder="irwan@neofutsal.id">
            </div>
            <div class="mb-3">
                <label>WhatsApp</label>
                {{-- +62822 4344 0959 --}}
                <input type="tel" class="bg-gray-100" name="phone" inputmode="tel" placeholder="+62812-3456-7890">
            </div>
            <div class="mb-3">
                <label>Kata Sandi</label>
                <input type="password" class="bg-gray-100" name="password" placeholder="Kata Sandi">
            </div>
            <div class="mb-3">
                <label class="flex justify-start">
                    <input type="checkbox" name="remember_me" class="p-5 mr-3" value="1">
                    <p>Saya setuju dengan <a href="" class="text-primary">S&K</a> yang berlaku</p>
                </label>
            </div>
            <button class="btn-primary" type="submit">
                Daftar
            </button>
        </form>
    </div>
</div>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css"
    integrity="sha512-gxWow8Mo6q6pLa1XH/CcH8JyiSDEtiwJV78E+D+QP0EVasFs8wKXq16G8CLD4CJ2SnonHr4Lm/yY2fSI2+cbmw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput.min.js"
    integrity="sha512-QMUqEPmhXq1f3DnAVdXvu40C8nbTgxvBGvNruP6RFacy3zWKbNTmx7rdQVVM2gkd2auCWhlPYtcW2tHwzso4SA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function(){
        const phone = document.querySelector("input[name=phone]");
        const phoneInput = window.intlTelInput(phone, {
            utilsScript : 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.min.js',
            initialCountry : "id"
        });
        //on Keyup
        $('input[name=phone]').keyup(function(e){
            e.preventDefault();
            let val = $(this).val().replaceAll('-','');
            let length = val.length;
            if(length > 12){
                val = val.substring(0,length-1);
            }
            let match = val.match(/.{1,4}/g);
            console.log(match);
            let str = ``;
            match.map((value,index)=>{
                if(index+1 >= match.length){
                    str+=`${value}`;
                }else{
                    str+=`${value}-`;
                }
            })
            $(this).val(str);
        })
        //on Submit
        $('form').submit(function(e){
            e.preventDefault();
            console.log(phoneInput.getNumber());
        })
    })
</script>
@endsection
