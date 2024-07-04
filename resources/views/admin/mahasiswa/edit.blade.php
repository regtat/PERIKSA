<x-layout>
    <x-slot:title>{{$title}}</x-slot>
        <section class="flex items-center justify-center min-h-screen mx-auto max-w-5xl mt-14 mb-1">
            <div class="w-full max-w-sm p-8 z-20  bg-D9B5DD border border-gray-200 rounded-lg shadow sm:p-6 md:p-8">
                <form class="space-y-6" method="post" action="{{ route('admin.mahasiswa.update', $mahasiswa->nim) }}">
                    @csrf
                    @method('put')
                    <h5 class="text-xl font-bold text-black text-center">{{$title}}</h5>
                    <div>
                        <!-- <label for="email" class="block mb-2 text-sm font-medium text-gray-800">Your email</label> -->
                        <input type="text" name="nim" id="nim"
                            class="bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{old('nim', $mahasiswa->nim)}}" readonly />
                    </div>
                    <div>
                        <!-- <label for="password" class="block mb-2 text-sm font-medium text-gray-800">Your password</label> -->
                        <input type="text" name="nama" id="nama"
                            class="bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{ old('nama', $mahasiswa->nama) }}" required />

                    </div>

                    <button type="submit"
                        class="w-full text-white bg-gray-800 hover:bg-gray-50 hover:text-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Ubah</button>
                </form>
            </div>
        </section>
        <x-footer></x-footer>
</x-layout>