<x-layout>
    <x-slot:title>{{$title}}</x-slot>
    <section class="flex items-center justify-center min-h-screen mx-auto max-w-5xl mt-14 mb-4">
            <div class="w-full max-w-sm p-8 z-20  bg-D9B5DD border border-gray-200 rounded-lg shadow sm:p-6 md:p-8">
                <form class="space-y-6" method="post" action="{{ route('mahasiswa.kritiksarans.update', $kritiksarans->id) }}">
                    @csrf
                    @method('put')
                    <h5 class="text-xl font-bold text-black">{{$title}}</h5>
                    <div>
                        <input type="hidden" name="k_nim"
                            class="bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5"
                            value="{{ old('p_nim', $kritiksarans->k_nim) }}"  />
                    </div>
                    <div>
                        <textarea rows="5" name="kritiksaran"
                            class="bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" >{{old('kritiksaran', $kritiksarans->kritiksaran)}}</textarea>
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-gray-800 hover:bg-gray-50 hover:text-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Ubah</button>
                </form>
            </div>
        </section>
        <x-footer></x-footer>
</x-layout>