<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Home - Harfelly Hall</title>
</head>
<body class="bg-gray-100" style="background-image: url('{{ asset('img/lapangan.jpg') }}'); background-size: cover; background-position: center;"\>
<nav class="bg-indigo-700 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center gap-3">
                <div class="flex-shrink-0">
                    {{-- Icon User --}}
                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <span class="font-semibold text-white">{{ Auth::user()->name }}</span>
            </div>

            <div class="hidden sm:flex sm:items-center sm:space-x-6">
                <a href="{{ route('admin.dashboard') }}" class="text-gray-100 hover:text-indigo-300 font-medium">Home</a>
                <a href="{{ route('admin.sewa') }}" class="text-gray-300 hover:text-indigo-300">Kelola Sewa</a>
                <a href="{{ route('admin.member.index') }}" class="text-gray-300 hover:text-indigo-300">Kelola Member</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-300 hover:text-indigo-300">Log-out</button>
                </form>
            </div>
        </div>
    </div>
</nav>
 <main class="max-w-2xl mx-auto py-10 px-4">
        <h1 class="text-2xl font-semibold mb-6">Edit Member</h1>
        <div class="bg-white p-8 rounded-lg shadow">
            
            <form action="{{ route('admin.member.update', $member) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                        {{-- Tambahkan @error untuk menampilkan pesan error --}}
                        <input type="text" name="name" id="name" value="{{ old('name', $member->name) }}" required 
                               class="mt-1 block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }}">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $member->email) }}" required 
                               class="mt-1 block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }}">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Nomor HP</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $member->phone) }}" 
                               class="mt-1 block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 {{ $errors->has('phone') ? 'border-red-500' : 'border-gray-300' }}">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password Baru (Opsional)</label>
                        <input type="password" name="password" id="password" placeholder="Isi jika ingin ganti password" 
                               class="mt-1 block w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }}">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="text-right">
                        <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>
</html>