<x-layout>
    <x-header>
        <div class="flex items-center justify-between mt-3 mb-2">
            <h2 class="text-xl font-semibold"> {{ $title }} </h2>
            <a href="{{ route('admin.mahasiswa.create') }}">
                <button type="submit"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-black font-medium rounded-lg text-sm px-8 py-2 me-2">
                    TAMBAH MAHASISWA
                </button>
            </a>
        </div>
    </x-header>
    <x-slot:title>{{$title}}</x-slot>
        <div class="container mx-auto max-w-5xl mt-2 mb-24">
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-100 bg-green-100 rounded-lg" role="alert">
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="p-4 mb-4 text-sm text-red-100 bg-red-100 rounded-lg" role="alert">
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            @endif
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-black">
                    <thead class="text-xs text-gray-700 uppercase bg-EED3E6">
                        <tr>
                            <th scope="col" class="text-center px-6 py-3">
                                NIM
                            </th>
                            <th scope="col" class="text-center px-6 py-3">
                                NAMA
                            </th>
                            <th scope="col" class="text-center px-6 py-3">
                                AKSI
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswa as $mhs)
                            <tr
                                class="text-center odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                                    {{ $mhs->nim }}
                                </th>
                                <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                                    {{ $mhs->nama }}
                                </td>
                                <td class="ml-auto flex space-x-3 px-6 py-4 items-center justify-center whitespace-nowrap">
                                    <a href="{{ route('admin.mahasiswa.edit', $mhs->nim) }}"
                                        class="font-medium text-blue-600 hover:underline"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            viewBox="0 0 24 24">
                                            <g fill="none" stroke="#4ECB71" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2">
                                                <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                <path d="M18.375 2.625a2.121 2.121 0 1 1 3 3L12 15l-4 1l1-4Z" />
                                            </g>
                                        </svg></a>
                                    <!-- Tombol Hapus -->
                                    <button data-modal-target="popup-modal-{{ $mhs->nim }}"
                                        data-modal-toggle="popup-modal-{{ $mhs->nim }}" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px"
                                            viewBox="0 0 24 24">
                                            <path fill="#EB0202"
                                                d="M7.616 20q-.672 0-1.144-.472T6 18.385V6H5V5h4v-.77h6V5h4v1h-1v12.385q0 .69-.462 1.153T16.384 20zM17 6H7v12.385q0 .269.173.442t.443.173h8.769q.23 0 .423-.192t.192-.424zM9.808 17h1V8h-1zm3.384 0h1V8h-1zM7 6v13z" />
                                        </svg>
                                    </button>

                                    <!-- Modal Hapus -->
                                    <div id="popup-modal-{{ $mhs->nim }}" tabindex="-1"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <div class="relative pb-4 pl-4 bg-white rounded-lg shadow dark:bg-gray-700">
                                                <button type="button"
                                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-800 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-hide="popup-modal-{{ $mhs->nim }}">
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close</span>
                                                </button>
                                                <div class="p-5 pl-8 md:p-5 text-center ">
                                                    <h3
                                                        class="mt-6 mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                        Apakah Anda yakin menghapus mahasiswa ini?
                                                    </h3>
                                                    <form action="{{ route('admin.mahasiswa.destroy', $mhs->nim) }}"
                                                        method="post" style="display:inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button data-modal-hide="popup-modal-{{ $mhs->nim }}" type="submit"
                                                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">Ya</button>
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
            </div>
        </div>
        <x-footer></x-footer>
</x-layout>