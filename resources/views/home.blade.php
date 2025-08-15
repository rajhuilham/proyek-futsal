<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
<div class="max-w-screen-lg mx-auto px-4 py-16 sm:px-6 lg:px-8">
  <div class="flex flex-col items-center gap-12 lg:flex-row">
    
    <div class="text-center lg:w-1/2 lg:text-left">
      <h1 class="text-2xl font-semibold text-gray-800">
        Halo, Selamat Datang di Harfelly
      </h1>
      
      <p class="my-4 text-4xl font-bold tracking-tight text-gray-900 lg:text-5xl">
        Salah satu tempat terbaik untuk bermain futsal di kota Jambi.
      </p>
      
      <h2 class="text-xl text-gray-600">
        Tunggu apa lagi? Ayo daftar sekarang!
      </h2>
      
      <div class="mt-8 justify-center lg:justify-start">
        <a href="/login" class="inline-block rounded-lg bg-green-500 px-6 py-3 text-base font-bold text-white shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2">
        Daftar
        </a>
      </div>
    </div>

    <div class="mt-8 w-full lg:mt-0 lg:w-1/2">
      <img src="/img/Futsal.png" class="rounded-lg shadow-xl" alt="Pemain futsal sedang beraksi">
    </div>
    
  </div>
</div>
</x-layout>