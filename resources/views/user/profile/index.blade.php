@extends('theme.theme')
@section('title','My Profile')
@section('content')
<div class="px-2 py-4 bg-white rounded">
    <div class="flex justify-end">
        <a href="{{route('app.profile.edit')}}" class="-mt-2 text-sm text-gray-500">
            <i class="fas fa-pen"></i> Edit
        </a>
    </div>
    <div class="mx-auto rounded-full bg-primary w-20 h-20 flex justify-center items-center overflow-hidden">
        {{-- <span class="text-4xl text-white"><i class="fas fa-camera"></i></span> --}}
        <img src="https://www.pngarts.com/files/11/Avatar-PNG-Transparent-Image.png" alt="Foto Profile" class="object-cover">
    </div>
    <h2 class="text-2xl font-extrabold text-primary text-center">{{$user->name}}</h2>
    <div class="my-2 px-2 py-3 border border-gray-200 rounded flex space-x-2 items-center">
        <div>
            <span class="text-3xl text-primary"><i class="fas fa-calendar-alt"></i></span>
        </div>
        <div>
            <p class="text-gray-900">Join Date</p>
            <p class="text-sm text-gray-500">{{ $user->created_at->locale('id')->translatedFormat('l, d F Y') }}</p>
        </div>
    </div>
    <div class="my-2 px-2 py-3 border border-gray-200 rounded flex space-x-2 items-center">
        <div>
            <span class="text-3xl text-primary"><i class="fas fa-envelope"></i></span>
        </div>
        <div>
            <p class="text-gray-900">Email</p>
            <p class="text-sm text-gray-500">{{ $user->email }}</p>
        </div>
    </div>
    <div class="my-2 px-2 py-3 border border-gray-200 rounded flex space-x-2 items-center">
        <div>
            <span class="text-3xl text-primary"><i class="fab fa-whatsapp"></i></span>
        </div>
        <div>
            <p class="text-gray-900">WhatsApp</p>
            <p class="text-sm text-gray-500">{{ @$user->phone ? $user->phone : '-' }}</p>
        </div>
    </div>
    <a href="{{route('app.profile.password')}}" class="btn-gray mb-1 block">Change Password</a>
    <form action="{{route('logout')}}" method="post" id="formLogout">
        @csrf
        <button type="submit" class="btn bg-red-500 text-white">
            Logout
        </button>
    </form>
</div>
@endsection
@section('css')
@endsection
@section('js')
<script>
    $(document).ready(function(){
        $('#formLogout button').click(function(e){
            e.preventDefault();
            Swal.fire({
                html: 'Apakah Anda Yakin Ingin Keluar?',
                showCancelButton: true,
                confirmButtonText: `Keluar`,
                cancelButtonText : `Batal`
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).parent().submit();
                }
            });
        })
    })
</script>
@endsection
