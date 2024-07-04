<x-layout>
    <x-slot:title>{{$title}}</x-slot>        
<section class="flex items-center justify-center min-h-screen mx-auto max-w-5xl mt-14 mb-4">
            <div class="position:relative w-full max-w-sm p-8 z-20  bg-D9B5DD border border-gray-200 rounded-lg shadow sm:p-6 md:p-8">
                <form class="space-y-6" method="post" action="{{ route('mahasiswa.kritiksarans.store') }}">
                    @csrf
                    <h5 class="text-xl font-bold text-black ">KRITIK SARAN</h5>
                    <div>
                        <textarea rows="5" name="kritiksaran"
                            class="bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5"
                            placeholder="Tuliskan kritik saran Anda" value="{{ old('kritiksaran') }}"
                            required></textarea>
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full text-white bg-gray-800 hover:bg-gray-50 hover:text-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-900 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Tambah</button>
                </form>
                </div>
            </div>
        </section>
    <x-footer></x-footer>
</x-layout>