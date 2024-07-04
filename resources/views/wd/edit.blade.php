<x-layout>
    <x-slot:title>{{$title}}</x-slot>
        <section class="flex items-center justify-center min-h-screen">
            <div class="w-full max-w-sm p-8 z-20  bg-D9B5DD border border-gray-200 rounded-lg shadow sm:p-6 md:p-8">
            <form class="space-y-6" method="post" action="{{ route('wd.update', $wd->nip) }}">
                    @csrf
                    @method('put')
                    <h5 class="text-xl font-bold text-black">{{$title}}</h5>
                    <div>
                        <!-- <label for="email" class="block mb-2 text-sm font-medium text-gray-800">Your email</label> -->
                        <input type="text" name="nip" id="nip" class="bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{old('nip', $wd->nip)}}" readonly />
                    </div>
                    <div>
                        <!-- <label for="password" class="block mb-2 text-sm font-medium text-gray-800">Your password</label> -->
                        <input type="text" name="nama" id="nama" class="bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('nama', $wd->nama) }}" required />
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Tambah</button>
                </form>
            </div>
        </section>
        <x-footer></x-footer>
</x-layout>
