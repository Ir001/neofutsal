@extends('theme.theme')
@section('title','Masuk')
@section('content')
<div class="mt-20 h-full align-middle flex justify-center items-center flex-col">
    <div class=" bg-white shadow-xl px-4 py-4 rounded-lg w-full md:max-w-sm">
        <h1 class="text-3xl text-dark font-extrabold text-center">Masuk</h1>

        <form action="" method="post">
            <div class="mb-3">
                <label>Email</label>
                <input type="email" class="bg-gray-100" name="email" placeholder="Email Anda">
            </div>
            <div class="mb-3">
                <div class="flex justify-between mb-2">
                    <label>Password</label>
                    <a href="" tabindex="-1" class="text-primary text-xs small">Lupa Password</a>
                </div>
                <input type="password" class="bg-gray-100" name="password" placeholder="Password">
            </div>
            <div class="mb-3">
                <label class="flex justify-start">
                    <input type="checkbox" name="remember_me" class="p-5 mr-3" value="1">
                    <p>Simpan Informasi Login</p>
                </label>
            </div>
            <button class="btn-primary" type="submit">
                Masuk
            </button>
            <p class="mt-3 text-sm font-medium text-gray-600">
                Belum punya akun? <a href="{{route('register')}}" class="text-primary">Daftar</a>
            </p>
        </form>
    </div>
</div>
@endsection
@section('css')
@endsection
@section('js')
@endsection
