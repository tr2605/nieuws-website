<nav class="p-4 bg-green-500">
    <div class="px-4 mx-auto max-w-7xl">
        <div class="flex items-center justify-between">
            <div>
                <a href="{{ route('welcome') }}" class="text-xl font-bold text-white">Nova Nieuws</a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="ml-4 text-white">Nieuws</a>
                <a href="{{ route('profile.edit') }}" class="ml-4 text-white">Profile</a>
                @guest
                    <a href="{{ route('login') }}" class="ml-4 text-white">Login</a>
                    <a href="{{ route('register') }}" class="ml-4 text-white">Register</a>
                @else
                    <form method="POST" action="{{ route('logout') }}" class="ml-4">
                        @csrf
                        <button type="submit" class="text-white">Logout</button>
                    </form>
                @endguest
            </div>
        </div>
    </div>
</nav>