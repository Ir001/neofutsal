<div
    class="flex justify-between bg-white px-8 py-4 rounded-t fixed max-w-3xl w-full inset-x-0 mx-auto bottom-0 border-t-2">
    <a href="{{url("/")}}" class="text-primary text-center">
        <i class="fas fa-xl fa-home text-xl"></i>
        <small class="text-xs block">Home</small>
    </a>
    <a href="" class="text-gray-400 ml-3 text-center">
        <i class="fas fa-xl fa-receipt text-xl"></i>
        <small class="text-xs block">My Order</small>
    </a>
    <a href="" class="text-gray-400 ml-3 text-center">
        @auth
        <i class="fas fa-xl fa-user text-xl"></i>
        <small class="text-xs block">Profile</small>
        @else
        <i class="fas fa-xl fa-sign-in-alt text-xl"></i>
        <small class="text-xs block">Login</small>
        @endauth
    </a>
</div>
