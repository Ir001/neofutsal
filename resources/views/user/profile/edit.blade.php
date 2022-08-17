@extends('theme.theme')
@section('title','Edit Profile')
@section('content')
<div class="px-2 py-3 bg-white rounded">
    <div class="flex justify-between items-center pb-3 border-b">
        <h1 class="text-gray-600">Update Profile</h1>
        <a href="{{route('app.profile')}}" class="-mt-2 text-sm text-gray-500">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
   <form action="{{ route("app.profile.edit") }}" method="POST">
       @csrf
       @method("PATCH")
       <div class="mb-3">
           <label>Fullname</label>
            <input type="text" name="name" value="{{ old('name',$user->name) }}" placeholder="Fullname">
        </div>
       <div class="mb-3">
           <label>WhatsApp</label>
            <input type="text" name="phone" value="{{ old('phone',$user->phone) }}" placeholder="WhatsApp">
        </div>
        <div class="mb-3">
            <button class="btn-primary">
                Save Changes
            </button>
        </div>
   </form>

</div>
@endsection
@section('css')
@endsection
@section('js')
@endsection
