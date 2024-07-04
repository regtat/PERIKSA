<x-layout>
    <x-slot:title>{{$title}}</x-slot>
        <section class="flex items-center justify-center min-h-screen mx-auto max-w-5xl mt-8 mb-16">
            <div class="w-full max-w-sm p-8 z-20  bg-D9B5DD border border-gray-200 rounded-lg shadow sm:p-6 md:p-8">
                <form class="space-y-6" method="post" action="{{ route('admin.user.store') }}">
                    @csrf
                    <h5 class="text-xl font-bold text-black text-center">AKUN</h5>
                    <div>
                        <input type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Nama Lengkap" value="{{ old('name') }}" required />
                    </div>
                    <div>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="mhs.ft@mhs.unsoed.ac.id" value="{{ old('email') }}" required />
                    </div>
                    <div>
                        <input type="password" name="password" id="password"
                            class="bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Buat password minimal 8 karakter" value="{{ old('password') }}" required />
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-gray-800 hover:bg-gray-50 hover:text-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Tambah</button>
                </form>
            </div>
        </section>
        <x-footer></x-footer>
</x-layout>