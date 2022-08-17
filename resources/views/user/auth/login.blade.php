@extends('theme.theme')
@section('title','Login')
@section('content')
<div class="mt-20 h-full align-middle flex justify-center items-center flex-col">
    <div class=" bg-white shadow-xl px-4 py-4 rounded-lg w-full md:max-w-sm">
        <h1 class="text-3xl text-dark font-extrabold text-center">Login</h1>

        <form action="{{route('login')}}" method="post" id="formLogin">
            @csrf
            <div class="mb-3">
                <label>Email</label>
                <input type="email" class="bg-gray-100" name="email" placeholder="Email Anda" value="user@neofutsal.id">
            </div>
            <div class="mb-3">
                <div class="flex justify-between mb-2">
                    <label>Password</label>
                    <a href="" tabindex="-1" class="text-primary text-xs small">Forgot Password</a>
                </div>
                <input type="password" class="bg-gray-100" name="password" placeholder="Password" value="neofutsal">
            </div>
            <div class="mb-3">
                <label class="flex justify-start">
                    <input type="checkbox" name="remember_me" class="p-5 mr-3" value="1">
                    <p>Remember Me</p>
                </label>
            </div>
            <button type="submit" class="btn-primary" type="submit">
                Login
            </button>
            <p class="mt-3 text-sm font-medium text-gray-600">
                Don't have an account? <a href="{{route('register')}}" class="text-primary">Register</a>
            </p>
        </form>
    </div>
</div>
@endsection
@section('css')
@endsection
@section('js')
<script>
    $(document).ready(function(){
        $('#formLogin').submit(function(e){
            e.preventDefault();
            let button = $(this).find('button[type=submit]');
            let buttonEl = button.html();
            button.html(`<i class="fas fa-spin fa-spinner"></i>`);
            button.attr('disabled', true);
            $.ajax({
                type : 'post',
                url : $(this).attr('action'),
                data : $(this).serialize(),
                dataType : 'json',
                success : function(response){
                    button.html(buttonEl);
                    button.attr('disabled', false);
                    if(response?.success){
                        toastr("success",response?.message);
                        return window.location.href="{{url()->previous()}}";
                    }
                    return toastr("error",response?.message);
                }
            })
        })
    })
</script>
@endsection
