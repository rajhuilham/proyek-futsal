<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="bg-gray-100 py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="border border-gray-300 rounded-lg p-8 bg-white shadow-lg">
                
                <h2 class="text-3xl font-bold text-center text-gray-900 mb-8">
                    Bantuan
                </h2>

                <!-- ▼▼▼ 1. TAMBAHKAN BLOK INI UNTUK MENAMPILKAN PESAN SUKSES ▼▼▼ -->
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                
                <form action="{{ route('contact.store') }}" method="POST">
                    
                    <!-- ▼▼▼ 2. TAMBAHKAN @csrf DI SINI UNTUK KEAMANAN ▼▼▼ -->
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                            <div class="mt-1">
                                <input type="text" name="name" id="name" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <div class="mt-1">
                                <input id="email" name="email" type="email" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                        </div>
                        
                        <div>
                            <label for="note" class="block text-sm font-medium text-gray-700">Note</label>
                            <div class="mt-1">
                                <textarea id="note" name="note" rows="4" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                            </div>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row justify-end items-center gap-4 pt-4">
                            
                            <a href="https://wa.me/6283133094736?text=Halo,%20saya%20tertarik%20booking%20lapangan." 
                               target="_blank" 
                               class="inline-flex items-center justify-center w-full sm:w-auto rounded-md border border-transparent bg-green-500 px-5 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91C2.13 13.66 2.59 15.36 3.45 16.86L2.06 22L7.31 20.58C8.75 21.37 10.36 21.82 12.04 21.82C17.5 21.82 21.95 17.37 21.95 11.91C21.95 6.45 17.5 2 12.04 2ZM12.04 20.13C10.56 20.13 9.12 19.73 7.89 19L7.5 18.78L4.44 19.56L5.25 16.59L4.99 16.19C4.16 14.86 3.81 13.36 3.81 11.91C3.81 7.39 7.52 3.68 12.04 3.68C14.28 3.68 16.31 4.55 17.87 6.11C19.43 7.67 20.28 9.7 20.28 11.91C20.28 16.43 16.56 20.13 12.04 20.13ZM16.46 14.23C16.23 14.12 15.01 13.51 14.79 13.43C14.57 13.35 14.42 13.31 14.28 13.54C14.13 13.77 13.63 14.42 13.49 14.57C13.35 14.71 13.2 14.73 12.97 14.62C12.74 14.51 11.92 14.23 10.93 13.35C10.15 12.65 9.61 11.83 9.47 11.59C9.32 11.35 9.42 11.24 9.54 11.12C9.65 11.01 9.78 10.84 9.93 10.67C10.07 10.51 10.12 10.38 10.21 10.2C10.3 10.01 10.25 9.85 10.18 9.73C10.1 9.61 9.61 8.36 9.42 7.89C9.23 7.42 9.03 7.48 8.89 7.47H8.4C8.25 7.47 8.01 7.54 7.82 7.73C7.63 7.92 7.02 8.49 7.02 9.73C7.02 10.97 7.86 12.16 7.98 12.3C8.1 12.44 9.62 14.85 12.03 15.82C12.58 16.06 13.01 16.21 13.35 16.32C13.91 16.52 14.41 16.49 14.81 16.43C15.26 16.36 16.23 15.79 16.46 15.17C16.69 14.55 16.69 14.34 16.61 14.23Z"></path>
                                </svg>
                                <span>WhatsApp</span>
                            </a>

                            <button type="submit" class="inline-flex justify-center w-full sm:w-auto rounded-md border border-transparent bg-gray-800 py-2 px-6 text-sm font-medium text-white shadow-sm hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                Kirim
                            </button>
                            
                        </div>
                        
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</x-layout>