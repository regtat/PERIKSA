<x-layout>
    <x-slot:title>{{$title}}</x-slot>
        <section class="flex items-center justify-center min-h-screen mx-auto max-w-5xl mt-6 mb-0">
            <div class="w-full max-w-sm p-8 z-20  bg-D9B5DD border border-gray-200 rounded-lg shadow sm:p-6 md:p-8">
                <form class="space-y-6" method="post" action="{{ route('admin.mahasiswa.store') }}">
                    @csrf
                    <h5 class="text-xl font-bold text-black text-center">Mahasiswa</h5>
                    <div>
                        <!-- <label for="email" class="block mb-2 text-sm font-medium text-gray-800">Your email</label> -->
                        <input type="text" name="nim" id="nim"
                            class="bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="H1D022001" value="{{ old('nim') }}" required min="9"/>
                    </div>
                    <div>
                        <!-- <label for="password" class="block mb-2 text-sm font-medium text-gray-800">Your password</label> -->
                        <input type="text" name="nama" id="nama"
                            class="bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Nama Lengkap" value="{{ old('nama') }}" required />
                    </div>
                    <div>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="mhs.ft@mhs.unsoed.ac.id" value="{{ old('email') }}" pattern="[a-z]+\.[a-z]+@mhs.unsoed.ac.id" />
                    </div>
                    <div>
                        <input type="password" name="password" id="password"
                            class="bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Buat password minimal 8 karakter" value="{{ old('password') }}" required />
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-gray-800 hover:bg-gray-50 hover:text-gray-800 focus:ring-4 focus:outline-none focus:ring-black font-medium rounded-lg text-sm px-5 py-2.5 text-center">Tambah</button>
                </form>
            </div>
        </section>
        <x-footer></x-footer>
</x-layout>