<nav class="sticky top-0 z-20 shadow" style="background-color: #E4C4E2;" x-data="{ isOpen: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="flex-shrink-0 pr-5">
                    <img class="h-4 w-20" src="{{asset('image/periksa.png')}}" alt="periksa">
                    <!-- <img class="h-8 w-8" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company"> -->
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        @if (Auth::user()->nim!=null)
                        <x-nav-link href="{{ route('mahasiswa.home') }}" :active="request()->routeIs('mahasiswa.home')">Home</x-nav-link>
                        <x-nav-link href="{{ route('mahasiswa.pengaduans.index') }}" :active="request()->routeIs('mahasiswa.pengaduans.index')">Pengaduan</x-nav-link>
                        <x-nav-link href="{{ route('mahasiswa.kritiksarans.index') }}" :active="request()->routeIs('mahasiswa.kritiksarans.index')">Kritik Saran</x-nav-link>

                        @elseif (Auth::user()->nip!=null)
                        <x-nav-link href="{{ route('wd.home') }}" :active="request()->routeIs('wd.home')">Home</x-nav-link>
                        <x-nav-link href="{{ route('wd.pengaduans') }}" :active="request()->routeIs('wd.pengaduans')">Pengaduan</x-nav-link>
                        <x-nav-link href="{{ route('wd.kritiksarans') }}" :active="request()->routeIs('wd.kritiksarans')">Kritik Saran</x-nav-link>

                        @else
                        <x-nav-link href="{{ route('admin.home') }}" :active="request()->routeIs('admin.home')">Home</x-nav-link>
                        <x-nav-link href="{{ route('admin.pengaduans') }}" :active="request()->routeIs('admin.pengaduans')">Pengaduan</x-nav-link>
                        <x-nav-link href="{{ route('admin.kritiksarans') }}" :active="request()->routeIs('admin.kritiksarans')">Kritik Saran</x-nav-link>
                        <x-nav-link href="{{ route('admin.user.index') }}" :active="request()->routeIs('admin.user.index')">Akun</x-nav-link>
                        <x-nav-link href="{{ route('admin.mahasiswa.index') }}" :active="request()->routeIs('admin.mahasiswa.index')">Mahasiswa</x-nav-link>
                    @endif
                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                    <!-- <button type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                                <span class="absolute -inset-1.5"></span>
                                <span class="sr-only">View notifications</span>
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                </svg>
                            </button> -->

                    <!-- Profile dropdown -->
                    <div class="relative ml-3">
                        <div>
                            <button type="button" @click="isOpen = !isOpen" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="absolute -inset-1.5"></span>
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full" src="{{asset('image/profil.png')}}" alt="">
                            </button>
                        </div>
                        <div x-show="isOpen" x-transition:enter="transition ease-out duration-100 transform" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75 transform" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            <a href="{{ route('profil.index') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">PROFIL AKUN</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">LOGOUT</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="-mr-2 flex md:hidden">
                <!-- Mobile menu button -->
                <button type="button" @click="isOpen = !isOpen" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <!-- Menu open: "hidden", Menu closed: "block" -->
                    <svg :class="{'hidden': isOpen, 'block': !isOpen }" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!-- Menu open: "block", Menu closed: "hidden" -->
                    <svg :class="{'block': isOpen, 'hidden': !isOpen }" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div x-show="isOpen" class="md:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            @if(Auth::user()->nim!=null)
            <a href="{{route('mahasiswa.home')}}" class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page">Home</a>
            <a href="{{route('mahasiswa.pengaduans.index')}}" class="text-gray-800 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Pengaduan</a>
            <a href="{{route('mahasiswa.kritiksarans.index')}}" class="text-gray-800 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Kritik dan Saran</a>
            @elseif(Auth::user()->nip!=null)
            <a href="{{route('wd.home')}}" class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page">Home</a>
            <a href="{{route('wd.pengaduans')}}" class="text-gray-800 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Pengaduan</a>
            <a href="{{route('wd.kritiksarans')}}" class="text-gray-800 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Kritik dan Saran</a>
            @else
            <a href="{{route('admin.home')}}" class="bg-gray-900 text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page">Home</a>
            <a href="{{route('admin.user.index')}}" class="text-gray-800 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Akun</a>
            <a href="{{route('admin.mahasiswa.index')}}" class="text-gray-800 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Mahasiswa</a>
            <a href="{{route('admin.pengaduans')}}" class="text-gray-800 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Pengaduan</a>
            <a href="{{route('admin.kritiksarans')}}" class="text-gray-800 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Kritik dan Saran</a>
            @endif

        </div>
        <div class="border-t border-gray-700 pb-3 pt-4">
            
            <div class="mt-3 space-y-1 px-2">
            <a href="{{route('profil.index')}}" class="text-gray-800 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium" role="menuitem" tabindex="-1" id="user-menu-item-0">PROFIL AKUN</a>
            <form method="POST" action="{{ route('logout') }}" class="text-gray-800 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">
                @csrf
                <button type="submit"  role="menuitem" tabindex="-1" id="user-menu-item-1">LOGOUT</button>
            </form>

            </div>
        </div>
    </div>
</nav>

