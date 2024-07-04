<x-layoutwd>
    <x-slot:title>{{$title}}</x-slot>
        <section class="flex items-center justify-center min-h-screen">
            <div class="w-full max-w-sm p-8 z-20  bg-D9B5DD border border-gray-200 rounded-lg shadow sm:p-6 md:p-8">
                <form class="space-y-6" method="post" action="{{ route('wd.updatePengaduan', $pengaduans->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <h5 class="text-xl font-bold text-black">{{$title}}</h5>
                    <!-- <div>
                        <input type="text" name="NIM" id="NIM" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"  value="{{old('NIM', $pengaduans->id)}}" readonly />
                    </div> -->

                    <!-- <div>
                                <textarea class="form-control @error('pengaduan') is-invalid @enderror" name="pengaduan" rows="5" value="{{ old('pengaduan', $pengaduans->id) }}" readonly></textarea>
                            </div> -->
                    <!-- 
                            <div>
                        <input type="file" name="foto" id="foto" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('foto', $pengaduans->foto) }}"  readonly />
                    </div> -->
                    <div>
                        <label
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">STATUS</label>
                        <select class="form-control @error('status') is-invalid @enderror" name="status">
                            <option value="diproses" {{ old('status', $pengaduans->status) == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="menunggu" {{ old('status', $pengaduans->status) == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="selesai" {{ old('status', $pengaduans->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>

                        <!-- error message untuk status -->
                        @error('status')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <button type="submit"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Verifikasi</button>
                </form>
            </div>
        </section>
        <x-footer></x-footer>
</x-layoutwd>