<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>
<body> -->
    <x-slot:title>LAPORAN</x-slot>
<!-- <div class="container mx-auto mt-8 mb-8"> -->
    <!-- Display the month in full name format -->
    <h2>
        {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}
    </h2>

    <!-- <div class="container mx-auto mt-8 mb-8">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg"> -->
            <!-- <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"> -->
                <table border="solid">
                <!-- <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                     -->
                     <thead >
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Kritik Saran</th>
                        <th scope="col" class="px-6 py-3">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data as $kritiksaran)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td scope="row" class="px-6 py-4 ">
                            {{ $no++ }}
                        </td>
                        <td class="px-6 py-4">{{ $kritiksaran->kritiksaran }}</td>
                        <td>{{ $kritiksaran->created_at->translatedFormat('d F Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
