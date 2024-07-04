<x-layout>
    <x-slot:title>PROFIL</x-slot>
    <!-- <section class="flex items-center justify-center min-h-screen mx-auto max-w-5xl mt-14 mb-1"> -->
    <div class="mt-1">
        @if (session('success'))
                <div class="p-3 mb-3 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            @endif
            </div>
    <div class="flex items-center justify-center min-h-screen mx-auto max-w-5xl mt-14 mb-1">
    
        <div class="w-full max-w-sm p-8 z-20  bg-D9B5DD border border-gray-200 rounded-lg shadow sm:p-6 md:p-8">
                <h5 class="text-xl font-bold text-black space-y-4 text-center">PROFIL</h5>
                <div class="pt-5 space-y-2">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input type="text" name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-300 focus:border-gray-800 block w-full p-2.5"
                        value="{{old('email', Auth::user()->email)}}" readonly />
                </div>
                <div class="pt-4 space-y-2">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                    <input type="text" name="name" id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-300 focus:border-gray-800 block w-full p-2.5"
                        value="{{old('name', Auth::user()->name)}}" readonly />
                </div>
                <div class="pt-4 space-y-2">
                    @if(Auth::user()->nim != null)
                        <label for="nim" class="block mb-2 text-sm font-medium text-gray-900">NIM</label>
                        <input type="text" name="nim" id="nim"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-300 focus:border-gray-800 block w-full p-2.5"
                            value="{{ old('nim', Auth::user()->nim) }}" readonly />
                    @elseif(Auth::user()->nip != null)
                        <label for="nip" class="block mb-2 text-sm font-medium text-gray-900">NIP</label>
                        <input type="text" name="nip" id="nip"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-300 focus:border-gray-800 block w-full p-2.5"
                            value="{{ old('nip', Auth::user()->nip) }}" readonly />
                    @else
                    @endif
                </div>
                <div class="pt-4">
                <button type="button"
                    class="w-full text-white bg-gray-800 hover:bg-gray-50 hover:text-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center"><a
                        href="{{ route('profil.edit') }}" id="send-verification">Ganti Password</a></button>
                        </div>
            </div>
        <!-- </section> -->
         </div>
        <x-footer></x-footer>
</x-layout>