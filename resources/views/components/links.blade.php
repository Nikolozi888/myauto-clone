<div class="flex items-center space-x-6">
    <a href="{{ route('index') }}" class="bg-orange-500 text-white px-4 py-2 rounded-md">ფილტრი</a>
    <div class="flex items-center space-x-1">
        <a href="{{ route('cars') }}">ყველა ავტომობილი</a>
    </div>
    @guest
        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-500 underline">ავტორიზაცია</a>
        <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-500 underline">რეგისტრაცია</a>
    @endguest

    @can('user')
        <div class="relative inline-block dropdown">
            <a href="#"
                class="hover:text-blue-500 text-lg underline bg-yellow-300 p-2 rounded-xl">{{ auth()->user()->name }}</a>
            <div class="dropdown-menu">
                <a href="{{ route('userProfile') }}">პროფილი</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="submit-button" type="submit">გასვლა</button>
                </form>
            </div>
        </div>
    @endcan

    @can('admin')
        <div class="relative inline-block dropdown m-5">
            <a href="#"
                class="hover:text-blue-500 text-lg underline bg-yellow-300 p-2 rounded-xl">{{ auth()->user()->name }}</a>
            <div class="dropdown-menu">
                <a href="{{ route('adminProfile') }}">დეშბორდი</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="submit-button" type="submit">გასვლა</button>
                </form>
            </div>
        </div>
    @endcan
</div>
