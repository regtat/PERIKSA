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
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-black">
                        <thead class="text-xs text-gray-800 uppercase bg-EED3E6">
                            <tr>
                                <th scope="col" class="px-4 py-3">
                                    No
                                </th>
                                <th scope="col" class="ml-1 px-2 py-3">
                                    KRITIK SARAN
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kritiksarans as $kritiksaran)
                                <tr
                                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b">
                                    <td scope="row" class="px-4 py-3 font-medium text-gray-800 ">
                                        {{ $loop->iteration + ($kritiksarans->currentPage() - 1) * $kritiksarans->perPage() }}
                                    </td>
                                    <td class="ml-1 px-2 py-3 font-medium text-gray-800">
                                        {{ $kritiksaran->kritiksaran}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <x-footer></x-footer>
</x-layout>