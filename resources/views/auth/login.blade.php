<?php
$title = "Login";
?>

<x-layoutlogin>
    <x-slot name="title">{{$title}}</x-slot>
    <div class="py-24 flex items-center justify-center bg-D9B5DD">
    <div class="w-full h-full items-center justify-center max-w-sm p-4 z-20 border  rounded-lg shadow sm:p-6 md:p-8" style="background-color: rgba(230, 230, 250, 0.5);">
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <h5 class="text-xl font-bold text-black text-center">LOGIN</h5>
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                <input id="email" type="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" :value="old('email')" required autofocus autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                <input id="password" type="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <button type="submit" class="w-full text-white bg-gray-800 hover:bg-gray-50 hover:text-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Log in</button>
        </form>
    </div>
</div>
</x-layoutlogin>
