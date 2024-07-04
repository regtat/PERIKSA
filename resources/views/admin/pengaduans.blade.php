<x-layout>
    <x-header>
        <div class="flex items-center justify-between mt-3 mb-2">
            <h2 class="text-xl font-semibold">{{ $title }}</h2>
        </div>
    </x-header>
    <x-slot:title>{{ $title }}</x-slot>
       <div class="container mx-auto max-w-5xl mt-2 mb-24">
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
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-black">
                    <thead class="text-center text-xs text-gray-700 uppercase bg-EED3E6">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">NIM</th>
                            <th scope="col" class="px-6 py-3">PENGADUAN</th>
                            <th scope="col" class="px-6 py-3">BUKTI FOTO</th>
                            <th scope="col" class="px-6 py-3">STATUS</th>
                            <th scope="col" class="px-6 py-3">TANGGAL</th>
                            <th scope="col" class="px-6 py-3">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengaduans as $pengaduan)
                            @php
                                $uniqueId = $pengaduan->id; // Unique ID for each row
                            @endphp
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b">
                                <td scope="row" class="text-center px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                                    {{ $loop->iteration + ($pengaduans->currentPage() - 1) * $pengaduans->perPage() }}
                                </td>
                                <td class="text-center px-6 py-4 font-medium text-gray-800 whitespace-nowrap">{{ $pengaduan->p_nim }}</td>
                                @php
                                $teks_awal = $pengaduan->pengaduan;
                                $panjang_teks = 20;
                                if (strlen($teks_awal) > $panjang_teks) {
                                    $teks_pendek = substr($teks_awal, 0, $panjang_teks) . '...';
                                } else {
                                    $teks_pendek = $teks_awal;
                                }
                            @endphp
                            <td class=" px-6 py-4 font-medium text-gray-800 ">{{ $teks_pendek }}</td>
                                <td class="flex items-center justify-center py-2">
                                    <img src="{{ asset('/storage/pengaduan/' . $pengaduan->foto) }}" class="rounded"
                                        style="width: 100px">
                                </td>
                                <td class="text-center px-6 py-4 font-medium text-gray-800 whitespace-nowrap">{{$pengaduan->status}}</td>
                                <td class="text-center px-6 py-4 font-medium text-gray-800 whitespace-nowrap">{{ \Carbon\Carbon::parse($pengaduan->tanggal)->format('Y-m-d') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <!-- Open Modal Button Show-->
                                    <button id="openModal-{{ $uniqueId }}" data-modal-target="modal-{{ $uniqueId }}"
                                        data-modal-toggle="modal-{{ $uniqueId }}" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px"
                                            viewBox="0 0 24 24">
                                            <g fill="none" stroke="black" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="1.5">
                                                <path d="M3 13c3.6-8 14.4-8 18 0" />
                                                <path d="M12 17a3 3 0 1 1 0-6a3 3 0 0 1 0 6" />
                                            </g>
                                        </svg>
                                    </button>
                                    <!-- Modal Show-->
                                    <div id="modal-{{$uniqueId}}" tabindex="-1" aria-hidden="true"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal Header Show-->
                                                <div
                                                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white">
                                                        Pengaduan
                                                    </h3>
                                                    <button id="closeModal-{{ $uniqueId }}" type="button"
                                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-800 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-hide="modal-{{ $uniqueId }}">
                                                        <svg class="w-3 h-3" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                        <span class="sr-only">Close</span>
                                                    </button>
                                                </div>
                                                <!-- Modal Body Show -->
                                                <div id="modal-{{ $uniqueId }}" class="p-4 md:p-5 space-y-4">
                                                    <div>
                                                        <p>ID : {{ $pengaduan->id}}</p><br />
                                                        <p>NIM : {{ $pengaduan->p_nim}}</p><br />
                                                        <p>Nama : {{ $pengaduan->mahasiswa->nama}}</p><br />
                                                        <p class="whitespace-normal"> Pengaduan : {{ $pengaduan->pengaduan}}</p><br />
                                                        <p>Bukti : <img
                                                                src="{{ asset('/storage/pengaduan/' . $pengaduan->foto) }}"
                                                                class="rounded" style="width: 150px"></p><br />
                                                        <p> Tanggal : {{ $pengaduan->tanggal}}</p><br />
                                                        <p>Status : {{ $pengaduan->status}}</p><br />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', () => {
                                            const openModalBtn = document.getElementById('openModal-{{ $uniqueId }}');
                                            const closeModalBtn = document.getElementById('closeModal-{{ $uniqueId }}');
                                            const modal = document.getElementById('modal-{{ $uniqueId }}');

                                            openModalBtn.addEventListener('click', () => {
                                                modal.classList.remove('hidden');
                                            });
                                            closeModalBtn.addEventListener('click', () => {
                                                modal.classList.add('hidden');
                                            });
                                        });
                                    </script>

                                    <!-- Tombol Hapus -->
                                <button data-modal-target="popup-modal-{{ $pengaduan->id }}" data-modal-toggle="popup-modal-{{ $pengaduan->id }}" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24">
                                        <path fill="#EB0202" d="M7.616 20q-.672 0-1.144-.472T6 18.385V6H5V5h4v-.77h6V5h4v1h-1v12.385q0 .69-.462 1.153T16.384 20zM17 6H7v12.385q0 .269.173.442t.443.173h8.769q.23 0 .423-.192t.192-.424zM9.808 17h1V8h-1zm3.384 0h1V8h-1zM7 6v13z" />
                                    </svg>
                                </button>

                                <!-- Modal Hapus -->
                                <div id="popup-modal-{{ $pengaduan->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative pb-4 bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-800 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal-{{ $pengaduan->id }}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close</span>
                                            </button>
                                            <div class="p-4 md:p-5 text-center">
                                                <h3 class="mt-6 mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                    Apakah Anda yakin menghapus pengaduan ini?
                                                </h3>
                                                <form action="{{ route('admin.pengaduans.destroy', $pengaduan->id) }}" method="post" style="display:inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button data-modal-hide="popup-modal-{{ $pengaduan->id }}" type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">Ya</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal Hapus -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="py-2">{{ $pengaduans->links() }}
                    </div>
            </div>
        </div>
        <x-footer></x-footer>
</x-layout>