<x-layout>
    <x-slot:title>{{$title}}</x-slot>
    <section class="flex items-center justify-center min-h-screen mx-auto max-w-5xl py-6">
            <div class="w-full max-w-sm p-8 z-20  bg-D9B5DD border border-gray-200 rounded-lg shadow sm:p-6 md:p-8">
                <form class="space-y-4" method="post" action="{{ route('mahasiswa.pengaduans.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <h5 class="text-xl font-bold text-black">PENGADUAN</h5>
                    <div>
                        <textarea class="form-control bg-gray-50 border  text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('pengaduan') is-invalid @enderror" name="pengaduan"
                            rows="5" placeholder="Masukkan Pengaduan" required
                            value="{{ old('pengaduan') }}"></textarea>
                    </div>
                    <div>
                        <input type="file" name="foto" id="foto"
                            class="bg-gray-50 border  text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required />
                    </div>
                    <div>
                        <input type="date" name="tanggal" id="tanggal"
                            class="bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            value="{{ old('tanggal') }}" required />
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full text-white bg-gray-800 hover:bg-gray-50 hover:text-gray-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Tambah</button>
                    </div>
                </form>
            </div>
        </section>
        <x-footer></x-footer>
</x-layout>