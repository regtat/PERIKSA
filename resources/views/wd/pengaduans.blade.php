<x-layout>
    <x-header>
        <div class="flex items-center justify-between mt-3 mb-2">
            <h2 class="text-xl font-semibold">{{ $title }}</h2>
        </div>
    </x-header>
    <x-slot:title>{{ $title }}</x-slot>
       <div class="container mx-auto max-w-5xl mt-2 mb-24">

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
                                $uniqueId = $pengaduan->id;
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
                            <td class="px-6 py-4">{{ $teks_pendek }}</td>
                                <td class="flex items-center justify-center py-2">
                                    <img src="{{ asset('/storage/pengaduan/' . $pengaduan->foto) }}" class="rounded"
                                        style="width: 100px">
                                </td>

                                <td class="text-center px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                                    <form id="updateStatusForm-{{ $uniqueId }}"
                                        action="{{ route('wd.pengaduans.update', $pengaduan->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" id="statusSelect-{{ $uniqueId }}"
                                            onchange="submitForm('{{$uniqueId}}')">
                                            <option value="Diproses" {{ $pengaduan->status == 'Diproses' ? 'selected' : '' }}
                                                style="background-color: #FFDB5C" class="text-white">Diproses</option>
                                            <option value="Menunggu" {{ $pengaduan->status == 'Menunggu' ? 'selected' : '' }}
                                                style="background-color: #B9B9B9" class="text-white">Menunggu</option>
                                            <option value="Selesai" {{ $pengaduan->status == 'Selesai' ? 'selected' : '' }}
                                                style="background-color: #9DDE8B" class="text-white">Selesai</option>
                                        </select>
                                    </form>


                                </td>

                                <td class="text-center px-6 py-4 font-medium text-gray-800 whitespace-nowrap">{{ $pengaduan->tanggal }}</td>

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
                                        function submitForm(uniqueId) {
                                            const form = document.getElementById('updateStatusForm-' + uniqueId);
                                            form.submit();
                                        }
                                    </script>

                                    <!-- Tombol Hapus -->
                                <button data-modal-target="popup-modal-{{ $pengaduan->id }}" data-modal-toggle="popup-modal-{{ $pengaduan->id }}" type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24">
                                        <path fill="#EB0202" d="M7.616 20q-.672 0-1.144-.472T6 18.385V6H5V5h4v-.77h6V5h4v1h-1v12.385q0 .69-.462 1.153T16.384 20zM17 6H7v12.385q0 .269.173.442t.443.173h8.769q.23 0 .423-.192t.192-.424zM9.808 17h1V8h-1zm3.384 0h1V8h-1zM7 6v13z" />
                                    </svg>
                                </button>

                                <!-- Modal Hapus -->
                                <div id="popup-modal-{{ $pengaduan->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative md:p-2 p-4 w-full max-w-md max-h-full">
                                        <div class="relative md:pb-4 pb-4 bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-800 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal-{{ $pengaduan->id }}">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close</span>
                                            </button>
                                            <div class="px-5 md:p-8 text-center">
                                                <h3 class="md:mt-6 mt-6 mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                    Apakah Anda yakin menghapus pengaduan ini?
                                                </h3>
                                                <form action="{{ route('wd.pengaduans.destroy', $pengaduan->id) }}" method="post" style="display:inline">
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
        <footer class="fixed bottom-0 left-0 z-20 w-full p-4 bg-C29DC2 ">
            <div class="mx-auto w-full max-w-screen-xl p-4 py-2 lg:py-2">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <span class="text-sm text-black sm:text-center">© 2024 <a href="https://ft.unsoed.ac.id/"
                            class="hover:underline">Fakultas Teknik Universitas Jenderal Soedirman™</a>. All Rights
                        Reserved.
                    </span>
                    <div class="flex mt-4 sm:justify-center sm:mt-0">
                        <a href="#" class="text-gray-500 hover:text-gray-900">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 8 19">
                                <path fill-rule="evenodd"
                                    d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Facebook page</span>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900 ms-5">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 21 16">
                                <path
                                    d="M16.942 1.556a16.3 16.3 0 0 0-4.126-1.3 12.04 12.04 0 0 0-.529 1.1 15.175 15.175 0 0 0-4.573 0 11.585 11.585 0 0 0-.535-1.1 16.274 16.274 0 0 0-4.129 1.3A17.392 17.392 0 0 0 .182 13.218a15.785 15.785 0 0 0 4.963 2.521c.41-.564.773-1.16 1.084-1.785a10.63 10.63 0 0 1-1.706-.83c.143-.106.283-.217.418-.33a11.664 11.664 0 0 0 10.118 0c.137.113.277.224.418.33-.544.328-1.116.606-1.71.832a12.52 12.52 0 0 0 1.084 1.785 16.46 16.46 0 0 0 5.064-2.595 17.286 17.286 0 0 0-2.973-11.59ZM6.678 10.813a1.941 1.941 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.919 1.919 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Zm6.644 0a1.94 1.94 0 0 1-1.8-2.045 1.93 1.93 0 0 1 1.8-2.047 1.918 1.918 0 0 1 1.8 2.047 1.93 1.93 0 0 1-1.8 2.045Z" />
                            </svg>
                            <span class="sr-only">Discord community</span>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900 ms-5">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 17">
                                <path fill-rule="evenodd"
                                    d="M20 1.892a8.178 8.178 0 0 1-2.355.635 4.074 4.074 0 0 0 1.8-2.235 8.344 8.344 0 0 1-2.605.98A4.13 4.13 0 0 0 13.85 0a4.068 4.068 0 0 0-4.1 4.038 4 4 0 0 0 .105.919A11.705 11.705 0 0 1 1.4.734a4.006 4.006 0 0 0 1.268 5.392 4.165 4.165 0 0 1-1.859-.5v.05A4.057 4.057 0 0 0 4.1 9.635a4.19 4.19 0 0 1-1.856.07 4.108 4.108 0 0 0 3.831 2.807A8.36 8.36 0 0 1 0 14.184 11.732 11.732 0 0 0 6.291 16 11.502 11.502 0 0 0 17.964 4.5c0-.177 0-.35-.012-.523A8.143 8.143 0 0 0 20 1.892Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Twitter page</span>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900 ms-5">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">GitHub account</span>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-900 ms-5">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 0a10 10 0 1 0 10 10A10.009 10.009 0 0 0 10 0Zm6.613 4.614a8.523 8.523 0 0 1 1.93 5.32 20.094 20.094 0 0 0-5.949-.274c-.059-.149-.122-.292-.184-.441a23.879 23.879 0 0 0-.566-1.239 11.41 11.41 0 0 0 4.769-3.366ZM8 1.707a8.821 8.821 0 0 1 2-.238 8.5 8.5 0 0 1 5.664 2.152 9.608 9.608 0 0 1-4.476 3.087A45.758 45.758 0 0 0 8 1.707ZM1.642 8.262a8.57 8.57 0 0 1 4.73-5.981A53.998 53.998 0 0 1 9.54 7.222a32.078 32.078 0 0 1-7.9 1.04h.002Zm2.01 7.46a8.51 8.51 0 0 1-2.2-5.707v-.262a31.64 31.64 0 0 0 8.777-1.219c.243.477.477.964.692 1.449-.114.032-.227.067-.336.1a13.569 13.569 0 0 0-6.942 5.636l.009.003ZM10 18.556a8.508 8.508 0 0 1-5.243-1.8 11.717 11.717 0 0 1 6.7-5.332.509.509 0 0 1 .055-.02 35.65 35.65 0 0 1 1.819 6.476 8.476 8.476 0 0 1-3.331.676Zm4.772-1.462A37.232 37.232 0 0 0 13.113 11a12.513 12.513 0 0 1 5.321.364 8.56 8.56 0 0 1-3.66 5.73h-.002Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Dribbble account</span>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
</x-layout>