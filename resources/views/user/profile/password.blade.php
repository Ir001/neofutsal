@extends('theme.theme')
@section('title','Edit Profile')
@section('content')
<div class="px-2 py-3 bg-white rounded">
    <div class="flex justify-between items-center pb-3 border-b">
        <h1 class="text-gray-600">Ganti Password</h1>
        <a href="{{route('app.profile')}}" class="-mt-2 text-sm text-gray-500">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
   <form action="{{ route('app.profile.password') }}" method="post">
    @csrf
    @method("PATCH")
       <div class="mb-3">
           <label>Password Sekarang</label>
            <input type="password" name="old_password" placeholder="Password Sekarang">
        </div>
       <div class="mb-3">
           <label>Password Baru</label>
            <input type="password" name="password" placeholder="Password Baru">
        </div>
       <div class="mb-3">
           <label>Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password Baru">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn-primary">
                Simpan
            </button>
        </div>
   </form>

</div>
@endsection
@section('css')
@endsection
@section('js')
@endsection
