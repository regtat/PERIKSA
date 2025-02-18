<!DOCTYPE html>
<html lang="en">
<head class="h-full bg-gray-100">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <x-slot:title>{{$title}}</x-slot>
    <style>
        
        .bg-D9B5DD {
            background-color: #D9B5DD;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen full-screen">
<div class="relative bg-D9B5DD h-screen">
        <x-navbarlogin></x-navbarlogin>
        <main class="flex-grow">
            <div class="mx-auto max-w-5xl py-0 sm:px-0 lg:px-0">
                {{$slot}}
            </div>
        </main>
    </div>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>
