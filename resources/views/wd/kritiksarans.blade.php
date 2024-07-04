<x-layout>
    <x-header>
    <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold">{{ $title }}</h2>
            <a href="{{ route('wd.cetakKritikSaran', ['month' => request('month')]) }}" target="_blank">
                <button type="submit" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-black font-medium rounded-lg text-sm px-8 py-2.5 me-2 mb-2">
                    UNDUH LAPORAN
                </button>
            </a>
        </div>
    </x-header>
    <x-slot:title>{{$title}}</x-slot>
    
        <div class="container mx-auto mt-2 mb-8">
        @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
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
                    <thead class="text-xs text-gray-700 uppercase bg-EED3E6">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            
                            <th scope="col" class="px-6 py-3">
                                KRITIK SARAN
                            </th>
                            <th class="mr-2 text-xs text-gray-700 uppercase bg-EED3E6">
                            <form method="GET" action="{{ route('wd.kritiksarans') }}" class="flex items-center">
                <select name="month" class="text-xs text-gray-700 uppercase py-1 ml-2 bg-EED3E6 rounded-md">
                    <option  value="">Pilih Bulan</option>
                    @foreach(range(1, 12) as $month)
                        <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="ml-2 mr-2 p-2 bg-EED3E6 text-gray-700 rounded-md">FILTER</button>
            </form>
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kritiksarans as $kritiksaran)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap">
                                    {{ $loop->iteration + ($kritiksarans->currentPage() - 1) * $kritiksarans->perPage() }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $kritiksaran->kritiksaran}}
                                </td>
                                
                                <td></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $kritiksarans->links()}}</div>
        </div>
        <x-footer></x-footer>
</x-layout>