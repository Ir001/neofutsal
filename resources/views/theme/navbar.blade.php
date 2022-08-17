<nav
    class="flex justify-between bg-white px-8 py-4 rounded-t fixed max-w-3xl w-full inset-x-0 mx-auto bottom-0 border-t-2 z-50">
    <a href="{{route('app')}}" class="{{request()->routeIs('app') ? 'active' : null }}">
        <i class="fas fa-xl fa-home text-xl"></i>
        <small class="text-xs block">Home</small>
    </a>
    <a href="{{route('app.transaction')}}" class="{{request()->routeIs('app.transaction.*') || request()->routeIs('app.transaction') ? 'active' : null }}">
        <i class="fas fa-xl fa-receipt text-xl"></i>
        <small class="text-xs block">Transaction</small>
    </a>
    @auth
    <a href="{{route('app.profile')}}" class="{{request()->routeIs('app.profile') ? 'active' : null }}">
        <i class="fas fa-xl fa-user text-xl"></i>
        <small class="text-xs block">Profile</small>
    </a>
    @else
    <a href="{{route('login')}}"
        class="{{request()->routeIs('login') ? 'active' : (request()->routeIs('register') ? 'active' : null) }}">
        <i class="fas fa-xl fa-sign-in-alt text-xl"></i>
        <small class="text-xs block">Login</small>
    </a>
    @endauth
</nav>
